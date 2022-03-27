<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public function category(){
		return $this->belongsTo('App\Category', 'category_id')->select('id','category_name','status','category_image','url');
	}
	public function section(){
		return $this->belongsTo('App\Section', 'section_id')->select('id','name','status');
	}
	public function attribute(){
		return $this->hasMany('App\ProductsAttribute','product_id');
	}
	public function images(){
	return $this->hasMany('App\ProductsImage','product_id');
	}
	public function brand(){
		return $this->belongsTo('App\Brand', 'brand_id');
	}
	public static function productFilter(){
		$productFilter['fabricArray'] = ['Cotton','Polyester','wool','Pure cotton'];
		$productFilter['sleeveArray'] = ['Full Sleeve','Half Sleeve','Short Sleeve','Sleeveless'];
		$productFilter['patternArray'] = ['Checked','Plain','Printed','Self','Solid'];
		$productFilter['fitArray'] = ['Regular','Slim'];
		$productFilter['occasionArray'] = ['Casual','Formal'];
		return $productFilter;
	}
	public static function getDiscountPrice($product_id){
		$proDetails = Product::select('product_price','product_discount','category_id')->where('id',$product_id)->first()->toArray();
		$catDetails = Category::select('category_discount')->where('id',$proDetails['category_id'])->first()->toArray();
		if($proDetails['product_discount'] >0){
			//add to calculate product discount from product
			$discountedPrice = $proDetails['product_price'] -($proDetails['product_price']*$proDetails['product_discount']/100);
			//$discountedPrice = $discountedPrice;
		}elseif($catDetails['category_discount'] >0){
			//add to calculate category discount from category
			$discountedPrice = $proDetails['product_price'] -($proDetails['product_price']*$catDetails['category_discount']/100);
			//die('cat discount');
		}else{
			$discountedPrice = 0;
		}
		return $discountedPrice;
	}
	
	//get discount from attribute table using ajax
	public static function getDiscountAttrPrice($product_id,$size){
		$attrDetails = ProductsAttribute::where(['product_id'=>$product_id,'size'=>$size])->first()->toArray();
		$proDetails = Product::select('product_discount','category_id')->where('id',$product_id)->first()->toArray();
		$catDetails = Category::select('category_discount')->where('id',$proDetails['category_id'])->first()->toArray();
		if($proDetails['product_discount'] >0){
			//add to calculate product discount from product
			$discountedPrice = $attrDetails['price'] -($attrDetails['price']*$proDetails['product_discount']/100);
		}elseif($catDetails['category_discount'] >0){
			//add to calculate category discount from category
			$discountedPrice = $attrDetails['price'] -($attrDetails['price']*$catDetails['category_discount']/100);
		}else{
			$discountedPrice = 0;
		}
		return array(['price'=>$discountedPrice,'size'=>$size]);

	}
	//Order products save in order product table.
	public static function orderProducts($productId){
		return $orderProduct = Product::select('product_code','product_name','product_color')->where('id',$productId)->first()->toArray();
	}
	
	
	// get product image for order details page
	public static function productImage($products_id){
		$productsImage = Product::select('main_image')->where('id',$products_id)->first()->toArray();
		return $productsImage['main_image'];
	}
	
	public static function productStatus($porduct_id){
		$productStatus = Product::where(['id'=>$porduct_id,'status'=>1])->count();
		return $productStatus;
	}
	
	public static function ProductsAttributeStatus($product_id,$size){
		$attributeStatus = ProductsAttribute::where(['product_id'=>$product_id,'size'=>$size,'status'=>1])->count();
		return $attributeStatus;
	}

	public static function productCategoryStatus($product_id){
		$catId = Product::select('category_id')->where('id',$product_id)->first()->toArray();
		$cateStatus = Category::where(['id'=>$catId,'status'=>1])->count();
		return $cateStatus;
	}

}
