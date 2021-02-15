@extends('layout.app')

@section('content')

<script>
window.onload = function () {

var chart6 = new CanvasJS.Chart("biaya", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title:{
    text: "Biaya Yang Dihemat"
  },
  axisY: {
    title: "Biaya"
  },
  data: [{        
    type: "column",  
    showInLegend: true, 
    legendMarkerColor: "grey",
    legendText: "Biaya yang dihemat",
    dataPoints: [
    <?php foreach ($n_jarak as $row) 
    {
      ?>
      { y: <?php echo $row->jumlah; ?>, label: "<?php if (empty($row->is_autoclose)) echo "IT Support"; else echo "User" ?>"},
      <?php
    }?>      
    ]
  }]
});
chart6.render();

}

</script>

<div class="content">      
  <div class="row">
      <div class="col-lg-6 col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title">Jumlah Biaya Yang Dihemat</h4>
          </div>
          <div class="card-body table-responsive">
            <div id="biaya" style="height: 300px; width: 100%;"></div>
          </div>
        </div>
      </div>
  </div>
</div>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endsection