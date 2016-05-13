<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Session;
use App\User;

class UserController extends Controller
{
    public function index()
    {
      $repoUser = new User;

      $users = $repoUser->getPaginated();

      $total_record = $users->total();

      $page_title = trans('user.list');

      return view('admin.user.list', compact('users', 'page_title', 'total_record'));
    }

    public function popUp(User $user)
    {
      $stat = $user->stat();

      return view('admin.user.popup', compact('user', 'stat'));
    }
}
