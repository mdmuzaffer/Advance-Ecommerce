<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use App\Traits\ProductCount;
use App\Category;
use App\Product;
use App\ProductsAttribute;
use App\Cart;
use App\Country;
use App\State;
use App\Coupon;
use App\User;
use App\DeliveryAddress;
use App\Order;
use App\OrdersProduct;
use App\ShippingCharge;
use App\codePincode;
use App\Currency;
use App\Rating;
use App\Wishlist;
use Session;
use Validator;
use Auth;
use DB;
use Response;
class ProductsController extends Controller
{
	use ProductCount;
	
    public function listing(Request $request){
		
		//get current url path after public or domain
		$url = $request->path();
		
		if($request->ajax()){
			$ajaxData = $request->all();
			
			//echo"<pre>";print_r($ajaxData);die;
			
			$ajaxurl = $ajaxData['url'];
			
			$catCount = Category::where(['url'=>$ajaxurl,'status'=>1])->count();
			if($catCount >0){
				$catDetails = Category::categoryDetails($url);
				$categoryProduct = Product::with('brand')->whereIn('category_id',$catDetails['catsId'])->where('status',1);
				
				//filter method product of fabric
				if(isset($ajaxData ['fabric']) && !empty($ajaxData['fabric'])){
					$categoryProduct->whereIn('products.fabric',$ajaxData ['fabric']);
				}
				//filter method product of sleeve
				if(isset($ajaxData ['sleeve']) && !empty($ajaxData['sleeve'])){
					$categoryProduct->whereIn('products.sleeve',$ajaxData ['sleeve']);
				}
				//filter method product of pattern
				if(isset($ajaxData ['pattern']) && !empty($ajaxData['pattern'])){
					$categoryProduct->whereIn('products.pattern',$ajaxData ['pattern']);
				}
				//filter method product of fit
				if(isset($ajaxData ['fit']) && !empty($ajaxData['fit'])){
					$categoryProduct->whereIn('products.fit',$ajaxData ['fit']);
				}
				//filter method product of occasion
				if(isset($ajaxData ['occasion']) && !empty($ajaxData['occasion'])){
					$categoryProduct->whereIn('products.occasion',$ajaxData ['occasion']);
				}
				//If selected sort method product
				if(isset($ajaxData ['sort']) && !empty($ajaxData['sort'])){
					if($ajaxData['sort'] =="latest_product"){
					$categoryProduct = $categoryProduct->orderBy('id','DESC');
					}elseif($ajaxData['sort'] =="product_name_az"){
						$categoryProduct = $categoryProduct->orderBy('product_name','DESC');
					}elseif($ajaxData['sort'] =="product_name_za"){
						$categoryProduct = $categoryProduct->orderBy('product_name','ASC');
					}elseif($ajaxData['sort'] =="lowest_price"){
						$categoryProduct = $categoryProduct->orderBy('product_price','ASC');
					}elseif($ajaxData['sort'] =="height_price"){
						$categoryProduct = $categoryProduct->orderBy('product_price','DESC');
					}
				}else{
					$categoryProduct = $categoryProduct->orderBy('id','DESC');
				}
				$categoryProduct = $categoryProduct->paginate(30);
				return view('front.product.ajax_product_list')->with(['controller'=>'preoduct','page_type'=>'front_page','categoryProduct'=>$categoryProduct,'catDetails'=>$catDetails,'url'=>$url]);
			}else{
			abort(404);
			}
			
		}else{
			// product filter array added
			$productFilter = Product::productFilter();
			$fabricArray = $productFilter['fabricArray'];
			$sleeveArray = $productFilter['sleeveArray'];
			$patternArray = $productFilter['patternArray'];
			$fitArray = $productFilter['fitArray'];
			$occasionArray = $productFilter['occasionArray'];
			$url = $request->path();
			
			$catCount = Category::where(['url'=>$url,'status'=>1])->count();
			
			
				if(isset($_REQUEST['search_products']) && !empty($_REQUEST['search_products'])){
					
					$serPro = $request->get('search_products');
					$catDetails['categoryDetails']['url'] = $serPro;
					$catDetails['categoryDetails']['category_name'] = $serPro;
					$catDetails['categoryDetails']['description'] = "Search results for ".$serPro;
					
					$categoryProduct = Product::with('brand')->where('product_name','like','%'.$serPro.'%')
					->orWhere('product_code','like','%'.$serPro.'%')
					->orWhere('product_color','like','%'.$serPro.'%')
					->orWhere('description','like','%'.$serPro.'%')
					->where('status',1);
					$categoryProduct = $categoryProduct->get();
					
					return view('front.product.products')->with(['controller'=>'preoduct','page_type'=>'front_page','categoryProduct'=>$categoryProduct,'catDetails'=>$catDetails,'url'=>$url,'page_list'=>'product_list']);
					
				}
				
			
			if($catCount >0){
				$catDetails = Category::categoryDetails($url);
				$categoryProduct = Product::with('brand')->whereIn('category_id',$catDetails['catsId'])->where('status',1);
				$categoryProduct = $categoryProduct->orderBy('id','DESC');
				$categoryProduct = $categoryProduct->paginate(30);
				
				//echo"<pre>";print_r($categoryProduct); die;
				
				return view('front.product.products')->with(['controller'=>'preoduct','page_type'=>'front_page','categoryProduct'=>$categoryProduct,'catDetails'=>$catDetails,'url'=>$url,'fabricArray'=>$fabricArray,'sleeveArray'=>$sleeveArray,'patternArray'=>$patternArray,
		'fitArray'=>$fitArray,'occasionArray'=>$occasionArray,'page_list'=>'product_list']);
			}else{
			abort(404);
			}
		}
	}
	// single product page details
	public function productDetails($code,$id){
		
		$proDetails = Product::with(['category','section','attribute'=>function($query){$query->where('status',1);},'images','brand'])->find($id)->toArray();
		
		$latestProduct = Product::where('category_id',$proDetails['category']['id'])->where('id','!=', $proDetails['id'])->get()->toArray();
		
		$groupProduct = Product::select('id','main_image','product_code')->where('id','!=', $proDetails['id'])->where('group_code','!=', NULL)->get()->toArray();
		$currencyData = Currency::get()->toArray();
		$userRating = Rating::with('user')->where(['product_id'=>$id,'status'=>1])->orderBy('id', 'DESC')->get()->toArray();
		$atingSum = Rating::where(['product_id'=>$id,'status'=>1])->sum('rating');
		$atingCount = Rating::where(['product_id'=>$id,'status'=>1])->count();
		if($atingSum >0 && $atingCount >0){
		$averageRating = round($atingSum/$atingCount,2);
		}else{
		$averageRating =0;
		}
		return view('front.product.product_details')->with(['controller'=>'preoduct','proDetails'=>$proDetails,'page_type'=>'front_page','latestProduct'=>$latestProduct,'groupProduct'=>$groupProduct,'currencyData'=>$currencyData,'usersrating'=>$userRating,'averageRating'=>$averageRating]);
		
	}
	
