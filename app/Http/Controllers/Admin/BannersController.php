<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Banner;
use Session;
use Image;
class BannersController extends Controller
{
    public function banners(){
		Session::put('page','banner');
		$bannersData = Banner::get()->toArray();
		return view('admin.banner.banners')->with(['controller'=>'Banners','banners'=>$bannersData]);
	}
	public function bannersStatus($id){
		if(!empty($id)){
			$bannersStatus = Banner::where('id',$id)->first()->toArray();
			$status = $bannersStatus['status'];
			if($status ==1){
				$status = 0;
			}else{
				$status = 1;
			}
			Banner::where('id',$id)->update(['status'=>$status]);
			return back()->with('success','Your banner updated successfully');
		}
	}
	
	public function bannersDelete($id){
		if(!empty($id)){
			$bannerImg = Banner::where('id',$id)->first()->toArray();
			if(!empty($bannerImg['image'])){
				$bannerImgPath ="admin_images/banner_images/";
				if(file_exists($bannerImgPath.$bannerImg['image']))
				unlink($bannerImgPath.$bannerImg['image']);
			}
			Banner::where('id',$id)->delete();
			return back()->with('success','Your banner deleted successfully');
		}
	}
	
	public function banneAddEdit(Request $request, $id=null){
		$title = "Banner";		
		if(!empty($id)){
			$button = "Edit Banner";
			$id = $id;
			$banner = Banner::find($id);
			$viewBanner = Banner::find($id)->toArray();
			$message = "Your banner updated successfully";
			
		}else{
			$button = "Add Banner";
			$viewBanner ="";
			$banner = new Banner;
			$message = "Your banner added successfully";
		}
		
		if($request->isMethod('post')){
			$formData = $request->all();
			$this->validate($request, [
			'bannerImage' => 'mimes:jpeg,jpg,png,gif|max:10000',
			'bannerTitle' => 'required',
			'bannerLinks' => 'required',
			'bannerAlts' => 'required',
			]);
			
			//File image upload in folder
			if($request->hasFile('bannerImage')){
			$image = $request->file('bannerImage');
			$bannerImage = time().'.'.$image->getClientOriginalExtension();
			$path = "admin_images/banner_images/".$bannerImage;
			Image::make($image)->resize('1170','480')->save($path);
			$banner->image = $bannerImage;
			}
			//save or update query
			
			$banner->links = $formData['bannerLinks'];
			$banner->title = $formData['bannerTitle'];
			$banner->alt = $formData['bannerAlts'];
			$banner->status = 1;
			$banner->save();
			return redirect('/admin/banners')->with('success', $message);
		}
		
		
		return view('admin.banner.add_edit_banners')->with(['controller'=>'controller','title'=>$title,'button'=>$button,'id'=>$id,'banner'=>$viewBanner]);
	}
	
}
