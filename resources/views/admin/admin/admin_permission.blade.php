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
			  <div style="float:right; color:#fff"><button type="button" class="btn btn-success"><a style="color:#fff" href="{{url('/admin/list/')}}">Permission List</a></button></div>
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
                <h3 class="card-title">{{$title}}</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
				<?php 
				if(!empty($id)){
				$id = $id;
				}else{
					$id = "";
				}
				?>
				
			<div class="card-body">
              <form class="form-horizontal" method="post" action="{{url('admin/role/permission/'.$id)}}">
			  @csrf
               <input type="hidden" name="user_id" value="{{$id}}" />
					<div class="form-group row">
					
						<label for="brand" col-form-label">{{ ('Category Permission')}}:</label>
						<div class="form-group clearfix">
							<div class="icheck-success d-inline col-sm-6">
								<input type="checkbox" name="category[view]" id="category_view_access" value="1" @if(isset($admonroleData[0]['view_access']) && $admonroleData[0]['view_access'] =="1") checked @endif>
								<label for="category_view_access">View Access</label>
							</div>
							<div class="icheck-success d-inline col-sm-6">
								<input type="checkbox" name="category[edit]" id="category_view_edit_access" value="1" @if(isset($admonroleData[0]['edit_access']) && $admonroleData[0]['edit_access'] =="1") checked @endif>
								<label for="category_view_edit_access">View /Edit Access</label>
							</div>
							<div class="icheck-success d-inline col-sm-6">
								<input type="checkbox" name="category[full]" id="category_full_access" value="1" @if(isset($admonroleData[0]['full_access']) && $admonroleData[0]['full_access'] =="1") checked @endif>
								<label for="category_full_access">Full access</label>
							</div>
						</div>
					</div>
				
					<div class="form-group row">
						<label for="brand" col-form-label">{{ ('Product Permission')}} :</label>
						<div class="form-group clearfix">
							<div class="icheck-success d-inline col-sm-6">
								<input type="checkbox" name="product[view]" id="product_view_access" value="1" @if(isset($admonroleData[1]['view_access']) && $admonroleData[1]['view_access'] =="1") checked @endif>
								<label for="product_view_access">View Access</label>
							</div>
							<div class="icheck-success d-inline col-sm-6">
								<input type="checkbox" name="product[edit]" id="product_view_edit_access" value="1" @if(isset($admonroleData[1]['edit_access']) && $admonroleData[1]['edit_access'] =="1") checked @endif>
								<label for="product_view_edit_access">View /Edit Access</label>
							</div>
							<div class="icheck-success d-inline col-sm-6">
								<input type="checkbox" name="product[full]" id="product_full_access" value="1" @if(isset($admonroleData[1]['full_access']) && $admonroleData[1]['full_access'] =="1") checked @endif>
								<label for="product_full_access">Full Access</label>
							</div>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="brand" col-form-label">{{ ('Coupon Permission')}}   : </label>
						<div class="form-group clearfix">
							<div class="icheck-success d-inline col-sm-6">
								<input type="checkbox" name="coupon[view]" id="coupon_view_access" value="1" @if(isset($admonroleData[2]['view_access']) && $admonroleData[2]['view_access'] =="1") checked @endif>
								<label for="coupon_view_access">View Access</label>
							</div>
							<div class="icheck-success d-inline col-sm-6">
								<input type="checkbox" name="coupon[edit]" id="coupon_view_edit_access" value="1" @if(isset($admonroleData[2]['edit_access']) && $admonroleData[2]['edit_access'] =="1") checked @endif>
								<label for="coupon_view_edit_access">View /Edit Access</label>
							</div>
							<div class="icheck-success d-inline col-sm-6">
								<input type="checkbox" name="coupon[full]" id="coupon_full_access" value="1" @if(isset($admonroleData[2]['full_access']) && $admonroleData[2]['full_access'] =="1") checked @endif>
								<label for="coupon_full_access">Full Access</label>
							</div>
						</div>
					</div>
					
					<div class="form-group row">
						<label for="brand" col-form-label">{{ ('Orders Permission')}}  :  </label>
						<div class="form-group clearfix">
							<div class="icheck-success d-inline col-sm-6">
								<input type="checkbox" name="order[view]" id="order_view_access" value="1" @if(isset($admonroleData[3]['view_access']) && $admonroleData[3]['view_access'] =="1") checked @endif>
								<label for="order_view_access">View Access</label>
							</div>
							<div class="icheck-success d-inline col-sm-6">
								<input type="checkbox" name="order[edit]" id="order_view_edit_access" value="1" @if(isset($admonroleData[3]['edit_access']) && $admonroleData[3]['edit_access'] =="1") checked @endif>
								<label for="order_view_edit_access">View /Edit Access</label>
							</div>
							<div class="icheck-success d-inline col-sm-6">
								<input type="checkbox" name="order[full]" id="order_full_access" value="1" @if(isset($admonroleData[3]['full_access']) && $admonroleData[3]['full_access'] =="1") checked @endif>
								<label for="order_full_access">Full Access</label>
							</div>
						</div>
					</div>
					
                <!-- /.card-body -->
                <div class="card-footer1">
                  <button type="submit" class="btn btn-info">{{$button}}</button>
                </div>
                <!-- /.card-footer -->
              </form>
            </div>
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