	//change price of attribute size according
	public function getAttributePrice(Request $request){
		if($request->ajax()){
		$ajaxData = $request->all();
		$prodAttr = ProductsAttribute::where(['product_id'=>$ajaxData['mainProductId'],'id'=>$ajaxData['productId'],'size'=>$ajaxData['size']])->get()->first()->toArray();
		$disAttrPrice = Product::getDiscountAttrPrice($ajaxData['mainProductId'],$ajaxData['size']);
		$disAttrPrice = json_decode(json_encode($disAttrPrice));
		$currencyData = Currency::get()->where('status',1)->toArray();
		
		$currencyHtml ="";
		if(!empty($currencyData)){
			
			foreach($currencyData as $currency){
				$currencyHtml.= "<p>".$currency['currency_code'] .":<span>".round($prodAttr['price']/$currency['exchange_rate'],2)."</span><p>";
			}
		}else{
			$currencyHtml ="";
		}
		
			if(count($prodAttr) > 0){
			 return response()->json(['success'=>1,"productAttribute"=>$prodAttr,"discount"=>$disAttrPrice,"currencyData"=>$currencyHtml],200);
			}else{
				return response()->json(['success'=>0],200);
			}
			return response()->json(['error'=>0,'message'=>'Result not found'],404);
		}
	}
	
