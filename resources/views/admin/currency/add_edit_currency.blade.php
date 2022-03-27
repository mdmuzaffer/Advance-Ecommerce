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
			  <div style="float:right; color:#fff"><button type="button" class="btn btn-success"><a style="color:#fff" href="{{url('/admin/currency')}}">Currency List</a></button></div>
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
                <h3 class="card-title">Currency Form</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form class="form-horizontal" method="post" action="{{url('admin/add-edit-currency/'.$id)}}">
			  @csrf
                <div class="card-body">
				
                  <div class="form-group row">
                    <label for="title" class="col-sm-2 col-form-label">{{__('Currency Code')}}</label>
                    <div class="col-sm-4">
                      <input type="text" class="form-control" id="title" placeholder="currency code" name="currency_code" @if(!empty($currency['currency_code']))value="{{$currency['currency_code']}}" @endif>
                    </div>
					<label for="description" class="col-sm-2 col-form-label">{{__('Exchange Rate')}}</label>
					<div class="col-sm-4">
					  <input type="text" class="form-control" id="meta_description" placeholder="exchange rate" name="exchange_rate" @if(!empty($currency['exchange_rate']))value="{{$currency['exchange_rate']}}" @endif>
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