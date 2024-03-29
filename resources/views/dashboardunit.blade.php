@extends('layout.app')

@section('content')

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
              <a href="{{url('today-tiket')}}">Daftar Semua Tiket Hari Ini</a>
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
              <a href="{{url('today-open')}}">Daftar Tiket Open Hari Ini</a>
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
              <a href="{{url('today-assigned')}}">Daftar Tiket Assigned Hari Ini</a>
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
              <a href="{{url('today-resolved')}}">Daftar Tiket Resolved Hari Ini</a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-6 col-md-12">
        <div class="card">
          <div class="card-header card-header-success">
            <h4 class="card-title">Tiket Open</h4>
          </div>
          <div class="card-body table-responsive">
            <table class="table table-hover">
              <thead class="text-danger">
                <th>No</th>
                <th>Pelapor</th>
                <th>Jam</th>
                <th>Action</th>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($tiket_open as $row) 
                {
                  $diff = (strtotime(date("Y-m-d H:i:s")) - strtotime($row->start_date))/60;
                  if($diff >= 60 && !empty($row->start_date))
                  {
                    ?>
                    <tr style="color: red">
                      <td><b><?php echo $no; $no++; ?></b></td>
                      <td><b><?php echo $row->pegawai->name."(".$row->pegawai->nip.")<br/>".$row->pegawai->position."<br/>".$row->pegawai->personnel_area_name." - ".$row->pegawai->personnel_subarea_name; ?>
                        <?php if(!empty($row->lokasi))
                        {
                          ?>
                          <br/><?php echo "(".$row->lokasi.")";?> 
                          <?php
                        }
                        ?></b>
                      </td>
                      <td><b><?php echo $row->call_type."<br/>".$row->start_date; ?></b></td>
                      <td><a href="{{url('createitsm-tiket')}}/<?php echo $row->id; ?>" class="btn btn-info">CREATE ITSM</a></td>
                    </tr>
                    <?php
                  }
                  else
                  {
                    ?>
                    <tr>
                      <td><?php echo $no; $no++; ?></td>
                      <td><?php echo $row->pegawai->name."(".$row->pegawai->nip.")<br/>".$row->pegawai->position."<br/>".$row->pegawai->personnel_area_name." - ".$row->pegawai->personnel_subarea_name; ?>
                        <?php if(!empty($row->lokasi))
                        {
                          ?>
                          <br/><?php echo "(".$row->lokasi.")";?> 
                          <?php
                        }
                        ?>
                      </td>
                      <td><?php echo $row->call_type."<br/>".$row->start_date; ?></td>
                      <td>
                        <a href="{{url('createitsm-tiket')}}/<?php echo $row->id; ?>" class="btn btn-info">CREATE ITSM</a>
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
                  <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card">
          <div class="card-header card-header-danger">
            <h4 class="card-title">Tiket Pending</h4>
          </div>
          <div class="card-body table-responsive">
            <table class="table table-hover">
              <thead class="text-danger">
                <th>No</th>
                <th>Pelapor</th>
                <th>Jam</th>
                <th>Action</th>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($tiket_pending as $row) 
                {
                  $diff = (strtotime(date("Y-m-d H:i:s")) - strtotime($row->start_date))/60;
                  if($diff >= 60 && !empty($row->start_date))
                  {
                    ?>
                    <tr style="color: red">
                      <td><b><?php echo $no; $no++; ?></b></td>
                      <td><b><?php echo $row->pegawai->name."(".$row->pegawai->nip.")<br/>".$row->pegawai->position."<br/>".$row->pegawai->personnel_area_name." - ".$row->pegawai->personnel_subarea_name; ?>
                        <?php if(!empty($row->lokasi))
                        {
                          ?>
                          <br/><?php echo "(".$row->lokasi.")";?> 
                          <?php
                        }
                        ?></b>
                      </td>
                      <td><b><?php echo $row->call_type."<br/>".$row->start_date; ?></b></td>
                      <td><a href="{{url('continue')}}/<?php echo $row->id; ?>" class="btn btn-info">CONTINUE</a></td>
                    </tr>
                    <?php
                  }
                  else
                  {
                    ?>
                    <tr>
                      <td><?php echo $no; $no++; ?></td>
                      <td><?php echo $row->pegawai->name."(".$row->pegawai->nip.")<br/>".$row->pegawai->position."<br/>".$row->pegawai->personnel_area_name." - ".$row->pegawai->personnel_subarea_name; ?>
                        <?php if(!empty($row->lokasi))
                        {
                          ?>
                          <br/><?php echo "(".$row->lokasi.")";?> 
                          <?php
                        }
                        ?>
                      </td>
                      <td><?php echo $row->call_type."<br/>".$row->start_date; ?></td>
                      <td>
                        <a href="{{url('continue')}}/<?php echo $row->id; ?>" class="btn btn-info">CONTINUE</a>
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
                  <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-12">
        <div class="card">
          <div class="card-header card-header-warning">
            <h4 class="card-title">Tiket Create ITSM</h4>
          </div>
          <div class="card-body table-responsive">
            <table class="table table-hover">
              <thead class="text-danger">
                <th>No</th>
                <th>Pelapor</th>
                <th>Jam</th>
                <th>Action</th>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($tiket_createitsm as $row) 
                {
                  $diff = (strtotime(date("Y-m-d H:i:s")) - strtotime($row->start_date))/60;
                  if($diff >= 60 && !empty($row->start_date))
                  {
                    ?>
                    <tr style="color: red">
                      <td><b><?php echo $no; $no++; ?></b></td>
                      <td><b><?php echo $row->pegawai->name."(".$row->pegawai->nip.")<br/>".$row->pegawai->position."<br/>".$row->pegawai->personnel_area_name." - ".$row->pegawai->personnel_subarea_name; ?>
                        <?php if(!empty($row->lokasi))
                        {
                          ?>
                          <br/><?php echo "(".$row->lokasi.")";?> 
                          <?php
                        }
                        ?></b>
                      </td>
                      <td><b><?php echo $row->call_type."<br/>".$row->start_date; ?></b></td>
                      <td><a href="{{url('assign-tiket')}}/<?php echo $row->id; ?>" class="btn btn-info">ASSIGN</a></td>
                    </tr>
                    <?php
                  }
                  else
                  {
                    ?>
                    <tr>
                      <td><?php echo $no; $no++; ?></td>
                      <td><?php echo $row->pegawai->name."(".$row->pegawai->nip.")<br/>".$row->pegawai->position."<br/>".$row->pegawai->personnel_area_name." - ".$row->pegawai->personnel_subarea_name; ?>
                        <?php if(!empty($row->lokasi))
                        {
                          ?>
                          <br/><?php echo "(".$row->lokasi.")";?> 
                          <?php
                        }
                        ?>
                      </td>
                      <td><?php echo $row->call_type."<br/>".$row->start_date; ?></td>
                      <td>
                        <a href="{{url('assign-tiket')}}/<?php echo $row->id; ?>" class="btn btn-info">ASSIGN</a>
                      </td>
                    </tr>
                    <?php
                  }
                  ?>
                  <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title">Tiket Assigned</h4>
          </div>
          <div class="card-body table-responsive">
            <table class="table table-hover">
              <thead class="text-info">
                <th>No</th>
                <th>Pelapor</th>
                <th>Jam</th>
                <th>Action</th>
              </thead>
              <tbody>
                <?php
                $no = 1;
                foreach ($tiket_assigned as $row) 
                {
                  $diff = (strtotime(date("Y-m-d H:i:s")) - strtotime($row->assignment_date))/60;
                  if($diff >= 630 && !empty($row->assignment_date))
                  {
                    ?>
                    <tr style="color: red">
                      <td><b><?php echo $no; $no++; ?></b></td>
                      <td><b><?php echo $row->pegawai->name."(".$row->pegawai->nip.")<br/>".$row->pegawai->position."<br/>".$row->pegawai->personnel_area_name." - ".$row->pegawai->personnel_subarea_name; ?>
                        <?php if(!empty($row->lokasi))
                        {
                          ?>
                          <br/><?php echo "(".$row->lokasi.")";?> 
                          <?php
                        }
                        ?></b>
                      </td>
                      <td><b><?php echo $row->call_type."<br/>".$row->start_date; ?></b></td>
                      <td>
                        <a href="{{url('resolve')}}/<?php echo $row->id; ?>" class="btn btn-info">RESOLVE</a>
                        <a href="{{url('pending')}}/<?php echo $row->id; ?>" class="btn btn-danger">PENDING</a>
                      </td>
                    </tr>
                    <?php
                  }
                  else
                  {
                    ?>
                    <tr>
                      <td><?php echo $no; $no++; ?></td>
                      <td><?php echo $row->pegawai->name."(".$row->pegawai->nip.")<br/>".$row->pegawai->position."<br/>".$row->pegawai->personnel_area_name." - ".$row->pegawai->personnel_subarea_name; ?>
                        <?php if(!empty($row->lokasi))
                        {
                          ?>
                          <br/><?php echo "(".$row->lokasi.")";?> 
                          <?php
                        }
                        ?>
                      </td>
                      <td><?php echo $row->call_type."<br/>".$row->start_date; ?></td>
                      <td><a href="{{url('resolve')}}/<?php echo $row->id; ?>" class="btn btn-info">RESOLVE</a>
                      <a href="{{url('pending')}}/<?php echo $row->id; ?>" class="btn btn-danger">PENDING</a></td>
                    </tr>
                    <?php
                  }
                  ?>
                  <?php
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection