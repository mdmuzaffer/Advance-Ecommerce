<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Category;
use App\Section;
use App\Mytest;
use App\AdminsRole;
use DB;
use Session; 
use Image;
use File;
use Auth;
class CategoryContoller extends Controller
{
    public function category(){
		Session::put('page','category');
		$category = Category::with(['section','parentCategory'])->get();
		$category = json_decode(json_encode($category));
		
		$categoryModule = AdminsRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'model'=>'category'])->count();
		if(isset($categoryModule) && $categoryModule==0){
			return back()->with('success','You are not accessible for this category page');
		}else{
			$categoryAccess = AdminsRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'model'=>'category'])->get()->toArray();
		}
		return view('admin.category.category')->with(['controller'=>'category','categoryData'=>$category,'page_type'=>'admin_page','categoryAccess'=>$categoryAccess]);
	}
	
	public function addEditCategory(Request $request, $id = null){
		if($id==""){
			if($request->isMethod('post')){
				$data = $request->all();
				//echo"<pre>";print_r($data);echo"</pre>";die;
				$ret = Validator::make($request -> input(), [
					 'categoryName'=>'required',
					 'categoryParent_id'=>'required|numeric',
					 'CategoryDiscount'=>'required',
					 'CategoryDescripton'=>'required',
					 'MetaDescripton'=>'required',
					 'section'=>'required',
					 'categoryImage'=>'mimes:jpeg,jpg,png|max:5',
					 'url'=>'required',
					 'metaTitle'=>'required',
					 'metakeywords'=>'required'
				]);
				if($ret -> fails()){
					return Redirect('/admin/add-edit-category')->withInput()->withErrors($ret);
			}else{
				$image = $request->file('categoryImage');
				$imageName = time().'.'.$image->getClientOriginalExtension();
				$path = "admin_images/category_images/".$imageName;
				Image::make($image)->resize('400','600')->save($path);
				
				$Category = new Category;
				$Category->parent_id = $data['categoryParent_id'];
				$Category->section_id = $data['section'];
				$Category->category_name = $data['categoryName'];
				$Category->category_image = $imageName;
				$Category->category_discount = $data['CategoryDiscount'];
				$Category->description = $data['CategoryDescripton'];
				$Category->url = $data['url'];
				$Category->meta_title = $data['metaTitle'];
				$Category->meta_description = $data['MetaDescripton'];
				$Category->meta_keywords = $data['metakeywords'];
				$Category->status = 1;
				$Category->save();
				
				return back()->with('success','Your category added successfully');
			}
				
			}
			
			$dataSection = Section::get();
			return view('admin.category.add_category')->with(['controller'=>'category','dataSection'=>$dataSection,'page_title'=>'Add Category','page_type'=>'admin_page']);
		}else{
			$category = Category::get()->where('id',$id)->toArray();
			$dataSection = Section::get();
			/* echo"<pre>";
			print_r($category);
			die; */
			
			return view('admin.category.edit_category')->with(['controller'=>'category','category'=>$category,'dataSection'=>$dataSection, 'page_title'=>'Edit Category','page_type'=>'admin_page']);
		}
	}
	//change category with ajax
	public function changeCategory(Request $request){
		if($request->isMethod('post')){
				$data = $request->all();
				$section_id = $data['id'];
				$changCat = Category::get()->where('section_id',$section_id)->where('status',1)->toArray();
				
				return view('admin.category.append_category')->with(['controller'=>'category','changCat'=>$changCat,'page_type'=>'admin_page']);
				/* $html ="";
				foreach($changCat as $cat){
					$html.='<option data-select2-id="30">'.$cat['category_name'].'</option>';
				}
				return $html; */
		}
	}
	
	//edit category 
	public function editCategory(Request $request){
		$data = $request->all();
		$image = $request->file('categoryImage');
		$imageName = time().'.'.$image->getClientOriginalExtension();
		$path = "admin_images/category_images/".$imageName;
		Image::make($image)->resize('400','600')->save($path);
		Category::where('id', $data['categoryId'])->update([
			'parent_id' => $data['categoryParent_id'],
			'section_id' => $data['section'],
			'category_name' => $data['categoryName'],
			'category_image' => $imageName,
			'category_discount' => $data['CategoryDiscount'],
			'description' => $data['CategoryDescripton'],
			'url' => $data['url'],
			'meta_title' => $data['metaTitle'],
			'meta_description' => $data['MetaDescripton'],
			'meta_keywords' => $data['metakeywords'],
			'status' => 1
		]);
		return back()->with('success','Your category updated successfully');
		
	}
	
	//delete category
	public function deleteCategory(Request $request, $id = null){
		DB::table('categories')->where('id', $id)->delete();
		return back()->with('success','Your category deleted successfully');
	}
	//delete category image
	public function categoryImageDelete($image,$id){
		if(!empty($id || $image)){
			Category::where('id', $id)->update(array('category_image' => 'Null'));
			$image_path = "/admin_images/category_images/".$image; 
			if(file_exists(public_path($image_path))) {
				unlink(public_path($image_path));
			}
			return back()->with('success','Your category image deleted successfully');
			
		}else{
			echo "some thing wrong in images";
		}
		
	}
	// change category status
	public function categoryStatus(Request $request, $id = null){
		if(!empty($id)){
			$category = Category::find($id);
			$category = json_decode(json_encode($category));
			//echo"<pre>";print_r($catData);echo"<pre>";
			if(!empty($category->status) && $category->status =1){
				$status ="0";
			}else{
				$status =1;
			}
			Category::where('id',$id)->update(['status' =>$status]);
			return back()->with('success','Your category status updated successfully');
		}
	}
}
