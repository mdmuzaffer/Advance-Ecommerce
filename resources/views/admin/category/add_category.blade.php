@extends('layouts.admin_layout.admin_design') @section('content')

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                   <!-- <h1>Add Category</h1> -->
				    <h1>{{$page_title}}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Category</li>
                    </ol>
                </div>
            </div>
			
			@if ($message = Session::get('success'))
				<br>
				<div class="alert alert-success alert-block">
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
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <form method="post" action="{{url('admin/add-edit-category/')}}" enctype="multipart/form-data">
				@csrf
                <div class="row">
                    <!-- left column -->
                    <div class="col-md-6">
                        <!-- general form elements -->
                        <div class="card card-primary">
                            <div class="card-header">
                                <h3 class="card-title">Category</h3>
                            </div>
                            <!-- /.card-header -->
                            <!-- form start -->

                            <div class="card-body">
                                <div class="form-group">
                                    <label for="categoryName">Category Name</label>
                                    <input  type="text" class="form-control" name="categoryName" id="categoryName" placeholder="Category name">
                                </div>

								<div class="appendCategory">
                                   @include('admin.category.append_category')
                                </div>

                                <div class="form-group">
                                    <label for="CategoryDiscount">Category Discount</label>
                                    <input type="text" required="" class="form-control" name="CategoryDiscount" id="CategoryDiscount" placeholder="Category Discount">
                                </div>
                                <div class="form-group">
                                    <label>Category description</label>
                                    <textarea required="" class="form-control" rows="2" name="CategoryDescripton" id="CategoryDescripton" placeholder="Category description ..."></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Meta description</label>
                                    <textarea required="" class="form-control" name="MetaDescripton" id="MetaDescripton" rows="2" placeholder="Meta description ..."></textarea>
                                </div>
                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>

                        </div>
                        <!-- /.card -->
                    </div>

                    <div class="col-md-6">
                        <!-- general form elements disabled -->
                        <div class="card card-warning">
                            <div class="card-header">
                                <h3 class="card-title">Section</h3>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Section</label>
                                            <select required="" class="form-control select2 select2-hidden-accessible" name="section" id="section" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                                                <option data-select2-id="30">Section</option>
                                                @foreach($dataSection as $section)
                                                <option data-select2-id="30" value="{{$section->id}}">{{$section->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <!-- text input -->
                                        <div class="form-group">
                                            <label for="categoryImage">Category Image</label>
                                            <div class="input-group">
                                                <div class="custom-file">
                                                    <input required="" type="file" class="custom-file-input" name="categoryImage" id="categoryImage">
                                                    <label class="custom-file-label" for="categoryImage">Choose file</label>
                                                </div>
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="">Upload</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12">
                                        <!-- textarea -->
                                        <div class="form-group">
                                            <label for="Url">Category Url</label>
                                            <input required="" type="text" class="form-control" name="url" id="url" placeholder="Url">
                                        </div>

                                        <div class="form-group">
                                            <label for="metaTitle">Meta title</label>
                                            <textarea required="" class="form-control" rows="2" name="metaTitle" id="metaTitle" placeholder="Meta Title"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="Meta keywords">Meta Keywords</label>
                                            <textarea required="" class="form-control" rows="2" name="metakeywords" id="metakeywords" placeholder="Meta keywords"></textarea>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </form>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

@endsection