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
	
			foreach($userlist as $key=>$country){
				$dataPoints[$key]['label'] = $userlist[$key]['country'];
				$dataPoints[$key]['y'] = $userlist[$key]['total'];
			}
			
	
		/* 	
		$dataPoints = array( 
			
				array("label"=>"Chrome", "y"=>64.02),
				array("label"=>"Firefox", "y"=>12.55),
				array("label"=>"IE", "y"=>8.47),
				array("label"=>"Safari", "y"=>6.08),
				array("label"=>"Edge", "y"=>4.29),
				array("label"=>"Others", "y"=>4.59)
		); */

 
?>



<script>

window.onload = function() {
 
 
var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	title: {
		text: "Users Country list registered"
	},
	subtitles: [{
		text: "November 2017"
	}],
	data: [{
		type: "pie",
		yValueFormatString: "#,##0.00\"%\"",
		indexLabel: "{label} ({y})",
		dataPoints: <?php echo json_encode($dataPoints, JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();
 
}
</script>

<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                            
</div>
@endsection