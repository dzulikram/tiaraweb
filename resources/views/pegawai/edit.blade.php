@extends('layout.app')

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">              
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title ">EDIT PEGAWAI</h4>
                  <p class="card-category">Divisi STI Operasional Kaltimra</p>
                </div>
                <div class="card-body">
                  <form method="post" action="{{url('pegawai/{id}')}}">
                    @csrf         
                    {{ method_field('put') }}
                    <input type="hidden" name="id" value="<?php echo $pegawai->id;?>" class="form-control">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Nama</label>
                          <input type="text" name="name" value="<?php echo $pegawai->name;?>" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">NIP</label>
                          <input type="text" name="nip" value="<?php echo $pegawai->nip;?>" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Username</label>
                          <input type="text" name="username" value="<?php echo $pegawai->username;?>" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Personnel Area</label>
                          <input type="text" name="personnel_area" value="<?php echo $pegawai->personnel_area;?>" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Personnel Subarea</label>
                          <input type="text" name="personnel_subarea" value="<?php echo $pegawai->personnel_subarea;?>" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Personnel Area Name</label>
                          <input type="text" name="personnel_area_name" value="<?php echo $pegawai->personnel_area_name;?>" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Personnel Subarea Name</label>
                          <input type="text" name="personnel_subarea_name" value="<?php echo $pegawai->personnel_subarea_name;?>" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Position</label>
                          <input type="text" name="position" value="<?php echo $pegawai->position;?>" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Email</label>
                          <input type="text" name="email" value="<?php echo $pegawai->email;?>" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Sender</label>
                          <input type="number" name="sender" value="<?php echo $pegawai->sender;?>" class="form-control">
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-info pull-right">UPDATE PEGAWAI</button>
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