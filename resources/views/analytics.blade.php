@extends('layout.app')

@section('content')

<script>
window.onload = function () {

var chart1 = new CanvasJS.Chart("chartCallFitur", {
  animationEnabled: true,
  theme: "light1", // "light1", "light2", "dark1", "dark2"
  title:{
    text: "Saving Cost by Call Fitur"
  },
  axisY: {
    title: "Cost"
  },
  data: [{        
    type: "column",  
    showInLegend: true, 
    legendMarkerColor: "grey",
    legendText: "Saving Cost by Call Fitur",
    dataPoints: [
    <?php 
    $total = 0;
    foreach ($n_cost as $row) 
    {
      if (($row->is_sppd == 1) & ($row->is_autoclose != 1))
      {
        ?> { y: <?php $subtotal = $row->jumlah + (95000 * $row->jumlah_tiket); echo $subtotal; $total += $subtotal ?>, label: "<?php echo "SPPD"; ?>"}, <?php 
      }
      else if (($row->is_sppd != 1) & ($row->is_autoclose != 1))
      {
        ?> { y: <?php $subtotal = 95000 * $row->jumlah_tiket; echo $subtotal; $total += $subtotal ?>, label: "<?php echo "NO SPPD"; ?>"}, <?php
      } 
    }
    ?>      
    ]
  }]
});
chart1.render();

var chart2 = new CanvasJS.Chart("chartUserSolved", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title:{
    text: "Saving Cost by User Solved"
  },
  axisY: {
    title: "Cost"
  },
  data: [{        
    type: "column",  
    showInLegend: true, 
    legendMarkerColor: "grey",
    legendText: "Saving Cost by User Solved",
    dataPoints: [
    <?php 
    foreach ($n_cost as $row) 
    {
      if (($row->is_sppd == 1) & ($row->is_autoclose == 1))
      {
        ?> { y: <?php $subtotal = ($row->jumlah_tiket * 100000) + $row->jumlah_tiket; echo $subtotal; $total += $subtotal ?>, label: "<?php echo "SPPD"; ?>"}, <?php
      }
      else if (($row->is_sppd != 1) & ($row->is_autoclose != 1))
      {
        ?> { y: <?php $subtotal = ($row->jumlah_tiket * 100000) + $row->jumlah; echo $subtotal; $total += $subtotal ?>, label: "<?php echo "NO SPPD"; ?>"}, <?php
      } 
    }?>      
    ]
  }]
});
chart2.render();

var chart3 = new CanvasJS.Chart("chartTotalCost", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title:{
    text: "Saving Cost Total"
  },
  axisY: {
    title: "Cost"
  },
  data: [{        
    type: "column",  
    showInLegend: true, 
    legendMarkerColor: "grey",
    legendText: "Saving Cost Total",
    dataPoints: [
      { y: <?php echo $total; ?>,  label: "Total Cost" }
    ]
  }]
});
chart3.render();

}

</script>

<div class="content">      
  <div class="row">
      <div class="col-lg-6 col-md-12">
        <div class="card">
          <div class="card-header card-header-success">
            <h4 class="card-title">Saving Cost by Call Fitur</h4>
          </div>
          <div class="card-body table-responsive">
            <div id="chartCallFitur" style="height: 300px; width: 100%;"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title">Saving Cost by User Solved</h4>
          </div>
          <div class="card-body table-responsive">
            <div id="chartUserSolved" style="height: 300px; width: 100%;"></div>
          </div>
        </div>
      </div>
  </div>
  <div class="row">
      <div class="col-lg-6 col-md-12">
        <div class="card">
          <div class="card-header card-header-danger">
            <h4 class="card-title">Saving Cost Total</h4>
          </div>
          <div class="card-body table-responsive">
            <div id="chartTotalCost" style="height: 300px; width: 100%;"></div>
          </div>
        </div>
      </div>
  </div>
</div>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endsection