	//Add to cart
	public function addToCart(Request $request){
		if($request->isMethod('post')){
		$cartData = $request->all();
		
		$request->validate([
        'size' => 'required',
        'quty' => 'required',
		]);
	
		$attrData = ProductsAttribute::where(['product_id'=>$cartData['product_id'],'size'=>$cartData['size']])->get()->first()->toArray();
		$attributeStatus = Product::ProductsAttributeStatus($cartData['product_id'],$cartData['size']);
		$productStatus = Product::productStatus($cartData['product_id']);
		$productCatStatus = Product::productCategoryStatus($cartData['product_id']);
		
			if($attributeStatus < 1){
				return back()->with('errors','Your added cart product size is not available');
			}
		
			if($productStatus < 1){
				return back()->with('errors','Your added cart product is not available');
			}
			
			if($attrData['stock']< $cartData['quty']){
				return back()->with('errors','Required Quantity is not available');
			}
			$session_id = Session::get('session_id');
			if(empty($session_id)){
			$session_id = Session::getId();
			Session::put('session_id',$session_id);
			}
			
			$cartCount = Cart::where(['product_id'=>$cartData['product_id'], 'size'=>$cartData['size'], 'session_id'=>$session_id])->count();
			if($cartCount >0){
				return back()->with('errors','Already added product in your cart !');
			}
			
			
			if(Auth::check()){
				$user_id = Auth::user()->id;
			}else{
				$user_id =0;
			}
			
			$cart = new Cart;
			$cart->session_id = $session_id;
			$cart->user_id = $user_id;
			$cart->product_id = $cartData['product_id'];
			$cart->size = $cartData['size'];
			$cart->quantity = $cartData['quty'];
			$cart->save();
			return redirect('cart')->with('success','Product has been added in your cart!');
		}
	}
	
	public function GSTCalculate(){
		$cartItems = Cart::cartItems();
		$totalGST = 0;
		foreach($cartItems as $key=>$items){
			$totalPrise = $items['quantity']*$items['product']['product_price'];
			$GstPersent = $items['product']['product_gst'];
			$totalGST = $totalGST + round($totalPrise*$GstPersent/100,2);
		}
		return $totalGST;
	}
	
	Public function addCart(){
		$cartItems = Cart::cartItems();
		$totalGST = $this->GSTCalculate();
		return view('front.cart.products_summary')->with(['controller'=>'product','cartItems'=>$cartItems, 'totalGST'=>$totalGST,'page_type'=>'front_page']);
	}
	
	public function updatecartitemsQwt(Request $request){
	
		if($request->ajax()){
			$itemsData = $request->all();
			$cartItem = Cart::find($itemsData['proId'])->toArray();
			$totalGST = $this->GSTCalculate();
			
			$cartItem['product_id'];
			$cartItem['size'];
			$attributeItem = ProductsAttribute::select('stock')->where(['product_id'=>$cartItem['product_id'],'size'=>$cartItem['size']])->first()->toArray();
			if($itemsData['newqwt']>$attributeItem['stock']){
				$cartItems = Cart::cartItems();
				$totalCartItems = totalCartItems();
				return response()->json(['status'=>false, 'totalCartItems'=>$totalCartItems, 'page_type'=>'front_page', 'view'=>(String)View::make('front.cart.cart_list')->with(compact('cartItems'))->with(compact('totalGST'))]);
			}else{
				Cart::where('id',$itemsData['proId'])->update(['quantity'=>$itemsData['newqwt']]);
				$cartItems = Cart::cartItems();
				$totalCartItems = totalCartItems();
				return response()->json(['status'=>true, 'totalCartItems'=>$totalCartItems, 'page_type'=>'front_page', 'view'=>(String)View::make('front.cart.cart_list')->with(compact('cartItems'))->with(compact('totalGST'))]);
			}
		}
	
	}
	
