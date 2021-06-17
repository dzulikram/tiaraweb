@extends('layout.app')

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">              
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title ">ASSIGN TIKET</h4>
            <p class="card-category">Divisi STI</p>
          </div>
          <div class="card-body">
            <form method="post" action="{{url('assign-tiket')}}/<?php echo $tiket->id; ?>">
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
                    <input type="text" name="personnel_area_name" class="form-control" value="<?php echo $tiket->pegawai->personnel_area_name; ?>" disabled>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group label-floating has-info">
                    <label class="bmd-label-floating">Sub Unit</label>
                    <input type="text" name="personnel_subarea_name" class="form-control" value="<?php echo $tiket->pegawai->personnel_subarea_name; ?>" disabled>
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
              <!-- <div class="row">
                <div class="col-md-12">
                  <div class="form-group label-floating has-info">
                    <label class="bmd-label-floating">Assignment Date</label>
                    <input type="text" class="form-control" value="<?php echo $tiket->assignment_date; ?>" disabled>
                  </div>
                </div>
              </div> -->
              <!-- <div class="row">
                <div class="col-md-12">
                  <div class="form-group label-floating has-info">
                    <label class="bmd-label-floating">End Date</label>
                    <input type="text" class="form-control" value="<?php echo $tiket->end_date; ?>" disabled>
                  </div>
                </div>
              </div> -->
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group label-floating has-info">
                    <label class="bmd-label-floating">NO Tiket</label>
                    <input type="text" name="no_tiket" class="form-control" value="<?php echo $tiket->no_tiket; ?>">
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group label-floating has-info">
                    <label class="bmd-label-floating">Kategori</label>
                    <select class="form-control" name="kategori_id" required>
                      <option></option>
                      <?php foreach ($kategoris as $row) {
                        ?>
                        <option value="<?php echo $row->id; ?>" <?php if(($row->id == $tiket->kategori_id) && !empty($tiket->kategori_id)) echo "selected"; ?>><?php echo $row->kategori; ?></option>
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
                    <select class="form-control" name="it_support_username" required>
                      <option></option>
                      <?php foreach ($users as $row) {
                        ?>
                        <option value="<?php if(!empty($row->username)) echo $row->username; ?>
                          <?php if(!empty($row->LoginID)) echo $row->LoginID; ?>">
                          <?php if(!empty($row->name)) echo $row->name; ?>
                          <?php if(!empty($row->Nama)) echo $row->Nama; ?></option>
                        <?php
                      } ?>
                    </select>
                  </div>
                </div>
              </div>
              <button type="submit" class="btn btn-info pull-right">ASSIGN ITSM</button>
              <!-- <button type="submit" class="btn btn-primary pull-right" disabled>ASSIGN IVANTI (SOON)</button> -->
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