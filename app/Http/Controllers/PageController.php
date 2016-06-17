<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class PageController extends Controller
{
    public function about()
    {
      $page_title = trans('meta_data.about_title');

      $page_desc = trans('meta_data.about_desc');

      return view('pages.about', compact('page_title', 'page_desc'));
    }
}