	public function deletecartitemsQwt(Request $request){
		if($request->ajax()){
		$deleteData = $request->all();
			if(!empty($deleteData['proId'])){
				$cart = Cart::find($deleteData['proId']);
				$cart->delete();
				$cartItems = Cart::cartItems();
				$totalCartItems = totalCartItems();
				$totalGST = $this->GSTCalculate();
				return response()->json(['status'=>true, 'totalCartItems'=>$totalCartItems, 'page_type'=>'front_page', 'view'=>(String)View::make('front.cart.cart_list')->with(compact('cartItems'))->with(compact('totalGST'))]);
			}
		}
	}
	
	public function coupon(Request $request){
		if($request->ajax()){
			$coupon = $request->all();
			$couponCount = Coupon::where('coupon_code',$coupon['coupon'])->count();
			if($couponCount >0){
				$couponCode = Coupon::where('coupon_code',$coupon['coupon'])->first()->toArray();
				if($couponCode['status'] ==0){
					$message = 'Your added coupon is not active';
					return response()->json(['status'=>true,'message'=>$message]);
				}
				$current_date = date('Y-m-d');
				if($couponCode['expery_date'] < $current_date){
					$message = 'Your added coupon is expiry';
					return response()->json(['status'=>true,'message'=>$message]);
				}
				$cartItems = Cart::cartItems();
				$userArr = explode(',', $couponCode['users']);
				$categoriesArr = explode(',', $couponCode['categories']);
	
				foreach($userArr as $users){
					$usergetId = User::select('id')->where('email',$users)->first()->toArray();
					$userId[]= $usergetId;
				}
				
				$id = [];
				foreach($userId as $key=>$ids){
					$id[$key] = $ids['id'];
					
				}
				
				foreach($cartItems as $key=>$item){
					if(!(in_array($item['user_id'], $id))){
						$message = 'This coupon is not for you!';
						return response()->json(['status'=>true,'message'=>$message]);
					}
				}
				
				foreach($cartItems as $key=>$item){
					if(!(in_array($item['product']['category_id'], $categoriesArr))){
						$message = 'This coupon is not valid for your product!';
						return response()->json(['status'=>true,'message'=>$message]);
				
					}
				}
				
				//Single coupon type code apply single time
				if($couponCode['coupon_type'] =="single"){
					$couponapplyCount =  Order::where(['coupon_code'=>$coupon['coupon'],'user_id'=>Auth::user()->id])->count();
					if($couponapplyCount >= 1){
					
						if(Session::get('coupon_amount')){
							session()->forget('coupon_code');
							session()->forget('coupon_amount');
							session()->forget('amount_type');
						}
						$message = 'This coupon already applied by you!';
						return response()->json(['status'=>true,'message'=>$message]);
					}
				}
				/* if(Session::get('coupon_amount')){
					session()->forget('coupon_code');
					session()->forget('coupon_amount');
					session()->forget('amount_type');
				} */
				
				Session::put('coupon_code', $couponCode['coupon_code']);
				Session::put('coupon_amount', $couponCode['amount']);
				Session::put('amount_type', $couponCode['amount_type']);
				
				$message = 'Coupon code successfully applied, You are available for discount!';
				
				return response()->json(['status'=>true,'message'=>$message]);
				
			}else{
				return response()->json(['status'=>false,'message'=>'Your added coupon is not valid']);
			}
		}
	}
	
