@extends('layout.app')

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">              
        <div class="card">
          <div class="card-header card-header-info">
            <h4 class="card-title ">CREATE ITSM</h4>
            <p class="card-category">Divisi STI Operasional Kaltimra</p>
          </div>
          <div class="card-body">
            <form>
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
              <div class="clearfix"></div>
            </form>
            <div class="row">
                <div class="col-md-12">
                  <div class="form-group label-floating has-info">
                    <a href="{{url('incident-tiket')}}/<?php echo $tiket->id; ?>" class="btn btn-danger btn-sm"><i class="fa fa-check-square-o" aria-hidden="true"></i> INCIDENT</a>
                    <a href="{{url('srq-tiket')}}/<?php echo $tiket->id; ?>" class="btn btn-warning btn-sm"><i class="fa fa-minus-square-o" aria-hidden="true"></i> SERVIE REQUEST</a>
                    <a href="{{url('email-tiket')}}/<?php echo $tiket->id; ?>" class="btn btn-info btn-sm"><i class="fa fa-envelope-o" aria-hidden="true"></i> EMAIL</a>
                  </div>
                </div>
              </div>
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