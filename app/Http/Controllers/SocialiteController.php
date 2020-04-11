<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Socialite;
use App\User;

class SocialiteController extends Controller
{
    //function para redirecionar al cuenta social
    public function redirectToProvider($social)
    {
        return Socialite::driver($social)->redirect();
    }

    public function handleProviderCallback($social)
    {
        $auth_user = Socialite::driver($social)->user();
        if($auth_user){
            if(!empty($auth_user->email)){
                $user = User::where('email', $auth_user->email)->first();
                if($user){
                    Auth::login($user, true);
                }else{
                    $user = User::create([
                                'name' => $auth_user->name,
                                'email' => $auth_user->email ?? trim(str_ireplace(' ', '.', $auth_user->name)).'.'.rand(1001, 9999).'@loginweb.dev',
                                'password' => Hash::make('password'),
                                'avatar' => $auth_user->avatar,
                            ]);

                    Auth::login($user, true);
                }
                return redirect('/');
            }
        }else{
            return 'Ops..!! Hubo Problema el usuario necesita un email.!';
        }
    }


   /*  public function redirectToProvider()
    {
        return Socialite::driver('github')->redirect();
    } */

    /**
     * Obtain the user information from GitHub.
     *
     * @return \Illuminate\Http\Response
     */
   /*  public function handleProviderCallback()
    {
        $user = Socialite::driver('github')->user();

        // $user->token;
    } */

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