	//check out of the product controller
	public function checkOut(Request $request){
		if($request->isMethod('post')){
			$data = $request->all();	
			if($data['checkoutToata'] ==0){
				return back()->with('success', 'Your cart is empty !');
			}
			
			//Check delivery address selected ?
			if(!empty($data['useraddress'])){
				$userData = explode('-',$data['useraddress']);
				$userId = $userData[0];
				$userAddress = $userData[1];
					if($userAddress =="us"){
						$userdeliveryAddress = User::UserAddresses();
					}else{
						$userdeliveryAddress = DeliveryAddress::DeliveryAddresses();
					}
			}else{
				return back()->with('success', 'Please select your delivery address');
			}
			//check payment method selected ?
			if(!empty($data['payment'])){
				if($data['payment'] =="COD"){
					$payment = "COD";
					}elseif($data['payment'] =="PayPal"){
						$payment = "PayPal";
					}else{
						$payment = "PayUmoney";
					}
			}else{
			return back()->with('success', 'Please select your payment method');
			}
			
			//Begin Transaction
			DB::beginTransaction();
			
			$couponCode = Session::get('coupon_code');
			$couponDiscount = Session::get('couponDiscount');
			//save new product order of the users
			$order = new Order;
			$order->user_id = Auth::user()->id;
			$order->name = $userdeliveryAddress[0]['name'];
			$order->address = $userdeliveryAddress[0]['address'];
			$order->city = $userdeliveryAddress[0]['city'];
			$order->state = $userdeliveryAddress[0]['state'];
			$order->country = $userdeliveryAddress[0]['country'];
			$order->pincode = $userdeliveryAddress[0]['pincode'];
			$order->mobile = $userdeliveryAddress[0]['mobile'];
			$order->email = Auth::user()->email;
			$order->shipping_charges =$data['delivery_charge'];
			$order->product_gst =$data['product_gst'];
			$order->coupon_code = $couponCode;
			$order->coupon_amount = $couponDiscount;
			$order->order_status = "New Order";
			$order->payment_method = $payment;
			$order->payment_gatway = "";
			$order->grand_total = $data['checkoutToata'];
			$order->save();
			//Get the last Inserted order id
			$lastinsertedId = DB::getPdo()->lastInsertId();
			
			//Put in the session grand total and order Id for thank you page
			Session::put('order_id',$lastinsertedId);
			Session::put('grand_total',$data['checkoutToata']);
			
			//cart Items save for products order
			$cartItem = Cart::where('user_id', Auth::user()->id)->get()->toArray();
			foreach($cartItem as $items){
				$ordersProduct = new OrdersProduct;
				$ordersProduct->order_id = $lastinsertedId;
				$ordersProduct->user_id = Auth::user()->id;
				$ordersProduct->product_id = $items['product_id'];
				
				$orderProduct = Product::orderProducts($items['product_id']);
				
				$ordersProduct->product_code = $orderProduct['product_code'];
				$ordersProduct->product_name = $orderProduct['product_name'];
				$ordersProduct->product_color = $orderProduct['product_color'];
				
				$getDiscountAttrPrice = Product::getDiscountAttrPrice($items['product_id'],$items['size']);
				if(empty($getDiscountAttrPrice[0]['price'])){
					//if discount not added in products it return price 0 
					$getDiscountAttrPrice = ProductsAttribute::where(['product_id'=>$items['product_id'],'size'=>$items['size']])->first()->toArray();
					$getDiscountAttrPrice = array(['price'=>$getDiscountAttrPrice['price'],'size'=>$getDiscountAttrPrice['size']]);
					$ordersProduct->product_price = $getDiscountAttrPrice[0]['price'];
					$ordersProduct->product_size = $getDiscountAttrPrice[0]['size'];
				}else{
					$ordersProduct->product_price = $getDiscountAttrPrice[0]['price'];
					$ordersProduct->product_size = $getDiscountAttrPrice[0]['size'];
				}
				$ordersProduct->product_qty = $items['quantity'];
				$ordersProduct->save();
			}
			
			//Commit Transaction
			DB::commit();
			
			if($data['payment'] =="COD"){
				$message = "Dear customer, Your order '.$lastinsertedId.' has been successfully place with E-comm Muzaffer. 
				We will intimate you once your order is shipped";
				$orderDetails = Order::with('orders_products')->where('id',$lastinsertedId)->get()->toArray();
				$userDetails = User::where('id',$orderDetails[0]['user_id'])->get()->toArray();
				$email = Auth::user()->email;
				
				//store management reduce product quantity
				if($data['payment'] =="COD"){
					foreach($orderDetails[0]['orders_products'] as $pro){
						$attributeStock = ProductsAttribute::where(['product_id'=>$pro['product_id'],'size'=>$pro['product_size']])->get()->toArray();
						$totalStock = $attributeStock[0]['stock']-$pro['product_qty'];
						ProductsAttribute::where(['product_id'=>$pro['product_id'],'size'=>$pro['product_size']])->update(['stock'=>$totalStock]);
					}
				}
				
				$messageData =[
					'email'=>$email,
					'name'=>Auth::user()->name,
					'order_id'=>$lastinsertedId,
					'orderDetails'=>$orderDetails,
					'userDetails'=>$userDetails
				];
				Mail::send('front.email.order', $messageData, function($message) use($email){
					$message->to($email)->subject('Place order - E-commerce of Muzaffer!');
				});
				
				//delete cart products
				Cart::where('user_id', Auth::user()->id)->delete();
				return redirect('/thank');
				
			}elseif($data['payment'] =="PayPal"){
				return redirect('/paypal');
				
			}elseif($data['payment'] =="PayUmoney"){
				return redirect('/payumoney');
			}
			return back()->with('success', 'Replace your order successfully with order no = '.$lastinsertedId);
		}
		$cartItems = Cart::cartItems();
		$deliveryAddress = DeliveryAddress::DeliveryAddresses();
		$userAddress = User::UserAddresses();
		$totalGST = $this->GSTCalculate();
		return view('front.cart.checkout')->with(['controller'=>'product','totalGST'=>$totalGST,'cartItems'=>$cartItems,'deliveryAddress'=>$deliveryAddress,'userAddress'=>$userAddress,'page_type'=>'front_page']);
	}
	
