<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Currency;
use Session;
class CurrencyController extends Controller
{
    public function currencyPagesList(){
	
		Session::put('page','cms');
		$currencyData = Currency::get()->toArray();
		return view('admin.currency.currency')->with(['controller'=>'currency','currencyData'=>$currencyData,'page_type'=>'admin_page']);
	
	}
	
	public function currencyStatus(Request $request){
		if($request->ajax()){
			$data = $request->all();
			$id = $data['id'];
			$status = $data['status'];
			if($status ==1){
				$statusvalue = 0;
			}else{
				$statusvalue = 1;
			}
			$Currency = Currency::find($id);
			$Currency->status = $statusvalue;
			$Currency->save();
			return response()->json(['status'=>200],200);
			
		}
	}
	
	public function addeditcurrency(Request $request,$id=Null){
	
		if($id ==""){
			$title ="Add Currency";
			$button ="Add Currency";
			$Currency = new Currency;
			$message = "Currency added successfully!";
		}else{
			$title ="Edit Currency";
			$button ="Update Currency";
			$Currency = Currency::find($id);
			$message = "Currency updated successfully!";
		}
		if($request->isMethod('post')){
		$CurrencyData = $request->all();
		
		$rules = [
				'currency_code' => 'required',
				'exchange_rate' => 'required',
			];
			
			$messages = [
				'currency_code.required' => 'Add Currency code',
				'exchange_rate.required' => 'Add Currency exchange rate'
			];
			
			$this->validate($request, $rules, $messages);
		
		//For save query
		$Currency->currency_code = $CurrencyData['currency_code'];
		$Currency->exchange_rate = $CurrencyData['exchange_rate'];
		$Currency->status =1;
		$Currency->save();
		return back()->with('success', $message);
		}
		return view('admin.currency.add_edit_currency')->with(['controller'=>'currency','title'=>$title,'button'=>$button,'id'=>$id,'currency'=>$Currency,'page_type'=>'admin_page']);
	
	}
	
	public function deleteCurrency($id){
	
		Currency::where('id', $id)->delete();
		return back()->with('success','Currency deleted successfully !');
	}
	
}
