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

var chart = new CanvasJS.Chart("userkategori", {
  animationEnabled: true,
  theme: "light2", // "light1", "light2", "dark1", "dark2"
  title:{
    text: "Gangguan Berulang"
  },
  axisY: {
    title: "Jumlah Gangguan"
  },
  data: [{        
    type: "column",  
    showInLegend: true, 
    legendMarkerColor: "grey",
    legendText: "Gangguan Per Orang per Kategori",
    dataPoints: [      
    <?php foreach ($n_user_kategori as $row) 
    {
      ?>
      { y: <?php echo $row->jumlah; ?>, label: "<?php echo $row->nip; ?>" },
      <?php
    }?>
    ]
  }]
});
chart.render();

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
      <div class="col-lg-6 col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title">Gangguan Berulang</h4>
          </div>
          <div class="card-body table-responsive">
            <table class="table table-hover">
              <thead class="text-danger">
                <th>No</th>
                <th>Nama</th>
                <th>Jenis Gangguan</th>
                <th>Jumlah</th>
              </thead>
              <tbody>
                <?php 
                $no = 1;
                foreach($n_user_kategori as $row)
                {
                  ?>
                  <tr>
                    <td><?php echo $no; $no++; ?></td>
                    <td><?php echo $row->nip; ?></td>
                    <td><?php echo $row->kategori; ?></td>
                    <td><?php echo $row->jumlah; ?></td>
                  </tr>
                  <?php
                } 
                ?>
              </tbody>
            </table>
            <!-- <div id="userkategori" style="height: 300px; width: 100%;"></div> -->
          </div>
        </div>
      </div>
  </div>
</div>

<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endsection