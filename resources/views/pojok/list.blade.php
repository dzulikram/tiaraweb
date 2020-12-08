@extends('layout.app')

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <a href="{{url('pojok/create')}}" class="btn btn-info pull-left"><i class="fa fa-plus"></i> TAMBAH POJOK IT</a></br></br>
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title ">DAFTAR POJOK IT</h4>
                  <p class="card-category">Divisi STI Operasional Kaltimra</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-info">
                        <th>No.</th>
                        <th>Judul</th>
                        <th>Konten</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php
                        $no=1;
                        foreach ($pojoks as $row){
                        ?>
                        <tr>
                          <td><?php echo $no++;?></td>
                          <td><?php echo $row->judul;?></td>
                          <td><a href="<?php echo $row->konten;?>" target="_blank"><?php echo $row->konten;?></a></td>
                          <td><a href="pojok/edit/<?php echo $row->id;?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                              <a href="pojok/delete/<?php echo $row->id;?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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