@extends('layout.app')

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">              
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title ">INPUT PEGAWAI</h4>
                  <p class="card-category">Divisi STI</p>
                </div>
                <div class="card-body">
                  <form method="post" action="{{url('pegawai')}}">
                    @csrf
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Nama</label>
                          <input type="text" name="name" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">NIP</label>
                          <input type="text" name="nip" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Username</label>
                          <input type="text" name="username" class="form-control">
                        </div>
                      </div>
                    </div> -->
                    <!-- <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Personnel Area</label>
                          <input type="text" name="personnel_area" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Business Area</label>
                          <input type="text" name="business_area" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Personnel Subarea</label>
                          <input type="text" name="personnel_subarea" class="form-control">
                        </div>
                      </div>
                    </div> -->
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Personnel Area Name</label>
                          <select class="form-control" name="personnel_area_name" required>
                            <option></option>
                            <?php foreach ($unit_induk as $row) {
                              ?>
                              <option value="<?php echo $row->unit_induk; ?>"><?php echo $row->unit_induk; ?></option>
                              <?php
                            } ?>
                          <select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Business Area Name</label>
                          <select class="form-control" name="business_area_name" required>
                            <option></option>
                            <?php foreach ($unit_pelaksana as $row) {
                              ?>
                              <option value="<?php echo $row->unit_pelaksana; ?>"><?php echo $row->unit_pelaksana; ?></option>
                              <?php
                            } ?>
                          <select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Personnel Subarea Name</label>
                          <select class="form-control" name="personnel_subarea_name">
                            <option></option>
                            <?php foreach ($unit_subpelaksana as $row) {
                              ?>
                              <option value="<?php echo $row->unit_subpelaksana; ?>"><?php if(!empty($row->unit_subpelaksana)){echo $row->unit_subpelaksana;} ?></option>
                              <?php
                            } ?>
                          <select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Unit Induk</label>
                          <input type="text" name="unit_induk" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Unit</label>
                          <input type="text" name="unit" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Position</label>
                          <input type="text" name="position" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Email</label>
                          <input type="text" name="email" class="form-control" required>
                        </div>
                      </div>
                    </div>
                    @hasrole('admin')                   
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">STI Operasional</label>
                          <select class="form-control" name="sti_id" required>
                            <option></option>
                            <?php foreach ($sti as $row) {
                              ?>
                              <option value="<?php echo $row->id; ?>"><?php echo $row->team; ?></option>
                              <?php
                            } ?>
                          <select>
                        </div>
                      </div>
                    </div> 
                    @endhasrole                    
                    <button type="submit" class="btn btn-sm btn-info pull-right">INPUT PEGAWAI</button>
                    <a href="{{url('pegawai-unit')}}" class="btn btn-sm btn-light-dark pull-right">CANCEL</a>
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