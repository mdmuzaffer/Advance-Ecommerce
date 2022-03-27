<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\SocialAccountService;
use Socialite;
use Auth;
use Exception;
use App\User;
use Session;
use DB;

class SocialAuthController extends Controller
{
    public function redirectToGoogle(){
		//return Socialite:: driver('google')->stateless()->user();
		//return Socialite::deriver('google')->stateless()->redirect();
		return Socialite::driver('google') ->setScopes(['openid', 'email'])->redirect();
	}
	
	public function handleGoogleCallback(SocialAccountService $service){
		$user = $service->findOrCreate(Socialite::deriver('google')->stateless()->user());
		auth()->login($user);
		return redirect('/');
	}
}
