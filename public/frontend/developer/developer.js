 jQuery(document).ready( function($){
	$("select#sort").on('change',function(){
		//this.form.submit();
		//var sortProducts = $("#sort option:selected").val();
		var sort = $(this).val();
		var url = $("#url").val();
		var occasion = get_filter('occasion');
		var fit = get_filter('fit');
		var pattern = get_filter('pattern');
		var sleeve = get_filter('sleeve');
		var fabric = get_filter('fabric');
		$.ajax({
            type: "GET",
            url: url,
			data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
			success:function(response){
				$('.filter_products').html(response);
			}
        })
	});
	
	//Get febric value
	$('.fabric').on('click',function(){
		var occasion = get_filter('occasion');
		var fit = get_filter('fit');
		var pattern = get_filter('pattern');
		var sleeve = get_filter('sleeve');
		var fabric = get_filter('fabric');
		
		var sort = $("#sort option:selected").val();
		
		var url = $("#url").val();
		$.ajax({
            type: "GET",
            url: url,
			data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
			success:function(response){
				$('.filter_products').html(response);
			}
        })
	});
	//Get sleev value
	$('.sleeve').on('click',function(){
		var occasion = get_filter('occasion');
		var fit = get_filter('fit');
		var pattern = get_filter('pattern');
		var sleeve = get_filter('sleeve');
		var fabric = get_filter('fabric');
		
		var sort = $("#sort option:selected").val();
		var url = $("#url").val();
		$.ajax({
            type: "GET",
            url: url,
			data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
			success:function(response){
				$('.filter_products').html(response);
			}
        })
	});
	
	//Get pattern value
	$('.pattern').on('click',function(){
		var occasion = get_filter('occasion');
		var fit = get_filter('fit');
		var pattern = get_filter('pattern');
		var sleeve = get_filter('sleeve');
		var fabric = get_filter('fabric');
		
		var sort = $("#sort option:selected").val();
		var url = $("#url").val();
		$.ajax({
            type: "GET",
            url: url,
			data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
			success:function(response){
				$('.filter_products').html(response);
			}
        })
	});
	
		//Get fit value
	$('.fit').on('click',function(){
		var occasion = get_filter('occasion');
		var fit = get_filter('fit');
		var pattern = get_filter('pattern');
		var sleeve = get_filter('sleeve');
		var fabric = get_filter('fabric');
		
		var sort = $("#sort option:selected").val();
		var url = $("#url").val();
		$.ajax({
            type: "GET",
            url: url,
			data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
			success:function(response){
				$('.filter_products').html(response);
			}
        })
	});
	
	//Get occasion value
	$('.occasion').on('click',function(){
		var occasion = get_filter('occasion');
		var fit = get_filter('fit');
		var pattern = get_filter('pattern');
		var sleeve = get_filter('sleeve');
		var fabric = get_filter('fabric');
		
		var sort = $("#sort option:selected").val();
		var url = $("#url").val();
		$.ajax({
            type: "GET",
            url: url,
			data:{fabric:fabric,sleeve:sleeve,pattern:pattern,fit:fit,occasion:occasion,sort:sort,url:url},
			success:function(response){
				$('.filter_products').html(response);
			}
        })
	});
	
	//make function to get checked value 
	function get_filter(class_name){
		var filter =[];
		$('.'+class_name+':checked').each(function(){
			filter.push($(this).val());
		});
		return filter;
	}
	// change price of attribute size according
	$("#getAttribute").on('change',function(){
	var size = $(this).val();
	if(size ==""){
		alert('Please select size');
		return false;
	} 
	var mainProductId = $("#getAttribute").attr('main-product');
	var productId = $('option:selected', this).attr('product_id');
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
            type: "post",
            url: '/ecomm/public/get-attribute-price',
			data:{mainProductId:mainProductId,size:size,productId:productId},
			success:function(response){
				//alert(response.discount[0].price);
				if(response.success ==1){
					$(".attrItems").html(response.productAttribute.stock+' items in stock');
					$(".ChangeAttributePrice").html('Rs '+response.productAttribute.price);
					if(!response.discount[0].price ==""){
						$(".ChangeAttributeDiscountPrice").html('<p>Discounted Price: '+ response.discount[0].price +'</p>');
					}
					
					if(!response.currencyData ==""){
						$(".currency_conviter").html(response.currencyData);
					}
					
				}else{
					alert(response.message);
				}
			},
			error:function(error){
				alert('ErrorException');
			}
        });
	
	});
	
	//cart items update increase and decrease
	//$(".ItemUpdate").on("click", function // it not working with response html
	$(document).on('click', '.ItemUpdate', function(){ 
		if($(this).hasClass("QuantityMinus")){
			var qwtproId = $(this).attr("qwt-proId");
			var qty = $(this).prev().val();
			if(qty<=1){
				alert('Items qwantity must be 1 or greater!');
				return false;
			}else{
				var newQwt = parseInt(qty)-1;
		
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type: "POST",
					url: '/ecomm/public/update-cart-items-qwt',
					 _token:"{{csrf_token()}}",
					data:{proId:qwtproId,newqwt:newQwt},
					success:function(response){
					if(response.status==false){
						alert('Your added items quentity not avaible!');
						return false;
					}
					$("#CartListData").html(response.view);
					$(".currentCartItems").html(response.totalCartItems);
					},
					error:function(error){
						alert('ErrorException');
					}
				});
			}
		}
		if($(this).hasClass("QuantityPlus")){
			var qwtproId = $(this).attr("qwt-proId");
			var qty = $(this).prev().prev().val();
			var newQwt = parseInt(qty)+1;
				
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					type:'POST',
					url:'/ecomm/public/update-cart-items-qwt',
					data: {proId:qwtproId,newqwt:newQwt},
					success:function(response){
					if(response.status == false){
						alert('Your added items quentity not avaible!');
						return false;
					}
					$("#CartListData").html(response.view);
					$(".currentCartItems").html(response.totalCartItems);
					},
					error:function(error){
						alert('ErrorException');
					}
				});
		}
	});
	
	//delete the cart items from cart
	$(document).on('click', '.Quantitydelete', function(){ 
		var deleteproId = $(this).prev().attr("qwt-proId");
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
               type:'POST',
               url:'/ecomm/public/delete-cart-items-qwt',
			   data: {proId:deleteproId},
               success:function(data) {
                $('#addDynamic').html(data.view);
				$(".currentCartItems").html(data.totalCartItems);
				console.log(data);
               }
        });
	});
	
	
	//validate signup form on keyup and submit
	$('#registerForm').validate({
		rules: {
			name: {
				required: true,
				minlength: 2
			},
			password: {
				required: true,
				minlength: 5
			},
			email: {
				required: true,
				email: true,
				remote: "email-check"
			},
			mobile: {
				required: true,
				minlength: 10,
				maxlength: 10
			}
		},
		messages: {
			name: {
				required: "Please enter a name",
				minlength: "Your name must consist of at least 2 characters"
			},
			password: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			email: {
				required: "Please enter your email address.",
                email: "Please enter a valid email address.",
                remote: jQuery.validator.format("{0} is already taken.")
			},
			mobile: {
				required: "Please enter mobile no",
				minlength: "Please enter must 10 mobile no",
				maxlength: "Please enter max 10 mobile no"
			}
		}
	});
	
	//Login form validation
	$('#loginForm').validate({
		rules: {
			loginemail:{
				required: true,
				email: true
			},
			loginpassword:{
				required: true,
				minlength: 5
			}
		},
		messages: {
			loginemail: {
				required: "Please enter your email address.",
                email: "Please enter a valid email address."
			},
			loginpassword: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			}
		}
	});
	
	// password change form validation
		$('#pwdForm').validate({
		rules: {
			password:{
				required: true
			},
			newpassword:{
				required: true,
				minlength: 5
			},
			confirmpassword:{
				required: true,
				minlength: 5
			}
		},
		messages: {
			password: {
				required: "Please enter your current password."
			},
			newpassword: {
				required: "Please provide a password",
				minlength: "Your password must be at least 5 characters long"
			},
			confirmpassword: {
				required: "Please provide a confirm password",
				minlength: "Your confirm password must be same length of password"
			}
		}
	});
	
		// My account update
	$('#myaccountForm').validate({
		rules: {
			name:{
				required: true
			},
			address:{
				required: true
			},
			city:{
				required: true
			},
			state:{
				required: true
			},
			country:{
				required: true
			},
			pin:{
				required: true
			},
			mobile:{
				required: true
			}
		},
		messages: {
			name: {
				required: "Please enter your name !."
			},
			address: {
				required: "Please provide a address !"
			},
			city: {
				required: "Please provide your city !"
			},
			state:{
				required: "Please Enter your state !"
			},
			country:{
				required: "Please provide your country !"
			},
			pin:{
				required: "Please provide your pin code !"
			},
			mobile:{
				required: "Please provide your mobile !"
			}
		}
	});
	
	// apply coupon code
	$("#ApplyCoupon").on('click',function(e){
		var user = $('#1val').attr('user');
		var coupon = $('#myCoupon').val();
		if(user =='1'){
			
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				   type:'POST',
				   url:'/ecomm/public/coupon',
				   data: {user:user,coupon:coupon},
				   success:function(response) {
						if(response.status ==true){
							$(".showMessage").html('<p style="color:green">'+response.message+'<p>');
							setTimeout(function(){ location.reload(true); }, 3000);
						}
						if(response.status ==false){
							$(".showMessage").html('<p style="color:red">'+response.message+'<p>');
						}
				   },
				   error:function(error){
						alert('ErrorException');
					}
			});
			
		}else{
			alert('Please login before to apply coupon');
		}
		
	});
	
	//Add shipping charge
	$('input:radio[name="useraddress"]').change(
    function(){
        if ($(this).is(':checked') ) {
			var userType = $(this).val();
			var pincode = $(this).attr('checkPincode');
			if(userType!==""){
				$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
				$.ajax({
					   type:'POST',
					   url:'/ecomm/public/shipping-charge-country',
					   data: {user_type:userType,pin_code:pincode},
					   success:function(response) {
							if(response.success ==true){
								$(".country_shipCharge").html('Rs.'+response.charge);
								var carttotal = $("#cartTotal").attr('tot');
								var totalamount = (parseInt(carttotal) + parseInt(response.charge));
								$("#totalMount").html('Rs. '+ totalamount);
								$("#checkoutToata").val(totalamount);
								$("#delivery_charge").val(response.charge);
								//alert(totalamount);
								//setTimeout(function(){ location.reload(true); }, 300);
							}
							if(response.pincode =="false"){
								$("#shippingMethod").hide();
								$(".shipping_msg").html('Your select pincode not avaible for delivery!');
							}else{
								$("#shippingMethod").show();
								$(".shipping_msg").hide();
							}
							if(response.success ==false){
								//$(".showMessage").html('<p style="color:red">'+response.message+'<p>');
							}
					   },
					   error:function(error){
							alert('ErrorException');
						}
				});
			
			}else{
				alert('Please select delivery address');
			}
		
        }
    });
	//check pin code availability
	$("#checkpinButton").on('click',function(){
		var pin = $("#inputpincheck").val();
		let data ={};
		data['pin'] = pin;
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.post('/ecomm/public/check-pincode-delivery', data, response=>{
			if(response.status ==true){
			$('#inputCheckpinshow').html(response.message + response.city+' and pincode '+ response.pin+' is avaible!');
			}else{
				$('#inputCheckpinshow').html(response.message);
			}
		});
	});
	
	$("#productReviewBtn").on('click', function() {
	   var star = $("input[name='rate']:checked").val();
	   var message = $("#proreviewmsg").val();
	   var product = $("#proReviewId").val();
	   
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		
		$.ajax({
			type: "POST",
			url: '/ecomm/public/ratings/product',
			data: {star:star, message:message,product_id:product},
			success: function(response) {
				if(response.status ==200){
					$(".usersResponse").html(response.message);
				}
				if(response.message =='Unauthenticated'){
					$(".usersResponse").html('Some things wrong or first login !');
				}
			}
		});
	});
	
	$(".add-to-wishlist").on('click',function(e){
		
		var productId = $(this).data("productid");
		if(productId ==""){
			$("#wislist_msg").html('Please login for wislist !');
			return false;
		}else{
		
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			
			$.ajax({
				type: "POST",
				url: '/ecomm/public/product/wishlist',
				data: {product_id:productId},
				success: function(response) {
					if(response.message =='added'){
						$("#wislist_msg").html();
						$("#wislist_msg").html('Your product added in wishlist !');
					}
					if(response.message =='deleted'){
						$("#wislist_msg").html();
						$("#wislist_msg").html('Product deleted from your wishlist !');
					}
				}
			});
		}
		
	})
	
	// delete wishlist product
	$(document).on('click',".WishListdelete", function(e){
		var productId = $(this).data("proid");
		if(productId ==""){
			$("#wishListData").html('Please login for wislist !');
			return false;
		}else{
			
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			
			$.ajax({
				type: "POST",
				url: '/ecomm/public/my-wishlist/delete',
				data: {product_id:productId},
				success:function(data) {
                $('#wishListData').html(data.view);
				console.log(data.view);
               }
			});
		}
	});
	
	// Order cancel 
	$("#ordercancle").on('click',()=>{
		var orderId = $("#ordercancle").data("cancleid");
			
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			
			$.ajax({
				type: "POST",
				url: '/ecomm/public/order-cancle',
				data: {order_id:orderId},
				success:function(data) {
					if(data.status ==200){
						$('#OrderStatusMsg').html(data.message);
						$('#chngStatus').html('cancelled');
					}
               }
			});
			
	});
	
	// order return 
	
	$("#productReturn").on('click',()=>{
		var product_id = $("#product").val();
		var reason = $("#reason").val();
		var order_id = $("#order_id").val();
		var comment = $("#comment").val();
		var old_size = $("#old_size").val();
		var exchange_type = $("#exchange_productStatus").val();
		var exchange_size = $("#exchangeReturn_product").val();
		
			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				}
			});
			$.ajax({
				type: "POST",
				url: '/ecomm/public/order-return',
				data: {order_id:order_id,product_id:product_id,reason:reason,comment:comment,old_size:old_size,exchange_type:exchange_type,exchange_size:exchange_size},
				success:function(data) {
					if(data.status ==200){
						$('#OrdeRreturnMsg').html(data.message);
						$('#chngStatus').html('Reject');
					}
               }
			});
	})
	
	//change exchange return product

	$("#exchange_productStatus").change(function(){
		var ststusTag = $(this).val();
		if(ststusTag =='return'){
			$("#exchangeReturn_product").hide();
		}else{
			$("#exchangeReturn_product").show();
			var product_id = $("#product_id").val();
			selectProductsize(product_id);
		}
	});
	
	$("#product").change(function(){
		var productId = $(this).val();
		selectProductsize(productId);
	});
	
	function selectProductsize(id){
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		$.ajax({
			type: "POST",
			url: '/ecomm/public/order-exchange',
			data: {product_id:id},
			success:function(data) {
				if(data.status ==200){
					var Html =""
					for (let i = 0; i < data.data.length; i++) {
						Html += "<option value="+ data.data[i].size +">"+ data.data[i].size +"</option>";
					}
					$("#exchangeReturn_product").html(Html);
					
				}
		   }
		});
	}
	
	//NewsSubscribe
	
	$("#newsletter_subscribe").on('click', ()=>{
		var newsEmail = $("#newsletter").val();
		var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		if(newsEmail ==""){
			alert('Please enter email id');
			return false;
		}else if(!emailReg.test(newsEmail)){
			alert('Please enter valid email !');
			return false;
		}else{
			$.ajaxSetup({
					headers: {
						'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
					}
				});
			$.ajax({
				type: "POST",
				url: '/ecomm/public/newsletter',
				data: {email:newsEmail},
				success:function(data) {
					if(data.status ==200){
						alert(data.message);
						$("#newsletter").val("");
					}
			   }
			});
		}
	});

// hide Exchange order product select option
$("#exchangeReturn_product").hide();	

});