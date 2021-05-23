@extends('layout.app')

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">              
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title ">PENDING TIKET</h4>
            <p class="card-category">Divisi STI Operasional Kaltimra</p>
          </div>
          <div class="card-body">
            <form method="post" action="{{url('continue')}}/<?php echo $tiket->id; ?>">
              @csrf
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group label-floating has-info">
                    <label class="bmd-label-floating">Nama</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $tiket->pegawai->name; ?>" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group label-floating has-info">
                    <label class="bmd-label-floating">NIP</label>
                    <input type="text" name="nip" class="form-control" value="<?php echo $tiket->pegawai->nip; ?>" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group label-floating has-info">
                    <label class="bmd-label-floating">Call Type</label>
                    <input type="text" name="call_type" class="form-control" value="<?php echo $tiket->call_type; ?>" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group label-floating has-info">
                    <label class="bmd-label-floating">Unit</label>
                    <input type="text" name="personnel_area_name" class="form-control" value="<?php echo $tiket->pegawai->unit_induk; ?>" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group label-floating has-info">
                    <label class="bmd-label-floating">Sub Unit</label>
                    <input type="text" name="personnel_subarea_name" class="form-control" value="<?php echo $tiket->pegawai->unit; ?>" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group label-floating has-info">
                    <label class="bmd-label-floating">Jabatan</label>
                    <input type="text" name="name" class="form-control" value="<?php echo $tiket->pegawai->position; ?>" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group label-floating has-info">
                    <label class="bmd-label-floating">Permasalahan</label>
                    <input type="text" name="permasalahan" class="form-control" value="<?php echo $tiket->permasalahan; ?>" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group label-floating has-info">
                    <label class="bmd-label-floating">Start Date</label>
                    <input type="text" class="form-control" value="<?php echo $tiket->start_date; ?>" disabled>
                  </div>
                </div>
              </div>
              <?php if($tiket->kategori_id<='97'){?>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group label-floating has-info">
                    <label class="bmd-label-floating">Assignment Date</label>
                    <input type="text" class="form-control" value="<?php echo $tiket->assignment_date; ?>" disabled>
                  </div>
                </div>
              </div>
              <!-- <div class="row">
                <div class="col-md-12">
                  <div class="form-group label-floating has-info">
                    <label class="bmd-label-floating">End Date</label>
                    <input type="text" class="form-control" value="<?php echo $tiket->end_date; ?>" disabled>
                  </div>
                </div>
              </div> -->
              <!-- <div class="row">
                <div class="col-md-12">
                  <div class="form-group label-floating has-info">
                    <label class="bmd-label-floating">NO Tiket</label>
                    <input type="text" name="no_tiket" class="form-control" value="<?php echo $tiket->no_tiket; ?>">
                  </div>
                </div>
              </div> -->
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group label-floating has-info">
                    <label class="bmd-label-floating">Kategori</label>
                    <select class="form-control" name="kategori_id" disabled>
                      <option></option>
                      <?php foreach ($kategoris as $row) {
                        ?>
                        <option value="<?php echo $row->id; ?>" <?php if(($row->id == $tiket->kategori_id) && !empty($tiket->kategori_id)) echo "selected"; ?>><?php echo $row->name; ?></option>
                        <?php
                      } ?>
                    </select>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group label-floating has-info">
                    <label class="bmd-label-floating">IT Support</label>
                    <select class="form-control" name="it_support" disabled>
                      <option></option>
                      <?php foreach ($users as $row) {
                        ?>
                        <option value="<?php echo $row->username; ?>" <?php if($row->username == $tiket->it_support) echo "selected"; ?>><?php echo $row->name; ?></option>
                        <?php
                      } ?>
                    </select>
                  </div>
                </div>
              </div>
              <?php } ?>
              <button type="submit" class="btn btn-sm btn-info pull-right">CONTINUE</button>
              <a href="{{url('dashboard')}}" class="btn btn-sm btn-light-dark pull-right">CANCEL</a>
              <div class="clearfix"></div>
            </form>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <div class="card card-plain">
          <div class="card-body">
            
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection