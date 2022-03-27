@extends('layouts.admin_layout.admin_design')
@section('content')
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Section Tables</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Section Tables</li>
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
              <h3 class="card-title">Section Table</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Id</th>
                  <th>Name</th>
                  <th>Status</th>
                </tr>
                </thead>
                <tbody>
				@foreach($dataSection as $dataSections)
                <tr>
					<td>{{$dataSections->id}}</td>
					<td>{{$dataSections->name}}</td>
					<td>@if($dataSections->status ==1) 
						<a href="javascript:void(0)" class="sectionUpdateStatus" id="section-{{$dataSections->id}}" status-id="{{$dataSections->id}}" status="{{$dataSections->status}}">Active</a>
						@else
						<a href="javascript:void(0)" style="color:red;" class="sectionUpdateStatus" id="section-{{$dataSections->id}}" status-id="{{$dataSections->id}}" status="{{$dataSections->status}}">Inactive</a>
						@endif
					</td>
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