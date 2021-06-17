@extends('layout_guest.app')

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title ">DAFTAR POJOK IT</h4>
                  <p class="card-category">Divisi STI</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-paginate" cellspacing="0" width="100%">
                      <thead class=" text-info">
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">No.</th>
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">Judul</th>
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">Konten</th>
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