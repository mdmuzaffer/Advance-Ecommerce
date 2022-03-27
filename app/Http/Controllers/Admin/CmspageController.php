<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\CmsPage;
use Session;

class CmspageController extends Controller
{
    public function cmsPagesList(){
		Session::put('page','cms');
		$cmsPages = CmsPage::get()->toArray();
		return view('admin.pages.cms_page')->with(['controller'=>'cmspage','cmsPages'=>$cmsPages,'page_type'=>'admin_page']);
	}
	
	public function cmspageStatus(Request $request){
		if($request->ajax()){
			$data = $request->all();
			$id = $data['id'];
			$status = $data['status'];
			if($status ==1){
				$statusvalue = 0;
			}else{
				$statusvalue = 1;
			}
			$CmsPage = CmsPage::find($id);
			$CmsPage->status = $statusvalue;
			$CmsPage->save();
			return response()->json(['status'=>200],200);
			
		}
	}
	
	public function addeditcmsPage(Request $request, $id=null){
		if($id ==""){
			$title ="Add Cms";
			$button ="Add Cms";
			$CmsPage = new CmsPage;
			$message = "Cms page added successfully!";
		}else{
			$title ="Edit Cms page";
			$button ="Update Cms";
			$CmsPage = CmsPage::find($id);
			$message = "Cms page updated successfully!";
		}
		if($request->isMethod('post')){
		$CmsPageData = $request->all();
		
		$rules = [
				'title' => 'required',
				'description' => 'required',
				'url' => 'required',
				'meta_title' => 'required',
				'meta_description' => 'required',
				'meta_keywords' => 'required',
			];
			
			$messages = [
				'title.required' => 'Add cms page title',
				'description.required' => 'Add cms page description',
				'url.required' => 'Add cms page url',
				'meta_title.required' => 'Add cms page meta title',
				'meta_description.required' => 'Add cms page meta description',
				'meta_keywords.required' => 'Add cms page meta keyword'
			];
			
			$this->validate($request, $rules, $messages);
		
		//For save query
		$CmsPage->title = $CmsPageData['title'];
		$CmsPage->description = $CmsPageData['description'];
		$CmsPage->url = $CmsPageData['url'];
		$CmsPage->meta_title = $CmsPageData['meta_title'];
		$CmsPage->meta_description = $CmsPageData['meta_description'];
		$CmsPage->meta_keywords = $CmsPageData['meta_keywords'];
		$CmsPage->status =1;
		$CmsPage->save();
		return back()->with('success', $message);
		}
		return view('admin.pages.add_edit_cms_page')->with(['controller'=>'Cms','title'=>$title,'button'=>$button,'id'=>$id,'Cmspage'=>$CmsPage,'page_type'=>'admin_page']);
	}
	// delete cms pages
	public function deletecmsPage($id){
		CmsPage::where('id', $id)->delete();
		return back()->with('success','Your cms page deleted successfully !');
	}
}
