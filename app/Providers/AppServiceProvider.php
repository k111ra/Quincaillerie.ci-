<?php

namespace App\Providers;

use App\Models\Category;
use App\View\Components\GuestLayout;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
  /**
   * Register any application services.
   *
   * @return void
   */
  public function register()
  {
    //
  }

  /**
   * Bootstrap any application services.
   *
   * @return void
   */
  public function boot()
  {
    Blade::component('guest-layout', GuestLayout::class);
    View::composer('*', function ($view) {
      $categories = Category::with('children', 'products')->get();
      $view->with('categories', $categories);
    });
  }
}
