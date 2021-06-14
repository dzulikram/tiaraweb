@extends('layout.app')

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            
            <div class="col-md-12">
              <a href="{{url('pegawai/create')}}" class="btn btn-info pull-left"><i class="fa fa-plus"></i>  TAMBAH PEGAWAI</a></br></br>
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title ">DAFTAR PEGAWAI</h4>
                  <p class="card-category">Divisi STI Operasional Kaltimra</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-paginate" cellspacing="0" width="100%">
                      <thead class=" text-info">
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">No.</th>
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">Nama</th>
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">NIP</th>
                        <!-- <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">Username</th> -->
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">Unit Induk</th>
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">Unit</th>
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">Position</th>
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">Action</th>
                      </thead>
                      <tbody>
                        <?php
                        $no=1;
                        foreach ($pegawais as $row){
                        ?>
                        <tr>
                          <td><?php echo $no++;?></td>
                          <td><?php echo $row->name;?></td>
                          <td><?php echo $row->nip;?></td>                          
                          <td><?php echo $row->unit_induk;?></td>
                          <td><?php echo $row->unit;?></td>
                          <td><?php echo $row->position;?></td>
                          <td><a href="pegawai/edit/<?php echo $row->id;?>" class="btn btn-success btn-sm btn-round"><i class="fa fa-edit"></i></a>
                              <a href="pegawai/delete/<?php echo $row->id;?>" class="btn btn-danger btn-sm btn-round"><i class="fa fa-trash"></i></a>
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