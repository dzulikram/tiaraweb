@extends('layout.app')

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">              
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title ">EDIT USER</h4>
                  <p class="card-category">Divisi STI Operasional Kaltimra</p>
                </div>
                <div class="card-body">
                  <form method="post" action="{{url('user/{id}')}}">
                    @csrf         
                    {{ method_field('put') }}
                    <input type="hidden" name="id" value="<?php echo $user->id;?>" class="form-control">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Nama</label>
                          <input type="text" name="name" value="<?php echo $user->name;?>" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Email</label>
                          <input type="text" name="email" value="<?php echo $user->email;?>" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Username</label>
                          <input type="text" name="username" value="<?php echo $user->username;?>" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">No WA</label>
                          <input type="number" name="no_wa" value="<?php echo $user->no_wa;?>" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Role</label>
                          <select class="form-control" name="role" required>
                            <option></option>
                            <?php foreach ($roles as $row) {
                              ?>
                              <option value="<?php echo $row->name; ?>"> <?php echo $row->name;?></option>
                              <?php
                            } ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-info pull-right">UPDATE USER</button>
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