<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Auth;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','address','city','state','country','pincode','mobile','google_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
	
	public static function UserAddresses(){
		$user_id = Auth::user()->id;
		$UserAddress = User::where('id',$user_id)->get()->toArray();
		return $UserAddress;
	}
	
	public static function userStatus($id){
		$userStatus = User::select('status')->where('id',$id)->get();
		return $userStatus;
	}
	
}
