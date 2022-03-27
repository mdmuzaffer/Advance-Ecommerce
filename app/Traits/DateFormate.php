<?php

namespace App\Traits;

trait DateFormate
{

   function changeDateFormate($mydate)
    {
	//Trails only work in controller
       $date = date('d-m-Y', strtotime($mydate));
	   return $date;
	   //return $data = "This is the test";
    }

}
