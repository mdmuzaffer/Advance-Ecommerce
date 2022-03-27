<?php
namespace App\Exports;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\withHeadings;
use App\User;

class UsersExport implements withHeadings, FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
       // return User::all();
	   $userData =  User::select('id','name','email','address','city','state','country','pincode','mobile','status','created_at','updated_at','google_id')->where('status',0)->get();
	   return $userData;
    }
	
	public function headings():array{
		return['Id','Name','Email','Address','City','State','Country','Pincode','Mobile','Status','Created_at','Update_at','Google_id'];
	}
}
