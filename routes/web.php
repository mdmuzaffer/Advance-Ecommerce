<?php
use App\Category;
use App\CmsPage;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Admin Controller
Route::prefix('admin')->namespace('Admin')->group(function () {
	//login url
    Route::match(['get', 'post'], '/login', 'AdminController@login');
	
	//Matches The "/admin/dashboard" URL
	Route::group(['middleware'=>['admin']],function(){
	Route::get('/dashboard', 'AdminController@adminUser');	
	Route::get('/logout', 'AdminController@adminLogout');
	Route::get('/password', 'AdminController@passwordChange');
	Route::post('/password-setting', 'AdminController@passwordSetting');
	Route::match(['get','post'],'/details', 'AdminController@adminDetails');
	
	//section controller
	Route::get('section', 'SectionController@section');
	Route::post('/section/status', 'SectionController@sectionStatus');
	
	//category
	Route::get('/category', 'CategoryContoller@category');
	Route::match(['get','post'],'/add-edit-category/{id?}', 'CategoryContoller@addEditCategory');
	Route::post('/change-category', 'CategoryContoller@changeCategory');
	Route::post('/edit-category', 'CategoryContoller@editCategory');
	Route::get('/delete-category/{id?}', 'CategoryContoller@deleteCategory');
	Route::get('/category-image-delete/{image}/{id?}', 'CategoryContoller@categoryImageDelete');
	Route::match(['get','post'],'/category/status/{id?}','CategoryContoller@categoryStatus');
	
	//Products
	Route::get('/product', 'ProductController@product');
	Route::post('/product/status', 'ProductController@productStatus');
	Route::get('/product/delete/{id?}', 'ProductController@productDelete');
	Route::match(['get','post'],'/product/add-edit-product/{id?}', 'ProductController@addEditProduct');
	Route::get('/product-image-delete/{image}/{id?}', 'ProductController@productImageDelete');
	Route::get('/product-video-delete/{video}/{id?}', 'ProductController@productvideoDelete');
	Route::match(['get','post'],'/product/add-attributes/{id?}', 'ProductController@addAttributes');
	Route::match(['get','post'],'/product/update-attributes/', 'ProductController@updateAttributes');
	Route::match(['get','post'],'/product/attribute-status/{id?}', 'ProductController@productAttrStatus');
	Route::match(['get','post'],'/product/attribute-delete/{id?}', 'ProductController@productAttrDelete');
	Route::match(['get','post'],'/product/add-images/{id?}', 'ProductController@addImages');
	Route::match(['get','post'],'/product/add-images/status/{id?}', 'ProductController@productImageStatus');
	Route::match(['get','post'],'/product/add-images/delete/{id?}', 'ProductController@producstImageDelete');
	
	//Brands
	Route::get('/brands', 'BrandController@brands');
	Route::match(['get','post'],'/brands/status/{id?}', 'BrandController@brandStatus');
	Route::match(['get','post'],'/brands/delete/{id?}', 'BrandController@brandDelete');
	Route::match(['get','post'],'/brands/add-edit/{id?}', 'BrandController@brandAddEdit');
	
	//Banners
	Route::get('banners', 'BannersController@banners');
	Route::match(['get','post'],'/banners/status/{id?}', 'BannersController@bannersStatus');
	Route::match(['get','post'],'/banners/delete/{id?}', 'BannersController@bannersDelete');
	Route::match(['get','post'],'/banners/add-edit/{id?}', 'BannersController@banneAddEdit');
	
	//Coupons 
	Route::get('/coupons', 'CouponsController@coupons');
	Route::post('/coupons/status', 'CouponsController@couponStatus');
	Route::match(['get','post'],'/coupons/add-edit/{id?}', 'CouponsController@couponAddEdit');
	//Route::match(['get','post'],'/coupons/update/{id?}', 'CouponsController@couponUpdate');
	Route::get('/coupons/delete/{id?}', 'CouponsController@couponDelete');
	
	//Orders
	Route::get('/order','OrdersController@orders');
	Route::match(['get','post'],'/orders/view/{id}','OrdersController@ordersView');
	Route::post('/orders/status','OrdersController@orderStatus');
	
	//Orders View Invoice
	Route::get('/orders-view-invoice/{id}','OrdersController@ordersViewInvoice');
	Route::get('/orders-view-pdf/{id}','OrdersController@ordersViewPDF');
	
	//shipping charges
	Route::get('/shipping-charge','ShippingController@shippingCharge');
	Route::match(['get','post'],'/shipping-charge-update/{id}','ShippingController@shippingChargeUpdate');
	Route::match(['get','post'],'/shipping/status','ShippingController@shippingStatus');
	
	// Users List
	Route::get('/users','UserController@usersList');
	Route::get('/users-chart','UserController@usersChart');
	Route::get('/users-country','UserController@usersCountry');
	Route::get('/users/status/{id}','UserController@userStatus');
	
	//CMS pages
	Route::get('/cms-pages','CmspageController@cmsPagesList');
	Route::post('/cms-page/status','CmspageController@cmspageStatus');
	Route::match(['get','post'],'/add-edit-cms-page/{id?}','CmspageController@addeditcmsPage');
	Route::match(['get','post'],'/delete-cms-page/{id}','CmspageController@deletecmsPage');
	
	//Currency pages
	Route::get('/currency','CurrencyController@currencyPagesList');
	Route::post('/currency/status','CurrencyController@currencyStatus');
	Route::match(['get','post'],'/add-edit-currency/{id?}','CurrencyController@addeditcurrency');
	Route::match(['get','post'],'/delete-currency/{id}','CurrencyController@deleteCurrency');
	
	//Admin list page
	Route::get('/list', 'AdminController@adminList');
	Route::match(['get','post'],'/role/add-edit/{id?}', 'AdminController@adminAddedit');
	Route::get('/role/status/{id}', 'AdminController@roleStatus');
	Route::get('/role/delete/{id}', 'AdminController@roleDelete');
	Route::match(['get','post'],'/role/permission/{id?}', 'AdminController@rolePermission');
	
	//Ratng module
	Route::get('/rating', 'RatingController@ratingList');
	Route::post('/status/rating', 'RatingController@statusRating');
	//Return module
	Route::get('/return', 'OrdersController@returnOrder');
	Route::post('/return/update', 'OrdersController@returnUpdate')->name('return.update');
	
	//Exchange module
	Route::get('/exchange', 'OrdersController@exchangeOrder');
	Route::post('/exchange/update', 'OrdersController@exchangeUpdate')->name('exchange.update');
	// News List
	Route::match(['get','post'],'/news-list','NewsletterSubscriberController@newsletterList');
	Route::post('/status/news', 'NewsletterSubscriberController@newsUpdate')->name('exchange.update');
	Route::match(['get','post'],'/delete-news/{id?}', 'NewsletterSubscriberController@newsDelete')->name('exchange.delete');
	Route::match(['get','post'],'/export-newsletter-subscribers', 'NewsletterSubscriberController@exportnewsletterSubscribers')->name('export.subscribers');
	Route::match(['get','post'],'/export-users', 'UserController@userExport')->name('export.user');
	Route::match(['get','post'],'/export-order', 'OrdersController@orderExport')->name('export.orders');
	
	//Import pin code
	Route::match(['get','post'],'/import-pin', 'PinController@importPin')->name('import.pin');
	
	});
	
});

