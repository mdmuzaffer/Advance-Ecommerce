<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use App\Product;
use App\Section;
use App\Brand;
use App\Category;
use App\ProductsAttribute;
use App\ProductsImage;
use DB;
use Session;
use Image;
use File;
use App\AdminsRole;
use Auth;
class ProductController extends Controller
{
    // Product list
	public function product(){
		Session::put('page','product');
		//$productData = Product::with('category','section')->get();
		
		$productData = Product::with(['category'=>function($query){
			$query->select('id','category_name');
			},'section'=>function($query){$query->select('id','name');}])->get();
		
		$productsData = json_decode(json_encode($productData));
		// added code for page access
		$productModule = AdminsRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'model'=>'product'])->count();
		if(isset($productModule) && $productModule==0){
			return back()->with('success','You are not accessible for this product page');
		}else{
			$productAccess = AdminsRole::where(['admin_id'=>Auth::guard('admin')->user()->id,'model'=>'product'])->get()->toArray();
		}
		
		return view('admin.product.products')->with(['controller'=>'product','productsData'=>$productsData,'page_type'=>'admin_page','productAccess'=>$productAccess]);
		
	}
	
	// product status change
	public function productStatus(Request $request){
		$data = $request->all();
		
		$id = $data['id'];
		$status = $data['status'];
		if($status ==0){
			DB::table('products')->where('id', $id)->update(['status' => 1]);
			return true;
		}else{
			DB::table('products')->where('id', $id)->update(['status' => 0]);
			return true;
		}
	}
	
	//delete category
	public function productDelete(Request $request, $id = null){
		//echo $id;
		DB::table('products')->where('id', $id)->delete();
		return back()->with('success','Your product deleted successfully');
	}
	
	// add edit product
	public function addEditProduct(Request $request, $id =null){
		if($id ==""){
			$title = "Add Product";
			$product = new Product;
			$productData =[];
			$message = "Your product added successfully!";
		}else{
			$productData = Product::get()->where('id',$id)->first()->toArray();
			/* echo"<pre>";print_r($productData);echo"<pre>"; die(); */
			$title = "Edit Product";
			$product = Product::find($id);
			$message = "Your product updated successfully!";
			
		}
		$dataSection = Section::get();
		
		//added filter in dynamically product table
		$productFilter = Product::productFilter();
		$fabricArray = $productFilter['fabricArray'];
		$sleeveArray = $productFilter['sleeveArray'];
		$patternArray = $productFilter['patternArray'];
		$fitArray = $productFilter['fitArray'];
		$occasionArray = $productFilter['occasionArray'];
		
		$categories = Section::with('categories')->get();
		$categories = json_decode(json_encode($categories));
		$dataBrand = Brand::where('status',1)->get();
		$dataBrands = json_decode(json_encode($dataBrand));
		/* echo"<pre>";
		print_r($dataBrands);
		die; */
		
		if($request->isMethod('post')){
			$dataProduct = $request->all();
			
			$rules = [
				'product_name' => 'required|regex:/^[\pL\s\-]+$/u',
				'product_code' => 'required|regex:/^[\w-]*$/',
				'product_color' => 'required',
				'product_price' => 'required|numeric',
				'product_discount' => 'required',
				'product_weight' => 'required',
				'description' => 'required',
				'wash_care' => 'required',
				'meta_title' => 'required',
				'meta_description' => 'required',
				'meta_keywords' => 'required'
			];
			
			$messages = [
				'product_name.required' => 'Add product name',
				'product_name.regex' => 'Add product name with alfa',
				'product_code.regex' => 'Add product code with alfanumeric',
				'product_color.required' => 'Add product color',
				'product_price.numeric' => 'Add product price in numeric',
				'product_discount.required' => 'Add product discount',
				'product_weight.required' => 'Add product weight',
				'description.required' => 'Add product description',
				'wash_care.required' => 'Add product washcare',
				'meta_title.required' => 'Add product meta title',
				'meta_description.required' => 'Add product meta description',
				'meta_keywords.required' => 'Add product meta keyword',
			];
			
			$this->validate($request, $rules, $messages);
			
			if(empty($dataProduct['featured'])){
				 $dataProduct['featured'] = "No";
			}
			if(empty($dataProduct['status'])){
				$dataProduct['status'] = 0;
			}
			//image upload
			$image = $request->file('productImage');
			if(!empty($image)){
			$imageName = time().'.'.$image->getClientOriginalExtension();
			$path_large = "admin_images/product_images/large/".$imageName;
			$path_medium = "admin_images/product_images/medium/".$imageName;
			$path_small = "admin_images/product_images/small/".$imageName;
			
			Image::make($image)->save($path_large);
			Image::make($image)->resize('500','500')->save($path_medium);
			Image::make($image)->resize('250','250')->save($path_small);
			$product->main_image = $imageName;
			}
			//video upload
			
			$productvideo = $request->file('productvideo');
			if(empty($productvideo)){
				$videoName = "NULL";
			}else{
			$videoName = time().'.'.$productvideo->getClientOriginalExtension();
			$path = "admin_images/product_videos/";
            $productvideo->move($path, $videoName);
			$product->product_video = $videoName;
			}
			
			//save product in table
			$categoryDetails = Category::find($dataProduct['category_id'])->toArray();
			$product->product_name = $dataProduct['product_name'];
			$product->category_id = $dataProduct['category_id'];
			$product->section_id = $categoryDetails['section_id'];
			$product->product_code = $dataProduct['product_code'];
			
			$product->product_color = $dataProduct['product_color'];
			$product->product_price = $dataProduct['product_price'];
			$product->product_discount = $dataProduct['product_discount'];
			$product->product_gst = $dataProduct['product_gst'];
			$product->product_weight = $dataProduct['product_weight'];
			$product->group_code = $dataProduct['group_code'];
			$product->description = $dataProduct['description'];
			$product->wash_care = $dataProduct['wash_care'];
		
			//$product->product_video = $videoName;
			//$product->main_image = $imageName;
			
			$product->is_featured = $dataProduct['featured'];
			$product->status = $dataProduct['status'];
			$product->fabric = $dataProduct['fabric'];
			$product->pattern = $dataProduct['pattern'];
			$product->sleeve = $dataProduct['sleeve'];
			$product->fit = $dataProduct['fit'];
			$product->occasion = $dataProduct['occasion'];
			$product->meta_title = $dataProduct['meta_title'];
			$product->meta_description = $dataProduct['meta_description'];
			$product->meta_keywords = $dataProduct['meta_keywords'];
			$product->brand_id = $dataProduct['brand'];
			$product->save();
			return back()->with('success',$message);
			
		}
		return view('admin.product.add_edit_product')->with(['controller'=>'product','dataSection'=>$dataSection,'title'=>$title,
		'page_type'=>'admin_page','fabricArray'=>$fabricArray,'sleeveArray'=>$sleeveArray,'patternArray'=>$patternArray,
		'fitArray'=>$fitArray,'occasionArray'=>$occasionArray,'categories'=>$categories,'productData'=>$productData,'dataBrands'=>$dataBrands]);
		
	}
	
	
	//delete product image
	public function productImageDelete($image,$id){
		if(!empty($id || $image)){
			Product::where('id', $id)->update(['main_image' => 'NULL']);
			$small_image_path = "/admin_images/product_images/small/".$image;
			$medium_image_path = "/admin_images/product_images/medium/".$image;
			$large_image_path = "/admin_images/product_images/large/".$image;
			//small image delete
			if(file_exists(public_path($small_image_path))) {
				unlink(public_path($small_image_path));
			}
			//medium image delete
			if(file_exists(public_path($medium_image_path))) {
				unlink(public_path($medium_image_path));
			}
			//large image delete
			if(file_exists(public_path($large_image_path))) {
				unlink(public_path($large_image_path));
			}
			return back()->with('success','Your product image deleted successfully');
			
		}else{
			echo "some thing wrong in images";
		}
		
	}
	
	//delete product video
	public function productvideoDelete($video,$id){
		if(!empty($id || $video)){
			Product::where('id', $id)->update(['product_video' => 'NULL']);
			$videos_path = "/admin_images/product_videos/".$video;
			//video delete
			if(file_exists(public_path($videos_path))) {
				unlink(public_path($videos_path));
			}
			return back()->with('success','Your product video deleted successfully');
			
		}else{
			echo "some thing wrong in images";
		}
		
	}
	
	// add attributes
	public function addAttributes(Request $request,$id){
		if($request->isMethod('post')){
			$data = $request->all();
			$data = array_slice($data, 2);
			$dataAttributes = array_chunk($data, 4, true);
			if(empty($dataAttributes)){
				return redirect()->back()->with('success','Fill Attribute Form Click on Plush Icon');
			}
			foreach($dataAttributes as $key=>$attr){
				$ProductsAttribut = new ProductsAttribute;
				$field = array_keys($attr);
				
				$productSkuCount = ProductsAttribute::where(['sku'=>$attr[$field[0]],'product_id'=>$id])->count();
				if($productSkuCount >0){
					$message = "SKU already added use another new SKU !";
					session::flash('error_message', $message);
					return redirect()->back();
				}
				$productSizeCount = ProductsAttribute::where(['size'=>$attr[$field[1]],'product_id'=>$id])->count();
				if($productSizeCount >0){
					$message = "Size already added use another new size !";
					session::flash('error_message', $message);
					return redirect()->back();
				}
				$productPriceCount = ProductsAttribute::where(['price'=>$attr[$field[2]],'product_id'=>$id])->count();
				if($productPriceCount >0){
					$message = "Price already added use another new price !";
					session::flash('error_message', $message);
					return redirect()->back();
				}
				$ProductsAttribut->product_id = $id;
				$ProductsAttribut->sku = $attr[$field[0]];
				$ProductsAttribut->size = $attr[$field[1]];
				$ProductsAttribut->price = $attr[$field[2]];
				$ProductsAttribut->stock = $attr[$field[3]];
				$ProductsAttribut->save();
			}
			
			return back()->with('success','Your product attribute added successfully');
		}
		$productData = Product::select('id','product_name','product_code','product_color','main_image','product_price')->with('attribute')->find($id)->toArray();
		$title ="Add Attributes";
		return view('admin.product.add_attribute')->with(['controller'=>'product','productData'=>$productData,'title'=>$title,'page_type'=>'admin_porduct_attributes']);
	}
	
	//update attribute
	public function updateAttributes(Request $request){
		$data = $request->all();
		if(!empty($data['AttId'])){
			foreach($data['AttId'] as $key=>$attr){
				if(!empty($data['AttId'][$key])){
					ProductsAttribute::where('id',$data['AttId'][$key])->update(['sku'=>$data['sku'][$key],'size'=>$data['size'][$key],'price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
				}
			}
			return back()->with('success','Your product attribute updated successfully');
		}
		return back()->with('success','Your product attribute not added !');
	}
	//update attribute ststus
	public function productAttrStatus(Request $request,$id = null){
		$attrData = ProductsAttribute::where('id',$id)->first();
		$attrData = json_decode(json_encode($attrData));
		if(!empty($attrData)){
			if($attrData->status ==1){
					$current_status =0;
					ProductsAttribute::where('id',$id)->update(['status'=>$current_status]);
			}else{
				$current_status =1;
				ProductsAttribute::where('id',$id)->update(['status'=>$current_status]);
			}
		}
		return back()->with('success','Your attribute status updated successfully');
	}
	
	// product attribute delete
	public function productAttrDelete($id =null){
		ProductsAttribute::where('id', $id)->delete();
		return back()->with('success','Your attribute deleted');
	}
	
	//add products images
	public function addImages(Request $request,$id=null){
	$productImages = Product::with('images')->select('id','product_name','product_code','product_color','main_image')->find($id);
	$productImages = json_decode(json_encode($productImages));
	
		if($request->hasFile('productsImage')){
			$images = $request->file('productsImage');
			//$extension = $images[0]->getClientOriginalExtension();
			//$originalName = $images[0]->getClientOriginalName();
			
			foreach($images as $key =>$image){
				$ProductsImage = new ProductsImage;
				
				$extension = $image->getClientOriginalExtension();
				$name = $image->getClientOriginalName();
				$rename = rand(111,9999).time().'.'.$extension;
				
				//image upload
				$path_large = "admin_images/images_product/large/".$rename;
				$path_medium = "admin_images/images_product/medium/".$rename;
				$path_small = "admin_images/images_product/small/".$rename;
				
				Image::make($image)->save($path_large);
				Image::make($image)->resize('520','720')->save($path_medium);
				Image::make($image)->resize('320','420')->save($path_small);
				
				//save images in table
				$ProductsImage->product_id =$id;
				$ProductsImage->image =$rename;
				$ProductsImage->status =1;
				$ProductsImage->save();
				
			}
			return redirect()->back()->with('success', 'Product images added successfully!');
			
		}
	
	return view('admin.product_images.product_images')->with(['controller'=>'products_images','productImages'=>$productImages,'page_type'=>'porduct_images']);
	}
	// change product image status
	public function productImageStatus(Request $request,$id=null){
		$imageStatus = ProductsImage::find($id)->toArray();
		if($imageStatus['status'] ==1){
			$status =0;
		}else{
			$status =1;
		}
		ProductsImage::where('id',$id)->update(['status'=>$status]);
		return back()->with('success','Your product status update');
	}
	
	// Delete product images
	public function producstImageDelete(Request $request,$id=null){
		if(!empty($id)){
			$ProImages = ProductsImage::find($id)->toArray();
			//echo"<pre>";print_r($ProImages);die();
			$delImage = $ProImages['image'];
			$small_image_path = "/admin_images/images_product/small/".$delImage;
			$medium_image_path = "/admin_images/images_product/medium/".$delImage;
			$large_image_path = "/admin_images/images_product/large/".$delImage;
			//small image delete
			if(file_exists(public_path($small_image_path))) {
				unlink(public_path($small_image_path));
			}
			//medium image delete
			if(file_exists(public_path($medium_image_path))) {
				unlink(public_path($medium_image_path));
			}
			//large image delete
			if(file_exists(public_path($large_image_path))) {
				unlink(public_path($large_image_path));
			}
		
		ProductsImage::where('id', $id)->delete();
		return back()->with('success','Your product image deleted !');
		}
	}
}
