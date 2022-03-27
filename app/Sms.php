<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sms extends Model
{
    public static function sendSms($message,$mobile){
	
	$request ="";
	$param['authorization']="KZtlNu9n6aYXzm5rPgQWHIx2UyshvTdi0E7bLDRCJkwoO3B1qjm5nd4SKhQEbLRPIroxVAzcsOBgTiH7";
	$param['sender_id'] = 'FSTSMS';
	$param['message']= $message;
	$param['numbers']= $mobile;
	$param['language']="english";
	$param['route']="p";

	foreach($param as $key=>$val) {
		$request.= $key."=".urlencode($val);
		$request.= "&";
	}
	$request = substr($request, 0, strlen($request)-1);
	$url ="https://www.fast2sms.com/dev/bulkV2?".$request;
	$ch = curl_init($url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	$curl_scraped_page = curl_exec($ch);
	curl_close($ch);
	
	}
}
