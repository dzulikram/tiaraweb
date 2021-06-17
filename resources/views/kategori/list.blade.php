@extends('layout.app')

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <!-- <a href="{{url('kategori/create')}}" class="btn btn-info pull-left"><i class="fa fa-plus"></i> TAMBAH KATEGORI</a></br></br> -->
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title ">DAFTAR KATEGORI</h4>
                  <p class="card-category">Divisi STI</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-paginate" cellspacing="0" width="100%">
                      <thead class=" text-info">
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">No.</th>
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">Kategori</th>
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">Type</th>
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">Action</th>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach ($kategoris as $row) 
                        {
                          if(!empty($row->type))
                          {
                          ?>
                          <tr>
                            <td><?php echo $no; $no++; ?></td>
                            <td><?php echo $row->name; ?></td>
                            <td><?php echo $row->type; ?></td>
                            <td><a href="kategori/edit/<?php echo $row->id;?>" class="btn btn-success btn-sm btn-round"><i class="fa fa-edit"></i></a>
                              <a href="kategori/delete/<?php echo $row->id;?>" class="btn btn-danger btn-sm btn-round"><i class="fa fa-trash"></i></a>
                          </tr>
                          <?php
                          }
                        }
                        ?>
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