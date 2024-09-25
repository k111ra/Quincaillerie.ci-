<?php

namespace App\Providers;

use App\Models\Category;
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
    // Partager les catégories avec toutes les vues
    View::composer('*', function ($view) {
      $categories = Category::with('children', 'products')->get();
      $view->with('categories', $categories);
    });
  }
}
