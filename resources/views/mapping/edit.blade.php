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
                  <form method="post" action="{{url('mapping/{id}')}}">
                    @csrf         
                    {{ method_field('put') }}
                    <input type="hidden" name="id" value="<?php echo $mapping->id;?>" class="form-control">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">IT Support</label>
                          <select class="form-control" name="it_support">
                            <option></option>
                            <?php foreach ($user as $row) 
                            {
                              ?>
                              <option value="<?php echo $row->username; ?>"><?php echo $row->username; ?></option>
                              <?php  
                            } 
                            ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Unit</label>
                          <select class="form-control" name="Unit">
                            <option></option>
                            <?php foreach ($unit as $row) 
                            {
                              ?>
                              <option value="<?php echo $row->personnel_subarea_name; ?>"><?php echo $row->personnel_subarea_name; ?></option>
                              <?php  
                            } 
                            ?>
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