Route::get('/admin', 'AdminController@adminUser');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/test','TestController@contact');
Route::post('/test-data','TestController@testData');

//Google login using social

Route::get('/google/login', 'Auth\GoogleController@redirectToGoogle');
Route::get('/google/login/callback', 'Auth\GoogleController@handleGoogleCallback');


//Front controller
Route::namespace('Front')->group(function () {
	Route::get('/', 'IndexController@index');
	
	
	$CatUrl = Category::select('url')->where('status',1)->get()->pluck('url')->toArray();
	//$url = array_column($CatUrl, 'url'); it also working
	foreach($CatUrl as $url){
	Route::get('/'.$url, 'ProductsController@listing');
	}
	//search product
	Route::get('/search-products', 'ProductsController@listing');
	
	Route::get('/product/{code}/{id}', 'ProductsController@productDetails');
	Route::post('/get-attribute-price', 'ProductsController@getAttributePrice');
	Route::post('/add-to-cart', 'ProductsController@addToCart');
	Route::get('/cart', 'ProductsController@addCart');
	Route::post('/update-cart-items-qwt', 'ProductsController@updatecartitemsQwt');
	Route::post('/delete-cart-items-qwt', 'ProductsController@deletecartitemsQwt');
	
	//users Login route
	Route::get('/login-register',['as'=>'login','uses'=>'UsersController@loginRegister']);
	Route::post('/login','UsersController@usersLogin');
	Route::post('/register','UsersController@usersRegister');
	Route::get('/logout','UsersController@usersLogout');
	//forgot password
	Route::match(['get','post'],'/forgot-password','UsersController@forgotPassword');
	
	//email confirm for active account
	Route::match(['get','post'],'/testmail','UsersController@testMail');
	Route::match(['get','post'],'/confirm/{code}','UsersController@accountCofirm');
	
	// Check pin code for delivery available
	Route::post('/check-pincode-delivery', 'ProductsController@checkPincodeDelivery');
	// Traits checkTrait
	Route::get('/check-traits', 'ProductsController@checkTrait');
	
	//Front admin auth
	Route::group(['middleware'=>['auth']],function(){
		Route::match(['get','post'],'/my-account','UsersController@myAccount');
		
		//email confirm for active account
		//Route::match(['get','post'],'/confirm/{code}','UsersController@accountCofirm');
		
		// password change
		Route::match(['get','post'],'/password-change','UsersController@passwordChange');
		Route::post('/coupon', 'ProductsController@coupon');
		
		//my orders of the products
		Route::get('/my-orders', 'OrdersController@myOrders');
		//My wishlist
		Route::get('/my-wishlist', 'WishlistController@mywishlist');
		Route::post('/my-wishlist/delete', 'WishlistController@wishlistDelete');
		
		//Orders details of the products
		Route::get('/order-details/{id}', 'OrdersController@orderDetails');
		Route::post('/order-cancle', 'OrdersController@orderCancle');
		Route::post('/order-return', 'OrdersController@orderReturn');
		Route::post('/order-exchange', 'OrdersController@orderExchange');
		
		//check out product 
		Route::match(['get','post'],'/check-out', 'ProductsController@checkOut');
		// shipping charge
		Route::match(['get','post'],'/shipping-charge-country', 'ProductsController@shippingChargeCountry');
		
		//add edit delivery address
		Route::match(['get','post'],'/add-edit-delivery-address/{id?}', 'ProductsController@addeditDeliveryaddress');
		Route::get('/delete-delivery-address/{id?}', 'ProductsController@deleteDeliveryaddress');
		
		//product review
		Route::post('/ratings/product', 'ProductsController@ratingUsers');
		Route::post('/product/wishlist', 'ProductsController@userWishlist');
		
		//Thank you page after order replace 
		Route::get('/thank','ProductsController@thankYou');
		
		//PayPal controller for PayPal
		Route::get('/paypal','PaypalController@payPal');
		//PayPal controller for success
		Route::get('/paypal/success','PaypalController@payPalSuccess');
		//PayPal controller for fail
		Route::get('/paypal/fail','PaypalController@payPalFail');
		//PayPal controller for IPN
		Route::match(['get','post'],'/paypal/ipn','PaypalController@ipn');
		
		//PayUmoney controller for PayUmoney
		Route::get('/payumoney','PayumoneyController@payUmoney');
		Route::match(['get','post'],'/payumoney/response','PayumoneyController@payumoneyResponse');
		Route::get('/payumoney/success','PayumoneyController@payUmoneySuccess');
		Route::get('/payumoney/fail','PayumoneyController@payUmoneyFail');
		//transaction status api payumoney
		Route::get('/payumoney/verify/{id?}','PayumoneyController@payUmoneyVerify');
   
	});
	
	//check email id exit in jquery validation
	Route::get('/email-check','UsersController@emailCheck');
	
	// NewsLetter subscriber
	Route::post('/newsletter','NewsletterSubscriberController@newsletter');
	
	//Contact us page
	Route::match(['get','post'],'page/contact-us', 'CmspageController@cmsPagesContact');
	
	$CmsUrl = CmsPage::select('url')->where('status',1)->get()->pluck('url')->toArray();
	
	foreach($CmsUrl as $url){
	Route::get('/'.$url, 'CmspageController@cmsPages');
	}
	
});

