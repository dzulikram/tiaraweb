@extends('layout.app')

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">              
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title ">UBAH PASSWORD</h4>
                  <p class="card-category">Divisi STI Operasional Kaltimra<br>
                    @if(Session::has('error_message'))
                     {{ Session::get('error_message') }}
                    @endif</p>
                </div>
                  
                <div class="card-body">
                  <form method="post" action="{{url('user/password/')}}">
                    @csrf         
                    <input type="hidden" name="id" value="<?php echo $user->id;?>" class="form-control">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Password</label>
                          <input type="password" name="new_password" class="form-control">
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Confirm Password</label>
                          <input type="password" name="confirm_new_password" class="form-control">
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-info pull-right">UPDATE PASSWORD</button>
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