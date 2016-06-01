<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Requests\EditPassword;
use App\User;

class PasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new password controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => ['update', 'edit']]);
    }

    public function edit()
    {
      return view('auth.passwords.edit');
    }

    public function update(EditPassword $request)
    {
      User::find(auth()->user()->id)->update(['password' => bcrypt($request->input('password'))]);

      return response()->json(['message'=> 'Password changed successfully']);
    }
}