	public function shippingChargeCountry(Request $request){
	
		$data = $request->all();
		$users = explode('-', $data['user_type']);
		$userId = $users[0];
		$addressTYpe = $users[1];
		
		if($addressTYpe =="de"){
			$deliveryAddress = DeliveryAddress::DeliveryAddresses();
			$country = $deliveryAddress[0]['country'];
			
			//check pin available for delivery
			$pincode = $deliveryAddress[0]['pincode'];
			$pincount = codePincode::where('pincode',$data['pin_code'])->count();
			if($pincount>0){
				$pinfind = "true";
			}else{
				$pinfind = "false";
			}
			
			$cartItems = Cart::cartItems();
			$totalWeight = 0;
			foreach($cartItems as $weight){
				$totalWeight = $totalWeight + $weight['quantity']*$weight['product']['product_weight'];
			}
			
			$shipCharge = ShippingCharge::countryCharge($totalWeight, $country);
			
			if(Session::get('delivery_charge')){
				session()->forget('delivery_charge');
			}
			Session::put('delivery_charge', $shipCharge);
			
			return Response::json(array('success' => true,'charge'=>$shipCharge,'pincode'=>$pinfind));
		}
		
		if($addressTYpe =="us"){
			$userAddress = User::UserAddresses();
			$country = $userAddress[0]['country'];
			
			//check pin available for delivery
			$pincode = $userAddress[0]['pincode'];
			$pincount = codePincode::where('pincode',$data['pin_code'])->count();
			if($pincount>0){
				$pinfind = "true";
			}else{
				$pinfind = "false";
			}
			
			$cartItems = Cart::cartItems();
			$totalWeight = 0;
			foreach($cartItems as $weight){
				$totalWeight = $totalWeight + $weight['quantity']*$weight['product']['product_weight'];
			}
			$shipCharge = ShippingCharge::countryCharge($totalWeight, $country);

			if(Session::get('delivery_charge')){
				session()->forget('delivery_charge');
			}
			Session::put('delivery_charge', $shipCharge);
			
			return Response::json(array('success' => true,'charge'   =>$shipCharge,'pincode'=>$pinfind)); 
		}
	
	}
	
	// thank you page
	public function thankYou(){
		//delete cart products
		Cart::where('user_id', Auth::user()->id)->delete();
		
		if(!empty(Session::get('order_id') && Session::get('grand_total'))){
			return view('front.order.thank');
		}else{
			return redirect('/cart');
		}
	}
	
