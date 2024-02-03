<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\CarouselController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ContactPageController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\LoginPageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\ShopController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

$controller_path = 'App\Http\Controllers';

// Routes publiques
Route::get('/', [IndexController::class, 'index'])->name('index');
Route::get('/contact', [ContactPageController::class, 'index'])->name('contact');
Route::get('/services', [ServiceController::class, 'index'])->name('services');
Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');
Route::get('/shop/{slug}', [ShopController::class, 'shop'])->name('shop');
Route::get('/product/{slug}', [ProductController::class, 'singleProduct'])->name('product');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::get('/admin/login', [LoginPageController::class, 'admin'])->name('admin.login');



// Routes nécessitant une authentification
Route::middleware(['auth'])->group(function () use ($controller_path) {
  // layout
  Route::get('/layouts/without-menu', $controller_path . '\layouts\WithoutMenu@index')->name('layouts-without-menu');
  Route::get('/layouts/without-navbar', $controller_path . '\layouts\WithoutNavbar@index')->name('layouts-without-navbar');
  Route::get('/layouts/fluid', $controller_path . '\layouts\Fluid@index')->name('layouts-fluid');
  Route::get('/layouts/container', $controller_path . '\layouts\Container@index')->name('layouts-container');
  Route::get('/layouts/blank', $controller_path . '\layouts\Blank@index')->name('layouts-blank');

  // pages
  Route::get('/pages/account-settings-account', $controller_path . '\pages\AccountSettingsAccount@index')->name('pages-account-settings-account');
  Route::get('/pages/account-settings-notifications', $controller_path . '\pages\AccountSettingsNotifications@index')->name('pages-account-settings-notifications');
  Route::get('/pages/account-settings-connections', $controller_path . '\pages\AccountSettingsConnections@index')->name('pages-account-settings-connections');
  Route::get('/pages/misc-error', $controller_path . '\pages\MiscError@index')->name('pages-misc-error');
  Route::get('/pages/misc-under-maintenance', $controller_path . '\pages\MiscUnderMaintenance@index')->name('pages-misc-under-maintenance');

  // authentication
  Route::get('/auth/login-basic', $controller_path . '\authentications\LoginBasic@index')->name('auth-login-basic');
  Route::get('/auth/register-basic', $controller_path . '\authentications\RegisterBasic@index')->name('auth-register-basic');
  Route::get('/auth/forgot-password-basic', $controller_path . '\authentications\ForgotPasswordBasic@index')->name('auth-reset-password-basic');

  // cards
  Route::get('/cards/basic', $controller_path . '\cards\CardBasic@index')->name('cards-basic');

  // User Interface
  Route::get('/ui/accordion', $controller_path . '\user_interface\Accordion@index')->name('ui-accordion');
  Route::get('/ui/alerts', $controller_path . '\user_interface\Alerts@index')->name('ui-alerts');
  Route::get('/ui/badges', $controller_path . '\user_interface\Badges@index')->name('ui-badges');
  Route::get('/ui/buttons', $controller_path . '\user_interface\Buttons@index')->name('ui-buttons');
  Route::get('/ui/carousel', $controller_path . '\user_interface\Carousel@index')->name('ui-carousel');
  Route::get('/ui/collapse', $controller_path . '\user_interface\Collapse@index')->name('ui-collapse');
  Route::get('/ui/dropdowns', $controller_path . '\user_interface\Dropdowns@index')->name('ui-dropdowns');
  Route::get('/ui/footer', $controller_path . '\user_interface\Footer@index')->name('ui-footer');
  Route::get('/ui/list-groups', $controller_path . '\user_interface\ListGroups@index')->name('ui-list-groups');
  Route::get('/ui/modals', $controller_path . '\user_interface\Modals@index')->name('ui-modals');
  Route::get('/ui/navbar', $controller_path . '\user_interface\Navbar@index')->name('ui-navbar');
  Route::get('/ui/offcanvas', $controller_path . '\user_interface\Offcanvas@index')->name('ui-offcanvas');
  Route::get('/ui/pagination-breadcrumbs', $controller_path . '\user_interface\PaginationBreadcrumbs@index')->name('ui-pagination-breadcrumbs');
  Route::get('/ui/progress', $controller_path . '\user_interface\Progress@index')->name('ui-progress');
  Route::get('/ui/spinners', $controller_path . '\user_interface\Spinners@index')->name('ui-spinners');
  Route::get('/ui/tabs-pills', $controller_path . '\user_interface\TabsPills@index')->name('ui-tabs-pills');
  Route::get('/ui/toasts', $controller_path . '\user_interface\Toasts@index')->name('ui-toasts');
  Route::get('/ui/tooltips-popovers', $controller_path . '\user_interface\TooltipsPopovers@index')->name('ui-tooltips-popovers');
  Route::get('/ui/typography', $controller_path . '\user_interface\Typography@index')->name('ui-typography');

  // extended ui
  Route::get('/extended/ui-perfect-scrollbar', $controller_path . '\extended_ui\PerfectScrollbar@index')->name('extended-ui-perfect-scrollbar');
  Route::get('/extended/ui-text-divider', $controller_path . '\extended_ui\TextDivider@index')->name('extended-ui-text-divider');

  // icons
  Route::get('/icons/boxicons', $controller_path . '\icons\Boxicons@index')->name('icons-boxicons');

  // form elements
  Route::get('/forms/basic-inputs', $controller_path . '\form_elements\BasicInput@index')->name('forms-basic-inputs');
  Route::get('/forms/input-groups', $controller_path . '\form_elements\InputGroups@index')->name('forms-input-groups');

  // form layouts
  Route::get('/form/layouts-vertical', $controller_path . '\form_layouts\VerticalForm@index')->name('form-layouts-vertical');
  Route::get('/form/layouts-horizontal', $controller_path . '\form_layouts\HorizontalForm@index')->name('form-layouts-horizontal');

  // tables
  Route::get('/tables/basic', $controller_path . '\tables\Basic@index')->name('tables-basic');



    Route::prefix('admin')->group(function () {
        // Routes pour l'administration
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
        Route::get('/users', [LoginController::class, 'users'])->name('admin.users');

        // Routes pour les catégories
        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index'])->name('admin.categories.index');
            Route::get('/create', [CategoryController::class, 'create'])->name('admin.categories.create');
            Route::post('/store', [CategoryController::class, 'store'])->name('admin.categories.store');
            Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('admin.categories.edit');
            Route::post('/{category}/destroy', [CategoryController::class, 'destroy'])->name('admin.categories.destroy');
            Route::put('/{category}', [CategoryController::class, 'update'])->name('admin.categories.update');
        });

        // ... Autres routes d'administration

        // Routes pour les produits
        Route::prefix('products')->group(function ()  {
            Route::get('/', [ProductController::class, 'index'])->name('admin.products.index');
            Route::get('/create', [ProductController::class, 'create'])->name('admin.products.create');
            Route::post('/store', [ProductController::class, 'store'])->name('admin.products.store');
            Route::get('/{product}/edit', [ProductController::class, 'edit'])->name('admin.products.edit');
            Route::put('/{product}', [ProductController::class, 'update'])->name('admin.products.update');
            Route::delete('/{id}', [ProductController::class, 'destroy'])->name('admin.products.destroy');
        });

        // ... Autres routes d'administration

        // Routes pour les tags
        Route::prefix('tags')->group(function ()  {
            Route::post('/', [TagController::class, 'store'])->name('admin.tags.store');
            Route::get('/', [TagController::class, 'index'])->name('admin.tags.index');
            Route::get('/create', [TagController::class, 'create'])->name('admin.tags.create');
            Route::get('/{tag}/edit', [TagController::class, 'edit'])->name('admin.tags.edit');
            Route::put('/{tag}', [TagController::class, 'update'])->name('admin.tags.update');
            Route::post('/{tag}/destroy', [TagController::class, 'destroy'])->name('admin.tags.destroy');
        });

        // ... Autres routes d'administration

        // Routes pour les articles de blog
        Route::prefix('posts')->group(function (){
            Route::get('/', [PostController::class, 'index'])->name('admin.blogs.index');
            Route::get('/create', [PostController::class, 'create'])->name('admin.posts.create');
            Route::post('/store', [PostController::class, 'store'])->name('admin.posts.store');
        });

        // Routes pour les services
        // Route::prefix('services')->group(function () use ($controller_path) {
            Route::get('/services', [ServiceController::class, 'create'])->name('admin.services.create');
            Route::post('/store', [ServiceController::class, 'store'])->name('admin.services.store');
            Route::get('/{service}/edit', [ServiceController::class, 'edit'])->name('admin.services.edit');
            Route::delete('/{service}', [ServiceController::class, 'destroy'])->name('admin.services.destroy');
            Route::put('/services/{id}', [ServiceController::class, 'update'])->name('admin.services.update');


        // });


    });

    // ... Autres routes middleware auth
});

Auth::routes();
