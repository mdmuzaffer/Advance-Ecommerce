<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;


use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{
    use Notifiable;
	protected $gard = 'admin';
	protected $fillable = ['name','email','password','type','mobile','image','status','created_at','updated_at'];
	protected $hidden =['remember_token'];
}
