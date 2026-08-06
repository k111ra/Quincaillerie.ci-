<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Category;
use App\Models\User;
use App\Models\Quote;
use App\Models\Message;
use App\Models\Fournisseur;
use App\Models\SearchLog;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Tableau de bord administrateur de la quincaillerie.
     * Agrège les indicateurs réels du site (catalogue, commandes, stock,
     * devis, messages, partenaires) pour alimenter les widgets.
     */
    public function dashboard()
    {
        $seuilStockBas = 5; // seuil d'alerte de stock pour la quincaillerie

        // --- Indicateurs catalogue & utilisateurs ---
        $productsCount   = Product::count();
        $categoriesCount = Category::count();
        $clientsCount    = User::where(function ($q) {
            $q->whereNotIn('user_type', ['partner', 'admin'])->orWhereNull('user_type');
        })->count();
        $partnersCount   = Fournisseur::count();
        $partnersPending = Fournisseur::where('status', 'pending_approval')->count();

        // --- Commandes par statut ---
        $ordersByStatus = Order::select('status', DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status');

        $ordersCount = $ordersByStatus->sum();
        $ordersPending   = $ordersByStatus[Order::STATUS_PENDING]   ?? 0;
        $ordersShipped   = $ordersByStatus[Order::STATUS_SHIPPED]   ?? 0;
        $ordersDelivered = $ordersByStatus[Order::STATUS_DELIVERED] ?? 0;
        $ordersCancelled = $ordersByStatus[Order::STATUS_CANCELLED] ?? 0;

        // --- Chiffre d'affaires (hors commandes annulées) ---
        $revenueTotal = (float) Order::where('status', '!=', Order::STATUS_CANCELLED)->sum('total_amount');
        $revenueMonth = (float) Order::where('status', '!=', Order::STATUS_CANCELLED)
            ->whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])
            ->sum('total_amount');
        $ordersThisMonth = Order::whereBetween('created_at', [now()->startOfMonth(), now()->endOfMonth()])->count();
        $panierMoyen = $ordersCount > 0 ? $revenueTotal / max(1, ($ordersCount - $ordersCancelled)) : 0;

        // --- Chiffre d'affaires des 6 derniers mois (graphique) ---
        $revenueByMonthRaw = Order::where('status', '!=', Order::STATUS_CANCELLED)
            ->where('created_at', '>=', now()->subMonths(5)->startOfMonth())
            ->select(
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as ym"),
                DB::raw('SUM(total_amount) as total')
            )
            ->groupBy('ym')
            ->pluck('total', 'ym');

        $revenueChartLabels = [];
        $revenueChartData   = [];
        for ($i = 5; $i >= 0; $i--) {
            $m = now()->subMonths($i);
            $key = $m->format('Y-m');
            $revenueChartLabels[] = ucfirst($m->translatedFormat('M'));
            $revenueChartData[]   = round((float) ($revenueByMonthRaw[$key] ?? 0));
        }

        // --- Stock : ruptures et stock bas (spécifique quincaillerie) ---
        $outOfStockCount = Product::where('quantite', '<=', 0)->count();
        $lowStockCount   = Product::whereBetween('quantite', [1, $seuilStockBas])->count();
        $lowStockProducts = Product::with('category')
            ->where('quantite', '<=', $seuilStockBas)
            ->orderBy('quantite')
            ->limit(6)
            ->get();
        $stockValue = (float) Product::sum(DB::raw('prix * quantite'));

        // --- Produits les plus vendus ---
        $topProducts = OrderItem::select('product_id', DB::raw('SUM(quantity) as qty'), DB::raw('SUM(price * quantity) as ca'))
            ->groupBy('product_id')
            ->orderByDesc('qty')
            ->with('product')
            ->limit(5)
            ->get();
        $topQtyMax = $topProducts->max('qty') ?: 1;

        // --- Répartition des produits par catégorie ---
        $categoriesStats = Category::withCount('products')
            ->orderByDesc('products_count')
            ->limit(5)
            ->get();
        $catMax = $categoriesStats->max('products_count') ?: 1;

        // --- Dernières commandes ---
        $recentOrders = Order::with('user')->latest()->limit(6)->get();

        // --- Devis & messages en attente ---
        $quotesPending = Quote::where('status', 'pending')->count();
        $quotesTotal   = Quote::count();
        $messagesCount = Message::count();
        $recentMessages = Message::latest()->limit(4)->get();

        // --- Recherches populaires ---
        $popularSearches = SearchLog::select('query', DB::raw('count(*) as total'))
            ->whereNotNull('query')
            ->where('query', '!=', '')
            ->groupBy('query')
            ->orderByDesc('total')
            ->limit(6)
            ->get();

        return view('admin.dashboard', compact(
            'productsCount',
            'categoriesCount',
            'clientsCount',
            'partnersCount',
            'partnersPending',
            'ordersCount',
            'ordersPending',
            'ordersShipped',
            'ordersDelivered',
            'ordersCancelled',
            'revenueTotal',
            'revenueMonth',
            'ordersThisMonth',
            'panierMoyen',
            'revenueChartLabels',
            'revenueChartData',
            'outOfStockCount',
            'lowStockCount',
            'lowStockProducts',
            'stockValue',
            'seuilStockBas',
            'topProducts',
            'topQtyMax',
            'categoriesStats',
            'catMax',
            'recentOrders',
            'quotesPending',
            'quotesTotal',
            'messagesCount',
            'recentMessages',
            'popularSearches'
        ));
    }

    /**
     * Liste des utilisateurs clients (hors partenaires et administrateurs).
     */
    public function clients(Request $request)
    {
        $q = trim((string) $request->query('q', ''));

        $clients = User::query()
            ->where(function ($builder) {
                $builder->whereNotIn('user_type', ['partner', 'admin'])
                    ->orWhereNull('user_type');
            })
            ->whereDoesntHave('roles', function ($roleQuery) {
                $roleQuery->whereIn('name', ['admin', 'partner']);
            })
            ->when($q !== '', function ($builder) use ($q) {
                $builder->where(function ($searchQuery) use ($q) {
                    $searchQuery->where('name', 'like', '%' . $q . '%')
                        ->orWhere('email', 'like', '%' . $q . '%')
                        ->orWhere('tel', 'like', '%' . $q . '%');
                });
            })
            ->orderByDesc('created_at')
            ->paginate(20)
            ->withQueryString();

        return view('admin.clients.index', compact('clients', 'q'));
    }
}
