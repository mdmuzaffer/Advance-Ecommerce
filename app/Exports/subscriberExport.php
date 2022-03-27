<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\withHeadings;
use App\NewsletterSubscriber;
class subscriberExport implements withHeadings, FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {	// export table
        //return NewsletterSubscriber::all();
		// select with headings
		//return NewsletterSubscriber::all();
		$subscribersData = NewsletterSubscriber::select('id','email','created_at')->where('status',1)->orderBy('id','DESC')->get();
		return $subscribersData;
    }
	
	public function headings():array{
		return['Id','Email','Subscriber On'];
	}
}
