@extends('layouts.admin_layout.admin_design')
@section('content')
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Return Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Return Tables</li>
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
                  <th>Id</th>
                  <th>User Id</th>
                  <th>Order Id </th>
                  <th>Product Id</th>
                  <th>Code</th>
                  <th>Reason</th>
                  <th>Status</th>
                  <th>Comment</th>
                  <th>Apply</th>
                  <th>Return Date</th>
                </tr>
                </thead>
                <tbody>
				@foreach($returnData as $return)
                <tr>
					<td>{{$return['id']}}</td>
					<td>{{$return['user_id']}}</td>
					<td>{{$return['order_id']}}</td>
					<td>{{$return['product_id']}}</td>
					<td>{{$return['product_code']}}</td>
					<td>{{$return['return_reason']}}</td>
					<td>{{$return['return_status']}}</td>
					<td>{{$return['comment']}}</td>
					
					<td>
						<form method="post" action="{{ route('return.update')}}" name="status">
						@csrf
						<input type="hidden" name="request_id" value="{{$return['id']}}" />
						<input type="hidden" name="user_id" value="{{$return['user_id']}}" />
						<input type="hidden" name="order_id" value="{{$return['order_id']}}" />
						<input type="hidden" name="product_id" value="{{$return['product_id']}}" />
						<input type="hidden" name="product_code" value="{{$return['product_code']}}" />
							<select class="form-select" name="return_status" id="return_status">
								<option value="Pending">Pending</option>
								<option value="Reject">Reject</option>
								<option value="Approve">Approve</option>
							</select>
							<input type="submit" class="returnStaus btn btn-info" value="Submit" />
						</form>
					</td>
					
					<td>{{DateFormate($return['created_at'])}}</td>
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