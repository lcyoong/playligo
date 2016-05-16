<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Auth;
use Session;
use App\User;

use App\Traits\ControllerTrait;

class UserController extends Controller
{
  use ControllerTrait;

  public function __construct()
  {
      $this->parm['search'] = 'src_user';
  }

    public function index()
    {
      $repoUser = new User;

      $search = session()->get($this->parm['search']);

      $users = $repoUser->filter($search)->getPaginated();

      $total_record = $users->total();

      $page_title = trans('user.list');

      $filter = 'admin.user.filter';

      return view('admin.user.list', compact('users', 'page_title', 'total_record', 'filter', 'search'));
    }

    public function popUp(User $user)
    {
      $stat = $user->stat();

      return view('admin.user.popup', compact('user', 'stat'));
    }
}
