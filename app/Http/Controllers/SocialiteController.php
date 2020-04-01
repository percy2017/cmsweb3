<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Socialite;
use App\User;
use Illuminate\Support\Facades\Auth;
class SocialiteController extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();

        // $user->token;
    }

    function impresionate($id)
    {
        $other_user = User::find($id);
        Auth::user()->impersonate($other_user);
        return redirect('admin')->with([
            'message'    => 'Login con '.$other_user->name,
            'alert-type' => 'success',
        ]);
    }
}
