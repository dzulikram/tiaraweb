@extends('layout_guest.appfeed')

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col">
            <img src="{{asset('assets/img/logo2.png')}}" alt="Image" style="width:190px;height:74px;">
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title ">Feedback</h4>
                  <p class="card-category">Divisi STI</p>
                </div>

                <div class="card-body">
                  <div class="table-responsive">
                    <form method="post" action="{{url('feedback/{id}')}}">
                    @csrf
                    {{ method_field('put') }}
                    <input type="hidden" name="id" value="<?php echo $tikets->id;?>" class="form-control">
                    <table class="table color-bordered-table info-bordered-table" cellspacing="0" width="100%">
                      <tr>
                          <thead>
                          <th nowrap bgcolor="#C7F2F7" style="vertical-align:middle;text-align:left;color:black;font-size:14px;">No Tiket</th>
                          <td><?php echo $tikets->no_tiket; ?></td>
                          </thead>                               
                      </tr>
                      <tr>
                          <thead>
                          <th nowrap bgcolor="#C7F2F7" style="vertical-align:middle;text-align:left;color:black;font-size:14px;">Nama</th>
                          <td><?php echo $tikets->pegawai->name; ?></td>
                          </thead>                               
                      </tr>
                      <tr>
                          <thead>
                          <th nowrap bgcolor="#C7F2F7" style="vertical-align:middle;text-align:left;color:black;font-size:14px;">Permasalahan</th>
                          <td><?php echo $tikets->permasalahan; ?></td>
                          </thead>                               
                      </tr>
                      <tr>
                          <thead>
                          <th nowrap bgcolor="#C7F2F7" style="vertical-align:middle;text-align:left;color:black;font-size:14px;">IT Support</th>
                          <td><?php 
                          if (empty($tikets->its->name)){echo "";}else{echo $tikets->its->name;} ?></td>
                          </thead>                               
                      </tr>  
                      <tr>
                          <thead>
                          <th nowrap bgcolor="#C7F2F7" style="vertical-align:top;text-align:left;color:black;font-size:14px;">Feedback</th>
                          <td><div class="form-group label-floating has-info"><textarea class="form-control" name="feedback" placeholder="Masukkan Feedback anda disini..."></textarea></div></td>
                          </thead>                               
                      </tr>                           
                    </table>
                    <button type="submit" class="btn btn-info pull-right">INPUT FEEDBACK</button>
                    <div class="clearfix"></div>
                    <form>
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