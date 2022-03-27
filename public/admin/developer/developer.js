  jQuery(document).ready(function(){
    setTimeout(function(){
		//$(".alert").slideUp(5000);
       //$("div.alert").remove();
	   $('div.alert').delay(3000).slideUp(300);
    }, 5000 ); // 5 secs

});
//change password of admin
function changePwdFunction(){
    //alert("password change");
	var newPwd = $('#NewPassword').val();
	var username = $('#username').val();
	var email = $('#email').val();
	var settingUrl = $('#passswordUrl').val();
	var CurrentPwd = $('#CurrentPassword').val();
	var confirmPwd = $('#ConfirmPassword').val();
	//alert( newPwd +','+ CurrentPwd +','+ confirmPwd +','+ email);
	if(CurrentPwd=="" || email=="" || newPwd=="" || confirmPwd==""){
		$('.adminMessage').html('<span>All fields must be required !</span>');
		return false;
	}else{
		if(newPwd !== confirmPwd){
			$('.adminMessage').html('<span>New password and confirm password not match </span>');
			return false;
		}else{
			
			$.ajax({
				type: "POST",
				url: settingUrl,
				data: {currentPassword:CurrentPwd,password:newPwd,name:username}, 
				success: function( msg ) {
					//alert(msg);
					$('.adminMessage').html('<span>'+ msg +'</span>');
				}
			});
		}
		
	}
}
// change section status
$('.sectionUpdateStatus').click(function(e){
	var status = $(this).text();
	var sectionId = $(this).attr('id');
	var id = $(this).attr('status-id');
	var status = $(this).attr('status');
	$.ajax({
			type: "POST",
			url: 'http://localhost/ecomm/public/admin/section/status',
			data: {id:id, status:status}, 
			success: function( msg ) {
				if(status ==1){
				$('a#'+sectionId).text('Inactive');
				}else{
				$('a#'+sectionId).text('Active');
				}
			}
		});
});

// change category value on change section value
 $("select#section").change(function(){
	var sectionValue = $(this).val();
	var sectionText = $('option:selected', this).attr('myVal');
		$.ajax({
			type: "POST",
			url: 'http://localhost/ecomm/public/admin/change-category',
			data: {id:sectionValue}, 
			success: function(msg) {
				$(".appendCategory").html(msg);
			}
		});
});

//change product status
$('.productUpdateStatus').click(function(e){
	var status = $(this).text();
	var productId = $(this).attr('id');
	var id = $(this).attr('status-id');
	var status = $(this).attr('status');
	
	$.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
	
	$.ajax({
		type: "POST",
		url: 'http://localhost/ecomm/public/admin/product/status',
		data: {id:id, status:status}, 
		success: function( msg ) {
			if(status ==1){
			$('a#'+productId).text('Inactive');
			}else{
			$('a#'+productId).text('Active');
			}
		}
	});
});

//change coupon status
	$('.couponStatus').click(function(e){
	var id = $(this).attr('status-id');
	var myClass = $(this).addClass("completed");
	var status = $(this).attr('status');
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		type: "POST",
		url: '/ecomm/public/admin/coupons/status',
		data: {id:id, status:status},
		success: function(response) {
			if(response.status ==1){
				$('.completed').html('Active');
				$('.completed').attr('status',1);
				$('.completed').css('color','green');
				$('.completed').removeClass('completed');
				}else{
				$('.completed').html('Inactive');
				$('.completed').attr('status',0);
				$('.completed').css('color','red');
				$('.completed').removeClass('completed');
			}
		}
	});
});

// Coupon form add coupons
$('#radioSuccess1').click(function(e){
	$('.manually').show();
});

$('#radioSuccess2').click(function(e){
	$('.manually').hide();
});

//Add courier and tracking number
$('#courier_name').hide();
$('#tracking_number').hide();

var selected = $("#order_status").val();
if(selected =='Shipped' || selected =='Delivered'){
	$('#courier_name').show();
	$('#tracking_number').show();
}else{
	$('#courier_name').hide();
	$('#tracking_number').hide();
}

$("#order_status").change(function () {
    var staValue = this.value;
	if(staValue == 'Shipped' || staValue =='Delivered'){
	
		$('#courier_name').show();
		$('#tracking_number').show();
		
	}else{
	
		$('#courier_name').hide();
		$('#tracking_number').hide();
	}
	  
});

// shipping status updateCommands
function shippingStatus(id) {
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		type: "POST",
		url: '/ecomm/public/admin/shipping/status',
		data: {id:id},
		success: function(response) {
			if(response.status ==400){
				setInterval(function(){ location.reload(); }, 1000);
				}else{
				setInterval(function(){ location.reload(); }, 1000);
			}
		}
	});
	
}  

//User status update
$(".userUpdateStatus").on('click', function(e){
	//alert('hhhhhhh');
});


//CMS pages status update
$(".cmsUpdateStatus").on('click', function(e){
	var id = $(this).attr('status-id');
	var status = $(this).attr('status');
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		type: "POST",
		url: '/ecomm/public/admin/cms-page/status',
		data: {id:id, status:status},
		success: function(response) {
			if(response.status ==200){
				//setInterval(function(){ location.reload(); }, 1000);
				$("#cms-"+id).html('<span style="color:#0056b3">Active</span>');
				}else{
				$("#cms-"+id).html('<span style="color:red">Inactive</span>');
			}
		}
	});
});


//Currency status update
$(".currencyUpdateStatus").on('click', function(e){
	var id = $(this).attr('status-id');
	var status = $(this).attr('status');
	$.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});
	$.ajax({
		type: "POST",
		url: '/ecomm/public/admin/currency/status',
		data: {id:id, status:status},
		success: function(response) {
			if(response.status ==200){
				if(status ==1){
				//setInterval(function(){ location.reload(); }, 1000);
					$("#currency-"+id).html('<span style="color:red">Inactive</span>');
					}else{
					$("#currency-"+id).html('<span style="color:#0056b3">Active</span>');
				}
			}
		}
	});
});


$(".ratingUpdateStatus").on('click',function(){
		var productId = $(this).attr('status-id');
		var status = $(this).attr('status');
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		
	$.ajax({
		type: "POST",
		url: '/ecomm/public/admin/status/rating',
		data: {id:productId, status:status},
		success: function(response) {
			if(response.status ==200){
				if(response.statusresponse ==1){
				//setInterval(function(){ location.reload(); }, 1000);
					$('#rating-'+productId).html('<span style="color:#0056b3">Active</span>');
					}else{
					$('#rating-'+productId).html('<span style="color:red">Inactive</span>');
				}
			} 
		}
	});
});

// Newssubscriber
$(".newsUpdateStatus").on('click',function(){
		var newsId = $(this).attr('status-id');
		var status = $(this).attr('status');
		$.ajaxSetup({
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			}
		});
		
	$.ajax({
		type: "POST",
		url: '/ecomm/public/admin/status/news',
		data: {id:newsId, status:status},
		success: function(response) {
			if(response.status ==200){
				if(response.statusresponse ==1){
				//setInterval(function(){ location.reload(); }, 1000);
					$('#news-'+newsId).html('<span style="color:#0056b3">Active</span>');
					}else{
					$('#news-'+newsId).html('<span style="color:red">Inactive</span>');
				}
			} 
		}
	});
});

