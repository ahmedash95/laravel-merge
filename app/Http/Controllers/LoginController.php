<?php

namespace App\Http\Controllers;

use Socialite;
use App\User;
use Auth;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login() {
    	return Socialite::driver('github')->redirect();
    }

    public function doLogin() {
    	$gitub = Socialite::driver('github')->user();
    	$email = $gitub->email;
    	$user = User::where('email',$email)->first();
    	if(!$user) {
    		$user = User::create([
    			'name' => $gitub->name,
    			'email' => $gitub->email,
    			'password' => uniqid($gitub->email),
    		]);
    	}

    	Auth::login($user);

    	return redirect('/');
    }
}
