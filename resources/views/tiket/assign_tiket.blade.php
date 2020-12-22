@extends('layout.app')

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">              
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title ">ASSIGN TIKET</h4>
                  <p class="card-category">Divisi STI Operasional Kaltimra</p>
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
                          <label class="bmd-label-floating">Unit</label>
                          <input type="text" name="name" class="form-control" value="<?php echo $tiket->pegawai->personnel_area_name; ?>" disabled>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Sub Unit</label>
                          <input type="text" name="name" class="form-control" value="<?php echo $tiket->pegawai->personnel_subarea_name; ?>" disabled>
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
                              <option value="<?php echo $row->id; ?>"><?php echo $row->kategori; ?></option>
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
                          <select class="form-control" name="it_support" required>
                            <option></option>
                            <?php foreach ($users as $row) {
                              ?>
                              <option value="<?php echo $row->id; ?>"><?php echo $row->name; ?></option>
                              <?php
                            } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-info pull-right">ASSIGN IT SUPPORT</button>
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