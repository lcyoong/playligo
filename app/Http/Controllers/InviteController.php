<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\EnterInvite;
use App\Invite;

class InviteController extends Controller
{
    public function enter(EnterInvite $request)
    {
      $code = $request->input('inv_code');

      // add to session
      session()->put('invite_code', $code);

      // redirect
      return response()->json(['redirect'=> url('home'), 'message'=> trans('messages.enter_invite_successful')]);

    }
}
