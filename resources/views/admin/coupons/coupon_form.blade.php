@extends('layouts.admin_layout.admin_design')
@section('content')
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>{{$title}}</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{$title}}</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="row">
        <div class="col-12">
          <div class="card">
            <div class="card-header">
              <h3 class="card-title">{{$title}}</h3>
			  <div style="float:right; color:#fff"><button type="button" class="btn btn-success"><a style="color:#fff" href="{{url('/admin/coupons/')}}">Coupons List</a></button></div>
            </div>
			
				@if ($message = Session::get('success'))
					<br>
					<div class="alert alert-success alert-block" style="width:400px">
						<button type="button" class="close" data-dismiss="alert">×</button>	
						<strong>{{ $message }}</strong>
					</div>
				@endif
				
				@if (count($errors) > 0)
					<div class = "alert alert-danger">
						<ul>
						   @foreach ($errors->all() as $error)
							  <li>{{ $error }}</li>
						   @endforeach
						</ul>
					</div>
				@endif
			
            <!-- /.card-header -->
			
			
			<div class="card card-info">
              <div class="card-header">
                <h3 class="card-title">Coupons Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
				<?php 
				if(!empty($couponData->id)){
				$id = $couponData->id;
				}else{
					$id = "";
				}
				?>
              <form class="form-horizontal" method="post" action="{{url('admin/coupons/add-edit/'.$id)}}">
			  @csrf
                <div class="card-body">
					<div class="form-group row">
					<label for="brand" col-form-label">{{ ('Coupon Option')}}:</label>
						<div class="form-group clearfix">
						  <div class="icheck-success d-inline col-sm-6">
							<input type="radio" name="coupon_option" id="radioSuccess1" value="Manually" @if(isset($couponData->coupon_option) && $couponData->coupon_option =="Manually") checked @endif>
							<label for="radioSuccess1">Manually</label>
						  </div>
						  <div class="icheck-success d-inline col-sm-6">
							<input type="radio" name="coupon_option" id="radioSuccess2" value="Automatic" @if(isset($couponData->coupon_option) && $couponData->coupon_option =="Automatic") checked @endif>
							<label for="radioSuccess2">Automatic</label>
						  </div>
						</div>
					</div>
					
					<div class="form-group row manually" style="">
						<label for="brand" col-form-label">{{ ('Coupon')}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label><br>
						<div class="col-sm-6">
							<div class="form-group clearfix">
								<input type="text" class="form-control" id="manually_coupon" name="manually_coupon" Placeholder="Manually Coupon" @if(!empty($couponData->coupon_code)) value="{{ $couponData->coupon_code}}" @endif >
							</div>
						</div>
					</div>
					<div class="manually1">
						<div class="form-group row">
							<label for="brand" col-form-label">{{ ('Coupon type')}}:</label><br>
							<div class="col-sm-6">
							<!-- checkbox -->
								<div class="form-group clearfix">
									<div class="icheck-primary d-inline">
										<input type="radio" id="radioPrimary1" name="coupon_type" value="single" @if(isset($couponData->coupon_type) && $couponData->coupon_type =="single") checked @endif >
										<label for="radioPrimary1">Single Time</label>
									</div>
									<div class="icheck-primary d-inline">
										<input type="radio" id="radioPrimary2" name="coupon_type" value="multiple" @if(isset($couponData->coupon_type) && $couponData->coupon_type =="multiple") checked @endif >
										<label for="radioPrimary2">Multiple Time</label>
									</div>
								</div>
							</div>
						</div>
						
						<div class="form-group row">
							<label for="brand" col-form-label">{{ ('Amount type')}}:</label><br>
							<div class="col-sm-6">
							<!-- checkbox -->
								<div class="form-group clearfix">
									<div class="icheck-primary d-inline">
										<input type="radio" id="radioPrimary11" name="amount_type" value="Fixed" @if(isset($couponData->amount_type) && $couponData->amount_type =="Fixed") checked @endif>
										<label for="radioPrimary11">Fixed (in INR or USD)</label>
									</div>
									<div class="icheck-primary d-inline">
										<input type="radio" id="radioPrimary22" name="amount_type" value="Percentage" @if(isset($couponData->amount_type) && $couponData->amount_type =="Percentage") checked @endif>
										<label for="radioPrimary22">Percentage(in %)</label>
									</div>
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="brand" col-form-label">{{ ('Amount')}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:</label><br>
							<div class="col-sm-6">
								<div class="form-group clearfix">
									<input type="text" class="form-control" id="amount" name="amount" Placeholder="Amount" @if(!empty($couponData->amount)) value="{{ $couponData->amount }}" @endif >
								</div>
							</div>
						</div>
									
						<div class="form-group row">
						<label for="brand" col-form-label">{{ ('Expiry Date')}}:</label><br>
							<div class="col-sm-6">
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"><i class="far fa-calendar-alt"></i></span>
									</div>
									<input type="text" @if(!empty($couponData->expery_date)) value="{{ $couponData->expery_date }}" @endif class="form-control" data-inputmask-alias="datetime" data-inputmask-inputformat="yyyy/mm/dd" data-mask="" im-insert="false" name="date">
								</div>
							</div>
						</div>
						<div class="form-group row">
							<label for="brand" col-form-label">{{ ('Select User:')}}</label>
							<div class="col-sm-6">
								<div class="select2-purple">
									<select class="select2" multiple="multiple" data-placeholder="Select a users" data-dropdown-css-class="select2-purple" style="width: 100%;" name="users[]">
										@foreach($users as $user)
											<?php 
											if(isset($couponData->users)){
											$myuser = explode(',', $couponData->users);
											?>
											@foreach($myuser as $selectedusers )
											<option value="{{$user['email']}}"  @if(isset($selectedusers) && $selectedusers == $user['email']) selected @endif >{{$user['email']}}</option>
											@endforeach
											<?php 
											}else{
											?>
											<option value="{{$user['email']}}">{{$user['email']}}</option>
											
											<?php }?>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						
						
						<div class="form-group row">
							<label for="brand" col-form-label">&nbsp;{{ ('Categories:')}}</label>
							<div class="col-sm-6">
								<div class="select2-purple">
									<select class="select2" multiple="multiple" data-placeholder="Select a Category" data-dropdown-css-class="select2-purple" style="width: 100%;" name="category[]">
										@foreach($categories as $section)
											<option disabled>{{$section->name}}</option>
											@foreach($section->categories as $category)
												<option @if(!empty($productData['category_id'])&& $productData['category_id'] ==$category->id) selected="" @endif value="{{$category->id}}">-{{$category->category_name}}</option>
												@foreach($category->subcategories as $subcategory)
													<option @if(!empty($productData['category_id'])&& $productData['category_id'] ==$subcategory->id) selected="" @endif value="{{$subcategory->id}}"> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--{{$subcategory->category_name}}</option>
												@endforeach
											@endforeach
										@endforeach
									</select>
								</div>
							</div>
						</div>
						
					</div>
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">{{$button}}</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>

            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 
@endsection