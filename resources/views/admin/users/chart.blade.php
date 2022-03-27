@extends('layouts.admin_layout.admin_design')
@section('content')
 
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Users chart</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Users chart</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
	
	
	
<?php 

$firstMont = date('M Y',strtotime("-0 month"));
$count = 0;
$month = array();
while($count <=5){
	$month[] = date('M Y',strtotime("-".$count." month"));
	$count++;
}

$dataPoints = array(
	array("y" => $monthUsers[0], "label" => $month[0]),
	array("y" => $monthUsers[1], "label" => $month[1]),
	array("y" => $monthUsers[2], "label" => $month[2]),
	array("y" => $monthUsers[3], "label" =>  $month[3]),
	array("y" => $monthUsers[4], "label" => $month[4]),
	array("y" => $monthUsers[5], "label" => $month[5])
);
 
?>

<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
 <script>
window.onload = function () {
 
var chart = new CanvasJS.Chart("chartContainer", {
	title: {
		text: "Registered user in a Month"
	},
	axisY: {
		title: "No of user in a Month"
	},
	data: [{
		type: "line",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>

@endsection