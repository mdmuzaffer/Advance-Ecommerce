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
			  <div style="float:right; color:#fff"><button type="button" class="btn btn-success"><a style="color:#fff" href="{{url('/admin/shipping-charge/')}}">Country List</a></button></div>
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
                <h3 class="card-title">Shipping Charge</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" method="post" action="{{url('admin/shipping-charge-update/'.$shippingData['id'])}}">
			  @csrf
                <div class="card-body">
                  <div class="form-group row">
                    <label for="brand" class="col-sm-2 col-form-label">{{_('Country')}}</label>
                    <div class="col-sm-6">
                      <input type="text" readonly class="form-control" id="brand" placeholder="add/edit brand" name="country" @if(!empty($shippingData['country']))value="{{$shippingData['country']}}" @endif>
                    </div>
                  </div>
				  
				  <div class="form-group row">
                    <label for="brand" class="col-sm-2 col-form-label">{{__('0_500g')}}</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="brand" placeholder="0_500g" name="0_500g" @if(!empty($shippingData['0_500g'])) value="{{$shippingData['0_500g']}}" @endif>
                    </div>
                  </div>
				  
				  
				<div class="form-group row">
                    <label for="brand" class="col-sm-2 col-form-label">{{__('501_1000g')}}</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="brand" placeholder="501_1000g" name="501_1000g" @if(!empty($shippingData['501_1000g'])) value="{{$shippingData['501_1000g']}}" @endif>
                    </div>
                </div>
				  
				  
				<div class="form-group row">
                    <label for="brand" class="col-sm-2 col-form-label">{{__('1001_2000g')}}</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="brand" placeholder="1001_2000g" name="1001_2000g" @if(!empty($shippingData['1001_2000g'])) value="{{$shippingData['1001_2000g']}}" @endif>
                    </div>
                </div>
				  
				<div class="form-group row">
                    <label for="brand" class="col-sm-2 col-form-label">{{__('20001_5000g')}}</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="brand" placeholder="20001_5000g" name="20001_5000g" @if(!empty($shippingData['20001_5000g'])) value="{{$shippingData['20001_5000g']}}" @endif>
                    </div>
                </div>
				  
				<div class="form-group row">
                    <label for="brand" class="col-sm-2 col-form-label">{{__('above_5000g')}}</label>
                    <div class="col-sm-6">
                      <input type="text" class="form-control" id="brand" placeholder="above_5000g" name="above_5000g" @if(!empty($shippingData['above_5000g'])) value="{{$shippingData['above_5000g']}}" @endif>
                    </div>
                </div>
				  
				  
                </div>
                <!-- /.card-body -->
                <div class="card-footer">
                  <button type="submit" class="btn btn-info">{{_('Update Charge')}}</button>
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