<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Socialite\Contracts\User as ProviderUser;

class SocialAccountService
{
    public function findOrCreate(ProviderUser $providerUser){
		$account = SocialAccount::where('provider','google')->where('provider_user_id',$providerUser->getId())->first();
		if($account){
			return $account->user;
		}else{
			$account = new SocialAccount([
			'provider_user_id'=>$providerUser->getId(),
			'provider'=>'google'
			]);
		
			$user = User::whereEmail($providerUser->getEmail())->first();
			if(!$user){
				$user = User::create([
				'email'=>$providerUser->getEmail(),
				'name'=>$providerUser->getName(),
				'status '=>1
				]);
			}
			$account->user()->associate($user);
			$account->save();
			return $user;
		}
	}
}
