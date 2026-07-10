@extends('layouts.contentNavbarLayout')

@section('title', 'Tableau de bord - Administration')

@section('vendor-style')
<link rel="stylesheet" href="{{asset('assets/vendor/libs/apex-charts/apex-charts.css')}}">
@endsection

@section('vendor-script')
<script src="{{asset('assets/vendor/libs/apex-charts/apexcharts.js')}}"></script>
@endsection

@php
  $fcfa = fn($v) => number_format((float) $v, 0, ',', ' ') . ' F CFA';
  $statusLabels = [
    'pending'   => ['Nouvelles', 'warning'],
    'shipped'   => ['Expédiées', 'info'],
    'delivered' => ['Livrées', 'success'],
    'cancelled' => ['Annulées', 'danger'],
  ];
  $statusCounts = [
    'pending'   => $ordersPending,
    'shipped'   => $ordersShipped,
    'delivered' => $ordersDelivered,
    'cancelled' => $ordersCancelled,
  ];
@endphp

@section('content')
<h4 class="fw-bold py-3 mb-3">
  <span class="text-muted fw-light">Administration /</span> Tableau de bord
</h4>

{{-- ============ Bandeau d'accueil + actions rapides ============ --}}
<div class="row">
  <div class="col-lg-8 mb-4 order-0">
    <div class="card">
      <div class="d-flex align-items-end row">
        <div class="col-sm-7">
          <div class="card-body">
            <h5 class="card-title text-primary">Bienvenue 👋</h5>
            <p class="mb-4">
              Vous gérez <span class="fw-bold">{{ $productsCount }}</span> produits et
              <span class="fw-bold">{{ $ordersCount }}</span> commandes.
              @if($ordersPending > 0)
                <span class="text-warning fw-semibold">{{ $ordersPending }} commande(s) en attente de traitement.</span>
              @endif
            </p>
            <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary me-1 mb-1"><i class="bx bx-plus"></i> Nouveau produit</a>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary mb-1">Voir les commandes</a>
          </div>
        </div>
        <div class="col-sm-5 text-center text-sm-left">
          <div class="card-body pb-0 px-0 px-md-4">
            <img src="{{asset('assets/img/illustrations/man-with-laptop-light.png')}}" height="140" alt="Illustration" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-4 order-1">
    <div class="row">
      {{-- Chiffre d'affaires --}}
      <div class="col-lg-6 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="avatar flex-shrink-0 mb-2">
              <span class="avatar-initial rounded bg-label-success"><i class="bx bx-money"></i></span>
            </div>
            <span class="fw-semibold d-block mb-1">CA ce mois</span>
            <h5 class="card-title mb-1">{{ $fcfa($revenueMonth) }}</h5>
            <small class="text-muted">{{ $ordersThisMonth }} commande(s)</small>
          </div>
        </div>
      </div>
      {{-- Panier moyen --}}
      <div class="col-lg-6 col-md-12 col-6 mb-4">
        <div class="card">
          <div class="card-body">
            <div class="avatar flex-shrink-0 mb-2">
              <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-cart"></i></span>
            </div>
            <span class="fw-semibold d-block mb-1">Panier moyen</span>
            <h5 class="card-title mb-1">{{ $fcfa($panierMoyen) }}</h5>
            <small class="text-muted">CA total {{ $fcfa($revenueTotal) }}</small>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

{{-- ============ KPI principaux ============ --}}
<div class="row">
  <div class="col-sm-6 col-lg-3 mb-4">
    <div class="card card-border-shadow-primary h-100">
      <div class="card-body">
        <div class="d-flex align-items-center mb-2">
          <span class="avatar-initial rounded bg-label-primary me-2"><i class="bx bx-box"></i></span>
          <h4 class="mb-0">{{ $productsCount }}</h4>
        </div>
        <span class="fw-semibold d-block">Produits au catalogue</span>
        <small class="text-muted">{{ $categoriesCount }} catégorie(s)</small>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-3 mb-4">
    <div class="card card-border-shadow-warning h-100">
      <div class="card-body">
        <div class="d-flex align-items-center mb-2">
          <span class="avatar-initial rounded bg-label-warning me-2"><i class="bx bx-receipt"></i></span>
          <h4 class="mb-0">{{ $ordersCount }}</h4>
        </div>
        <span class="fw-semibold d-block">Commandes</span>
        <small class="text-{{ $ordersPending ? 'warning' : 'muted' }}">{{ $ordersPending }} à traiter</small>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-3 mb-4">
    <div class="card card-border-shadow-danger h-100">
      <div class="card-body">
        <div class="d-flex align-items-center mb-2">
          <span class="avatar-initial rounded bg-label-danger me-2"><i class="bx bx-error-circle"></i></span>
          <h4 class="mb-0">{{ $outOfStockCount + $lowStockCount }}</h4>
        </div>
        <span class="fw-semibold d-block">Alertes de stock</span>
        <small class="text-muted">{{ $outOfStockCount }} rupture(s), {{ $lowStockCount }} bas</small>
      </div>
    </div>
  </div>
  <div class="col-sm-6 col-lg-3 mb-4">
    <div class="card card-border-shadow-info h-100">
      <div class="card-body">
        <div class="d-flex align-items-center mb-2">
          <span class="avatar-initial rounded bg-label-info me-2"><i class="bx bx-user"></i></span>
          <h4 class="mb-0">{{ $clientsCount }}</h4>
        </div>
        <span class="fw-semibold d-block">Clients inscrits</span>
        <small class="text-muted">{{ $partnersCount }} partenaire(s)</small>
      </div>
    </div>
  </div>
</div>

{{-- ============ CA 6 mois + Commandes par statut ============ --}}
<div class="row">
  <div class="col-lg-8 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title m-0 me-2">Chiffre d'affaires — 6 derniers mois</h5>
        <span class="badge bg-label-success">{{ $fcfa($revenueTotal) }} cumulé</span>
      </div>
      <div class="card-body">
        <div id="revenueChart"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 mb-4">
    <div class="card h-100">
      <div class="card-header"><h5 class="card-title m-0">Commandes par statut</h5></div>
      <div class="card-body">
        <div class="text-center"><div id="ordersStatusChart"></div></div>
        <ul class="p-0 m-0 mt-3">
          @foreach($statusLabels as $key => $info)
            <li class="d-flex justify-content-between align-items-center mb-3">
              <span><span class="badge bg-label-{{ $info[1] }} me-2">&nbsp;</span>{{ $info[0] }}</span>
              <span class="fw-semibold">{{ $statusCounts[$key] }}</span>
            </li>
          @endforeach
        </ul>
      </div>
    </div>
  </div>
</div>

{{-- ============ Stock + Top produits + Catégories ============ --}}
<div class="row">
  {{-- Alertes de stock --}}
  <div class="col-md-6 col-lg-4 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title m-0 me-2">Stock à réapprovisionner</h5>
        <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-primary">Catalogue</a>
      </div>
      <div class="card-body">
        <small class="text-muted">Valeur du stock : <span class="fw-semibold">{{ $fcfa($stockValue) }}</span></small>
        <ul class="p-0 m-0 mt-3">
          @forelse($lowStockProducts as $p)
            <li class="d-flex align-items-center mb-3">
              <div class="avatar flex-shrink-0 me-3">
                <span class="avatar-initial rounded bg-label-{{ $p->quantite <= 0 ? 'danger' : 'warning' }}"><i class="bx bx-wrench"></i></span>
              </div>
              <div class="d-flex w-100 justify-content-between align-items-center">
                <div class="me-2">
                  <h6 class="mb-0">{{ Str::limit($p->nom, 28) }}</h6>
                  <small class="text-muted">{{ $p->category->name ?? 'Sans catégorie' }}</small>
                </div>
                <span class="badge bg-label-{{ $p->quantite <= 0 ? 'danger' : 'warning' }}">
                  {{ $p->quantite <= 0 ? 'Rupture' : $p->quantite . ' restant(s)' }}
                </span>
              </div>
            </li>
          @empty
            <li class="text-center text-muted py-4"><i class="bx bx-check-circle bx-lg d-block mb-2"></i>Aucune alerte de stock 🎉</li>
          @endforelse
        </ul>
      </div>
    </div>
  </div>

  {{-- Top produits vendus --}}
  <div class="col-md-6 col-lg-4 mb-4">
    <div class="card h-100">
      <div class="card-header"><h5 class="card-title m-0">Produits les plus vendus</h5></div>
      <div class="card-body">
        <ul class="p-0 m-0">
          @forelse($topProducts as $item)
            <li class="mb-3">
              <div class="d-flex justify-content-between mb-1">
                <h6 class="mb-0">{{ Str::limit(optional($item->product)->nom ?? 'Produit #'.$item->product_id, 26) }}</h6>
                <small class="fw-semibold">{{ $item->qty }} vendu(s)</small>
              </div>
              <div class="progress" style="height:6px;">
                <div class="progress-bar bg-primary" style="width: {{ round($item->qty / $topQtyMax * 100) }}%"></div>
              </div>
              <small class="text-muted">{{ $fcfa($item->ca) }}</small>
            </li>
          @empty
            <li class="text-center text-muted py-4">Aucune vente enregistrée pour l'instant.</li>
          @endforelse
        </ul>
      </div>
    </div>
  </div>

  {{-- Répartition par catégorie --}}
  <div class="col-md-6 col-lg-4 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title m-0 me-2">Produits par catégorie</h5>
        <a href="{{ route('admin.categories.index') }}" class="btn btn-sm btn-outline-primary">Gérer</a>
      </div>
      <div class="card-body">
        <ul class="p-0 m-0">
          @forelse($categoriesStats as $cat)
            <li class="mb-3">
              <div class="d-flex justify-content-between mb-1">
                <h6 class="mb-0">{{ $cat->name }}</h6>
                <small class="fw-semibold">{{ $cat->products_count }}</small>
              </div>
              <div class="progress" style="height:6px;">
                <div class="progress-bar bg-info" style="width: {{ round($cat->products_count / $catMax * 100) }}%"></div>
              </div>
            </li>
          @empty
            <li class="text-center text-muted py-4">Aucune catégorie.</li>
          @endforelse
        </ul>
      </div>
    </div>
  </div>
</div>

{{-- ============ Dernières commandes + À traiter ============ --}}
<div class="row">
  <div class="col-lg-8 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title m-0 me-2">Dernières commandes</h5>
        <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-primary">Tout voir</a>
      </div>
      <div class="table-responsive text-nowrap">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>N°</th>
              <th>Client</th>
              <th>Montant</th>
              <th>Statut</th>
              <th>Date</th>
            </tr>
          </thead>
          <tbody>
            @forelse($recentOrders as $order)
              @php $st = $statusLabels[$order->status] ?? [ucfirst($order->status), 'secondary']; @endphp
              <tr>
                <td><strong>{{ $order->order_number ?? '#'.$order->id }}</strong></td>
                <td>{{ optional($order->user)->name ?? 'Client supprimé' }}</td>
                <td>{{ $fcfa($order->total_amount) }}</td>
                <td><span class="badge bg-label-{{ $st[1] }}">{{ $st[0] }}</span></td>
                <td>{{ $order->created_at?->format('d/m/Y') }}</td>
              </tr>
            @empty
              <tr><td colspan="5" class="text-center text-muted py-4">Aucune commande pour le moment.</td></tr>
            @endforelse
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="col-lg-4 mb-4">
    {{-- À traiter --}}
    <div class="card mb-4">
      <div class="card-header"><h5 class="card-title m-0">À traiter</h5></div>
      <div class="card-body">
        <ul class="p-0 m-0">
          <li class="d-flex align-items-center justify-content-between mb-3">
            <span><i class="bx bx-time-five text-warning me-2"></i>Commandes en attente</span>
            <a href="{{ route('admin.orders.index') }}" class="badge bg-label-warning">{{ $ordersPending }}</a>
          </li>
          <li class="d-flex align-items-center justify-content-between mb-3">
            <span><i class="bx bx-store text-info me-2"></i>Partenaires à valider</span>
            <a href="{{ route('admin.partners.pending') }}" class="badge bg-label-info">{{ $partnersPending }}</a>
          </li>
          <li class="d-flex align-items-center justify-content-between mb-3">
            <span><i class="bx bx-file text-primary me-2"></i>Devis en attente</span>
            <span class="badge bg-label-primary">{{ $quotesPending }}</span>
          </li>
          <li class="d-flex align-items-center justify-content-between mb-3">
            <span><i class="bx bx-mail-send text-success me-2"></i>Cotations par email</span>
            <a href="{{ route('admin.cotations.index') }}" class="badge bg-label-success">Ouvrir</a>
          </li>
          <li class="d-flex align-items-center justify-content-between">
            <span><i class="bx bx-envelope text-secondary me-2"></i>Messages reçus</span>
            <span class="badge bg-label-secondary">{{ $messagesCount }}</span>
          </li>
        </ul>
      </div>
    </div>

    {{-- Recherches populaires --}}
    <div class="card">
      <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="card-title m-0 me-2">Recherches populaires</h5>
        <a href="{{ route('admin.search') }}" class="btn btn-sm btn-outline-primary">Détails</a>
      </div>
      <div class="card-body">
        @forelse($popularSearches as $s)
          <span class="badge bg-label-dark mb-2 me-1">{{ $s->query }} <span class="text-muted">({{ $s->total }})</span></span>
        @empty
          <p class="text-muted mb-0">Aucune recherche enregistrée.</p>
        @endforelse
      </div>
    </div>
  </div>
</div>

@endsection

@section('page-script')
<script>
  (function () {
    const primary = '#696cff', success = '#71dd37', warning = '#ffab00', info = '#03c3ec', danger = '#ff3e1d';

    // Chiffre d'affaires (6 mois)
    const revenueEl = document.querySelector('#revenueChart');
    if (revenueEl) {
      new ApexCharts(revenueEl, {
        chart: { type: 'bar', height: 300, toolbar: { show: false } },
        series: [{ name: 'CA (F CFA)', data: @json($revenueChartData) }],
        colors: [primary],
        plotOptions: { bar: { borderRadius: 6, columnWidth: '45%' } },
        dataLabels: { enabled: false },
        xaxis: { categories: @json($revenueChartLabels) },
        yaxis: { labels: { formatter: v => new Intl.NumberFormat('fr-FR').format(Math.round(v)) } },
        tooltip: { y: { formatter: v => new Intl.NumberFormat('fr-FR').format(Math.round(v)) + ' F CFA' } },
        grid: { borderColor: '#eee' }
      }).render();
    }

    // Commandes par statut (donut)
    const statusEl = document.querySelector('#ordersStatusChart');
    if (statusEl) {
      const data = [{{ $ordersPending }}, {{ $ordersShipped }}, {{ $ordersDelivered }}, {{ $ordersCancelled }}];
      if (data.reduce((a, b) => a + b, 0) > 0) {
        new ApexCharts(statusEl, {
          chart: { type: 'donut', height: 200 },
          series: data,
          labels: ['Nouvelles', 'Expédiées', 'Livrées', 'Annulées'],
          colors: [warning, info, success, danger],
          legend: { show: false },
          dataLabels: { enabled: false },
          plotOptions: { pie: { donut: { labels: { show: true, total: { show: true, label: 'Total', formatter: () => '{{ $ordersCount }}' } } } } }
        }).render();
      } else {
        statusEl.innerHTML = '<p class="text-muted py-5">Aucune commande.</p>';
      }
    }
  })();
</script>
@endsection