	//Add edit delivery addres
	public function addeditDeliveryaddress(Request $request, $id =null){
		$country = Country::all()->toArray();
		$state = State::all()->toArray();
		$deliveryAdd = DeliveryAddress::DeliveryAddresses();
		if(!empty($id)){
			$title ="Update Address";
		}else{
			$title ="Add Address";
			
		}
		
		if($request->isMethod('post')){
			$addresData = $request->all();
			if($id ==""){
				$deliveryAddress = new DeliveryAddress;
				$message ="Your delivery address added successfully";
				$deliveryAddress->user_id = Auth::user()->id;
			}else{
				$rowId = DeliveryAddress::where('user_id', $id)->get()->toArray();
				$deliveryAddress = DeliveryAddress::find($rowId[0]['id']);
				$deliveryAddress->user_id = Auth::user()->id;
				$message ="Your delivery address updated successfully";
			}
			
			$request->validate([
				'name' => 'required',
				'address' => 'required',
				'city' => 'required',
				'state' => 'required',
				'pin' => 'required|max:6|min:6',
				'mobile' => 'required'
			]);
			
			$deliveryAddress->name = $addresData['name'];
			$deliveryAddress->address = $addresData['address'];
			$deliveryAddress->city = $addresData['city'];
			$deliveryAddress->state = strtolower($addresData['state']);
			$deliveryAddress->country = $addresData['country'];
			$deliveryAddress->pincode = $addresData['pin'];
			$deliveryAddress->mobile = $addresData['mobile'];
			$deliveryAddress->status = 1;
			$deliveryAddress->save();
			return back()->with('success', $message);
		}
		return view('front.cart.delivery_address')->with(['controller'=>'product','country'=>$country,'title'=>$title,'state'=>$state,'deliveryAdd'=>$deliveryAdd,'page_type'=>'checkout_page']);
	}
	
	// delete delivery address
	public function deleteDeliveryaddress(Request $request, $id =null){
		$deliveryAddress = deliveryAddress::find($id);
		$deliveryAddress->delete();
		return back()->with('success', 'Your delivery address delete successfully !');
		
	}
	
	public function checkPincodeDelivery(Request $request){
		$data = $request->all();
		$pin = $data['pin'];
		$pincount = codePincode::where('pincode',$data['pin'])->count();
		if($pincount>0){
			$pinData = codePincode::where('pincode',$data['pin'])->get()->first()->toArray();
			 return response()->json(['message'=>'Available delivery for the city ','city' => $pinData['city'],'pin' =>$pinData['pincode'],'status'=>true]);
		}else{
			 return response()->json(['message'=>"Available delivery address for the pin $pin is not available!",'status'=>false]);
		}
	}
	
	//add product review
	
	public function ratingUsers(Request $request){
	
		if($request->ajax()){
			$data = $request->all();
			$pro_star = $data['star'];
			$pro_message = $data['message'];
			$pro_id = $data['product_id'];
			$userReview = Rating::where(['user_id'=>Auth::user()->id,'product_id'=>$pro_id])->count();
			if($userReview >0){
				return response()->json(['status'=>200,'message'=>'Your have already added review'],200);
			}
			
			if (Auth::user()) { 
				$rating = new Rating;
				$rating->user_id = Auth::user()->id;
				$rating->product_id = $pro_id;
				$rating->review = $pro_message;
				$rating->rating = $pro_star;
				$rating->save();
				if ($rating->save()){
					return response()->json(['status'=>200,'message'=>'Your valuable review added'],200);
				}
			}
		}
	}
	
	public function userWishlist(Request $request){
		
		if($request->ajax()){
			$data = $request->all();
			$user_id = Auth::user()->id;
			$wishlistCount = Wishlist::wishlistCount($data['product_id']);
			if($wishlistCount ==0){
				$wishlist = new Wishlist();
				$wishlist->user_id = $user_id;
				$wishlist->product_id = $data['product_id'];
				$wishlist->save();
				if ($wishlist->save()){
					return response()->json(['status'=>200,'message'=>'added'],200);
				}
			}else{
				Wishlist::where(['user_id'=>$user_id, 'product_id'=>$data['product_id']])->delete();
				return response()->json(['status'=>200,'message'=>'deleted'],200);
			}
		}
	
	}
	
	public static function checkTrait($id){
	
	echo $this->CatProductCount($id); // getCurrentUser function present in our trait
	
	}
	
}
