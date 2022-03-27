  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="/ecomm/public/admin/dashboard" class="brand-link">		   
		<img src="<?php echo asset('admin/dist/img/AdminLTELogo.png')?>" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: .8">
      <span class="brand-text font-weight-light">AdminLTE 3</span>
	  
	  
    </a>
    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
		
          <img src="<?php echo url('/');?>/admin/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
         <!-- <img src="{{asset('admin/dist/img/user2-160x160.jpg')}}" class="img-circle elevation-2" alt="User Image">  -->
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo Auth::guard('admin')->user()->name;?></a>
        </div>
      </div>
      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item has-treeview menu-open">
		  
			<?php 
			  if(Session::get('page')=='dashboard' or Session::get('page')=='admin-password' or Session::get('page')=='admin-details'){
				$class ="active";
			  }else{
					 $class ="";
			  } 
			  ?>
		  
            <a href="#" class="nav-link <?php echo $class ?>">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Settings
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
			
			
			<?php 
			  if(Session::get('page')=='admin-password'){
				$class ="active";
			  }else{
					 $class ="";
			  } 
			  ?>
			
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo url('/admin/password')?>" class="nav-link <?php echo $class ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update Password</p>
                </a>
              </li>
			  <?php 
			  if(Session::get('page')=='admin-details'){
				$class ="active";
			  }else{
					 $class ="";
			  } 
			  ?>
			  
              <li class="nav-item">
                <a href="<?php echo url('/admin/details')?>" class="nav-link <?php echo $class ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Update details</p>
                </a>
              </li>
            </ul>
        </li>
		  <!-- Section part start -->
		  
		<li class="nav-item has-treeview">
		
		  <?php 
			  if(Session::get('page')=='admin-section'){
				$class ="active";
			  }else{
					 $class ="";
			  } 
			  ?>
		
            <a href="#" class="nav-link <?php echo $class ?>">
              <i class="nav-icon fas fa-th"></i>
              <p>
                Section
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="<?php echo url('/admin/section')?>" class="nav-link <?php echo $class ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Section status</p>
                </a>
              </li>
            </ul>
          </li>
		<!-- Section part end -->
		<!-- category start -->
		
		<li class="nav-item has-treeview">
			<?php
			 if(Session::get('page')=='category'){
				$class ="active";
			  }else{
					 $class ="";
			  } 
			?>
		
            <a href="#" class="nav-link <?php echo $class ?>">
              <i class="nav-icon fas fa-chart-pie"></i>
              <p>
                categories
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                 <a href="<?php echo url('/admin/category')?>" class="nav-link <?php echo $class ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Category</p>
                </a>
              </li>
            </ul>
        </li>
		  <!-- category end -->
		  
		<!-- Product start -->
			<li class="nav-item has-treeview">
			<?php
			 if(Session::get('page')=='product'){
				$class ="active";
			  }else{
					 $class ="";
			  } 
			?>
		
            <a href="#" class="nav-link <?php echo $class ?>">
              <i class="nav-icon fas nav-icon fas fa-tree"></i>
              <p>
                product
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                 <a href="<?php echo url('/admin/product')?>" class="nav-link <?php echo $class ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add product</p>
                </a>
              </li>
            </ul>
        </li>
		<!-- Product end -->
		
			<!-- Brand start -->
		<li class="nav-item has-treeview">
			<?php
			 if(Session::get('page')=='brand'){
				$class ="active";
			  }else{
					 $class ="";
			  } 
			?>
		
            <a href="#" class="nav-link <?php echo $class ?>">
              <i class="fa fa-dribbble"></i>
              <p> &nbsp;&nbsp;Brands <i class="right fas fa-angle-left"></i> </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                 <a href="<?php echo url('/admin/brands')?>" class="nav-link <?php echo $class ?>">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Brand</p>
                </a>
              </li>
            </ul>
        </li>
		
		<!-- Banner start -->
		
		<li class="nav-item has-treeview">
			<?php
			 if(Session::get('page')=='banner'){
				$class ="active";
			  }else{
					 $class ="";
			  } 
			?>

			<li class="nav-item">
				<a href="<?php echo url('/admin/banners')?>" class="nav-link <?php echo $class ?>">
				  <i class="far fa-circle nav-icon"></i>
				  <p>Banner</p>
				</a>
			</li>
        </li>
		<!-- Banner end -->
		
		<!-- Coupon start -->
			<li class="nav-item has-treeview">
			<?php
			 if(Session::get('page')=='coupons'){
				$class ="active";
			  }else{
					 $class ="";
			  } 
			?>

			<li class="nav-item">
				<a href="<?php echo url('/admin/coupons')?>" class="nav-link <?php echo $class ?>">
				  <i class="far fa-circle nav-icon"></i>
				  <p>Coupon</p>
				</a>
			</li>
        </li>
		<!-- Coupon end -->
		
		<!-- Coupon start -->
		<li class="nav-item has-tree view">
			<?php
			 if(Session::get('page')=='order'){
				$class ="active";
			  }else{
					 $class ="";
			  } 
			?>

			<li class="nav-item">
				<a href="<?php echo url('/admin/order')?>" class="nav-link <?php echo $class ?>">
				  <i class="far fa-circle nav-icon"></i>
				  <p>Orders</p>
				</a>
			</li>
        </li>
		<!-- Coupon end -->
		
		<!-- Shipping start -->
		<li class="nav-item has-tree view">
			<?php
			 if(Session::get('page')=='shipping'){
				$class ="active";
			  }else{
					 $class ="";
			  } 
			?>

			<li class="nav-item">
				<a href="<?php echo url('/admin/shipping-charge')?>" class="nav-link <?php echo $class ?>">
				  <i class="far fa-circle nav-icon"></i>
				  <p>shipping Charge</p>
				</a>
			</li>
        </li>
		<!-- Shipping end -->
		
				
		<!-- Users start -->
		
		<li class="nav-item has-tree view">
			<?php
			 if(Session::get('page')=='users'){
				$class ="active";
			  }else{
					 $class ="";
			  } 
			?>
			
			<a href="#" class="nav-link <?php echo $class ?>">
              <i class="fa fa-user"></i>
              <p> &nbsp;&nbsp;Users <i class="right fas fa-angle-left"></i> </p>
            </a>

			<ul class="nav nav-treeview">
				<li class="nav-item">
					<a href="<?php echo url('/admin/users')?>" class="nav-link <?php echo $class ?>">
					  <i class="far fa-circle nav-icon"></i>
					  <p>User List</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo url('/admin/users-chart')?>" class="nav-link <?php echo $class ?>">
					  <i class="far fa-circle nav-icon"></i>
					  <p>User chart</p>
					</a>
				</li>
				<li class="nav-item">
					<a href="<?php echo url('/admin/users-country')?>" class="nav-link <?php echo $class ?>">
					  <i class="far fa-circle nav-icon"></i>
					  <p>User Country Chart</p>
					</a>
				</li>
			</ul>
        </li>
		<!-- Users end -->
		
		<!-- Cms page start -->
		<li class="nav-item has-tree view">
			<?php
			 if(Session::get('page')=='cms'){
				$class ="active";
			  }else{
					 $class ="";
			  } 
			?>

			<li class="nav-item">
				<a href="<?php echo url('/admin/cms-pages')?>" class="nav-link <?php echo $class ?>">
				  <i class="far fa-circle nav-icon"></i>
				  <p>Cms Pages</p>
				</a>
			</li>
        </li>
		<!-- Cms end -->
		
		
		<!-- Currency page start -->
		<li class="nav-item has-tree view">
			<?php
			 if(Session::get('page')=='currency'){
				$class ="active";
			  }else{
					 $class ="";
			  } 
			?>

			<li class="nav-item">
				<a href="<?php echo url('/admin/currency')?>" class="nav-link <?php echo $class ?>">
				  <i class="far fa-circle nav-icon"></i>
				  <p>Currency</p>
				</a>
			</li>
        </li>
		<!-- Currency end -->
		
		<!-- Admin role page start -->
		<?php if(Auth::guard('admin')->user()->type =="superadmin" ||Auth::guard('admin')->user()->type =="admin") { ?>
		<li class="nav-item has-tree view">
			<?php
			 if(Session::get('page')=='adminrole'){
				$class ="active";
			  }else{
					 $class ="";
			  } 
			?>

			<li class="nav-item">
				<a href="<?php echo url('/admin/list')?>" class="nav-link <?php echo $class ?>">
				  <i class="far fa-circle nav-icon"></i>
				  <p>Admin</p>
				</a>
			</li>
        </li>
		<?php } ?>
		<!-- Admin rolepage end -->
		
		<!-- Rating page start -->
		<li class="nav-item has-tree view">
			<?php
			 if(Session::get('page')=='rating'){
				$class ="active";
			  }else{
					 $class ="";
			  } 
			?>

			<li class="nav-item">
				<a href="<?php echo url('/admin/rating')?>" class="nav-link <?php echo $class ?>">
				  <i class="far fa-circle nav-icon"></i>
				  <p>Rating</p>
				</a>
			</li>
			<!-- Rating page start end-->
			<!-- Return page start -->
			<?php
			 if(Session::get('page')=='return'){
				$class ="active";
			  }else{
					 $class ="";
			  } 
			?>
			
			<li class="nav-item">
				<a href="<?php echo url('/admin/return')?>" class="nav-link <?php echo $class ?>">
				  <i class="far fa-circle nav-icon"></i>
				  <p>Return Order</p>
				</a>
			</li>
			<!-- Return page start -->
			
			<!-- Exchange page start -->
			
			<?php
			 if(Session::get('page')=='exchange'){
				$class ="active";
			  }else{
					 $class ="";
			  } 
			?>
			
			<li class="nav-item">
				<a href="<?php echo url('/admin/exchange')?>" class="nav-link <?php echo $class ?>">
				  <i class="far fa-circle nav-icon"></i>
				  <p>Exchange Order</p>
				</a>
			</li>
			<!-- Exchange page start -->
			
			<!-- News List page start -->
			<?php
			 if(Session::get('page')=='news-list'){
				$class ="active";
			  }else{
					 $class ="";
			  } 
			?>
			
			<li class="nav-item">
				<a href="<?php echo url('/admin/news-list')?>" class="nav-link <?php echo $class ?>">
				  <i class="far fa-circle nav-icon"></i>
				  <p>News List</p>
				</a>
			</li>
			<!-- News List page end -->
			
			<!-- Import pincode page start -->
			<?php
			 if(Session::get('page')=='import pin'){
				$class ="active";
			  }else{
					 $class ="";
			  } 
			?>
			
			<li class="nav-item">
				<a href="<?php echo url('/admin/import-pin')?>" class="nav-link <?php echo $class ?>">
				  <i class="far fa-circle nav-icon"></i>
				  <p>Import Pincode</p>
				</a>
			</li>
			<!-- Import pincode page end -->
			
        </li>
		<!-- Currency end -->
		

        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>
