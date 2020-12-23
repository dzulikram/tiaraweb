@extends('layout.app')

@section('content')

<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
  animationEnabled: true,
  title:{
    text: "Solved by IT Support",
    horizontalAlign: "left"
  },
  data: [{
    type: "doughnut",
    startAngle: 60,
    //innerRadius: 60,
    indexLabelFontSize: 17,
    indexLabel: "{label} - #percent%",
    toolTipContent: "<b>{label}:</b> {y} (#percent%)",
    dataPoints: [
    <?php foreach ($n_kategori as $row) 
    {
      ?>
      { y: <?php echo $row->jumlah; ?>, label: "<?php echo $row->kategori; ?>",x: <?php echo $row->id; ?> },
      <?php
    }?>
    ],
    click: function(e){
    window.location.href = "{{url('tiket/kategori')}}/"+e.dataPoint.x;
    },
  }]
});
chart.render();

var chart2 = new CanvasJS.Chart("autoCloseChart", {
  animationEnabled: true,
  title:{
    text: "Solved by User",
    horizontalAlign: "left"
  },
  data: [{
    type: "doughnut",
    startAngle: 60,
    //innerRadius: 60,
    indexLabelFontSize: 17,
    indexLabel: "{label} - #percent%",
    toolTipContent: "<b>{label}:</b> {y} (#percent%)",
    dataPoints: [
    <?php foreach ($n_autoclose as $row) 
    {
      ?>
      { y: <?php echo $row->jumlah; ?>, label: "<?php echo $row->permasalahan; ?>" },
      <?php
    }?>
    ],
    click: function(e){
    window.location.href = "{{url('tiket/permasalahan')}}/"+e.dataPoint.label;
    },
  }]
});
chart2.render();

var chart3 = new CanvasJS.Chart("supportChart", {
  animationEnabled: true,
  data: [{
    type: "doughnut",
    startAngle: 60,
    //innerRadius: 60,
    indexLabelFontSize: 17,
    indexLabel: "{label} - #percent%",
    toolTipContent: "<b>{label}:</b> {y} (#percent%)",
    dataPoints: [
    <?php foreach ($n_support as $row) 
    {
      ?>
      { y: <?php echo $row->jumlah; ?>, label: "<?php echo $row->name; ?>",x: <?php echo $row->id; ?> },
      <?php
    }?>
    ],
    click: function(e){
    window.location.href = "{{url('tiket/support')}}/"+e.dataPoint.x;
    },
  }]
});
chart3.render();

var chart4 = new CanvasJS.Chart("userChart", {
  animationEnabled: true,
  data: [{
    type: "doughnut",
    startAngle: 60,
    //innerRadius: 60,
    indexLabelFontSize: 17,
    indexLabel: "{label} - #percent%",
    toolTipContent: "<b>{label}:</b> {y} (#percent%)",
    dataPoints: [
    <?php foreach ($n_user as $row) 
    {
      ?>
      { y: <?php echo $row->jumlah; ?>, label: "<?php echo $row->name; ?>",x: "<?php echo $row->nip; ?>" },
      <?php
    }?>
    ],
    click: function(e){
    window.location.href = "{{url('tiket/user')}}/"+e.dataPoint.x;
    },
  }]
});
chart4.render();

}

</script>

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-warning card-header-icon">
            <div class="card-icon">
              <i class="material-icons">content_copy</i>
            </div>
            <p class="card-category">Semua Tiket</p>
            <h3 class="card-title"><?php echo $n_tiket; ?></h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <a href="{{url('tiket')}}">Daftar Semua Tiket</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-danger card-header-icon">
            <div class="card-icon">
              <i class="fa fa-sign-in"></i>
            </div>
            <p class="card-category">Tiket Open</p>
            <h3 class="card-title"><?php echo $n_open; ?></h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <a href="{{url('tiket-open')}}">Daftar Tiket Open</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-info card-header-icon">
            <div class="card-icon">
              <i class="fa fa-users" aria-hidden="true"></i>
            </div>
            <p class="card-category">Tiket Assigned</p>
            <h3 class="card-title"><?php echo $n_assigned; ?></h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <a href="{{url('tiket-assigned')}}">Daftar Tiket Assigned</a>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
          <div class="card-header card-header-success card-header-icon">
            <div class="card-icon">
              <i class="fa fa-check"></i>
            </div>
            <p class="card-category">Tiket Resolved</p>
            <h3 class="card-title"><?php echo $n_resolved; ?></h3>
          </div>
          <div class="card-footer">
            <div class="stats">
              <a href="{{url('tiket-resolved')}}">Daftar Tiket Resolved</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-12">
        <div class="card">
          <div class="card-header card-header-danger">
            <h4 class="card-title">Jumlah Tiket per Kategori</h4>
          </div>
          <div class="card-body table-responsive">
            <div id="chartContainer" style="height: 300px; width: 100%;"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12">
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title">Permasalahan Auto Close</h4>
          </div>
          <div class="card-body table-responsive">
            <div id="autoCloseChart" style="height: 300px; width: 100%;"></div>
          </div>
        </div>
      </div>
  </div>
  <div class="row">
      <div class="col-lg-6 col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title">Jumlah Tiket per IT Support</h4>
          </div>
          <div class="card-body table-responsive">
            <div id="supportChart" style="height: 300px; width: 100%;"></div>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12">
        <div class="card">
          <div class="card-header card-header-success">
            <h4 class="card-title">Jumlah Tiket per User</h4>
          </div>
          <div class="card-body table-responsive">
            <div id="userChart" style="height: 300px; width: 100%;"></div>
          </div>
        </div>
      </div>
  </div>
</div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
@endsection