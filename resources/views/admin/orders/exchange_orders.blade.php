@extends('layouts.admin_layout.admin_design')
@section('content')
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Exchange Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Exchange Tables</li>
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
              <h3 class="card-title">Returns Table</h3>
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
            <div class="card-body">
              <table id="example3" class="table table-bordered table-striped">
                <thead>
                <tr>
                 <!-- <th>Id</th> -->
                  <th>User Id</th>
                  <th>Order Id </th>
                  <th>Product size</th>
                  <th>Required</th>
                  <th>Code</th>
                  <th>Reason</th>
                  <th>Status</th>
                  <th>Comment</th>
                  <th>Apply</th>
                  <th>Date</th>
                </tr>
                </thead>
                <tbody>
				@foreach($exchangeData as $exchange)
                <tr>
					 <!-- <td>{{$exchange['id']}}</td> -->
					<td>{{$exchange['user_id']}}</td>
					<td>{{$exchange['order_id']}}</td>
					<td>{{$exchange['product_size']}}</td>
					<td>{{$exchange['required_size']}}</td>
					<td>{{$exchange['product_code']}}</td>
					<td>{{$exchange['exchange_reason']}}</td>
					<td>{{$exchange['exchange_status']}}</td>
					<td>{{$exchange['comment']}}</td>
					
					<td>
						<form method="post" action="{{ route('exchange.update')}}" name="status">
						@csrf
						<input type="hidden" name="request_id" value="{{$exchange['id']}}" />
						<input type="hidden" name="user_id" value="{{$exchange['user_id']}}" />
						<input type="hidden" name="order_id" value="{{$exchange['order_id']}}" />
						<input type="hidden" name="required_size" value="{{$exchange['required_size']}}" />
						<input type="hidden" name="product_code" value="{{$exchange['product_code']}}" />
							<select class="form-select" name="exchange_status" id="exchange_status">
								<option value="Pending">Pending</option>
								<option value="Reject">Reject</option>
								<option value="Approve">Approve</option>
							</select>
							<input type="submit" class="returnStaus btn btn-info" value="Submit" />
						</form>
					</td>
					
					<td>{{DateFormate($exchange['created_at'])}}</td>
                </tr>
				@endforeach
                </tbody>
              </table>
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