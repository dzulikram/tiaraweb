@extends('layout.app')

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            
            <div class="col-md-12">
              <a href="{{url('user/create')}}" class="btn btn-info pull-left"><i class="fa fa-plus"></i> TAMBAH USER</a></br></br>
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title ">DAFTAR USER</h4>
                  <p class="card-category">Divisi STI Operasional Kaltimra</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-info">
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Email</th>
                        <th>Username</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php
                        $no=1;
                        foreach ($users as $row){
                        ?>
                        <tr>
                          <td><?php echo $no++;?></td>
                          <td><?php echo $row->name;?></td>
                          <td><?php echo $row->email;?></td>
                          <td><?php echo $row->username;?></td>
                          <td><a href="{{url('/user/edit')}}/<?php echo $row->id;?>" class="btn btn-success btn-sm" ><i class="fa fa-edit"></i></a>
                              <a href="{{url('/user/delete')}}/<?php echo $row->id;?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
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