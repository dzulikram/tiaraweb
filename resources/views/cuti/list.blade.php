@extends('layout.app')

@section('title', 'Cuti')

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            
            <div class="col-md-12">
              <a href="{{url('cuti/create')}}" class="btn btn-info pull-left"><i class="fa fa-plus"></i> TAMBAH Cuti</a></br></br>
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title ">DAFTAR CUTI</h4>
                  <p class="card-category">Divisi STI Operasional Kaltimra</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-paginate" cellspacing="0" width="100%">
                      <thead class=" text-info">
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">No.</th>
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">IT Support</th>
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">Mulai</th>
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">Selesai</th>
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">Perihal</th>
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">Action</th>
                      </thead>
                      <tbody>
                        <?php
                        $no=1;
                        foreach ($cutis as $row){
                        ?>
                        <tr>
                          <td><?php echo $no++;?></td>
                          <td><?php echo $row->it_support;?></td>
                          <td><?php echo $row->mulai;?></td>
                          <td><?php echo $row->selesai;?></td>
                          <td><?php echo $row->perihal;?></td>
                          <td><a href="cuti/edit/<?php echo $row->id;?>" class="btn btn-success btn-sm"><i class="fa fa-edit"></i></a>
                              <a href="cuti/delete/<?php echo $row->id;?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
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