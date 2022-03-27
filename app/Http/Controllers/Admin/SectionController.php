<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Section;
use DB;
use Session;
class SectionController extends Controller
{
    public function section(){
		Session::put('page','admin-section');
		$dataSection = Section::get();
		return view('admin.section.sections')->with(['controller'=>'section','dataSection'=>$dataSection,'page'=>'section','page_type'=>'admin_page']);
	}
	
	public function sectionStatus(Request $request){
		$data = $request->all();
		$id = $data['id'];
		$status = $data['status'];
		if($status ==0){
			DB::table('sections')->where('id', $id)->update(['status' => 1]);
			return true;
		}else{
			DB::table('sections')->where('id', $id)->update(['status' => 0]);
			return true;
		}
	}
	
}
