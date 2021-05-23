@extends('layout.app')

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">              
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title ">Email Service Desk</h4>
            <p class="card-category">Divisi STI Operasional Kaltimra</p>
          </div>
          <div class="card-body">
            <form method="post" action="{{url('email-tiket')}}/<?php echo $tiket->id; ?>">
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
                    <input type="text" name="permasalahan" class="form-control" value="<?php echo $tiket->permasalahan; ?>" required>
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group label-floating has-info">
                    <label class="bmd-label-floating">Aplikasi yang bermasalah</label>
                    <select class="form-control" name="kategori_id" required>
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
              <button type="submit" class="btn btn-sm btn-info pull-right">CREATE ITSM</button>       
              <a href="{{url('createitsm-tiket')}}/<?php echo $tiket->id; ?>" class="btn btn-sm btn-light-dark pull-right">Cancel</a>     
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