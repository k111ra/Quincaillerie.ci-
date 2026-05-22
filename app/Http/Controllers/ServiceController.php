<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;


class ServiceController extends Controller
{
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    $services = Service::where('status', 'approved')->get();
    $categories = Category::all();
    return view('offers')->with([
      'services' => $services,
      'categories' => $categories
    ]);
  }
  /**
   * Display the specified resource.
   *
   * @param  int  $id
   * @return \Illuminate\Http\Response
   */
  public function show($slug)
  {
    $service = Service::where('slug', $slug)
      ->where('status', 'approved')
      ->with(['user.partner'])
      ->first();

    if (!$service) {
      abort(404);
    }

    //   if (!$service) {
    //     // Handle the case where the service with the given slug is not found, e.g., show a 404 page.
    //     abort(404);
    // }

    return view('single-offer', compact('service'));
  }
}
