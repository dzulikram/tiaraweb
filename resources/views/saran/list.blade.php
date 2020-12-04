@extends('layout.app')

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title ">DAFTAR SARAN & KRITIK</h4>
                  <p class="card-category">Divisi STI Operasional Kaltimra</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead class=" text-info">
                        <th>No.</th>
                        <th>Nama</th>
                        <th>Saran</th>
                        <th>Action</th>
                      </thead>
                      <tbody>
                        <?php
                        $no = 1;
                        foreach ($sarans as $row) 
                        {
                          ?>
                          <tr>
                            <td><?php echo $no; $no++; ?></td>
                            <td><?php echo $row->name; ?></td>
                            <td><?php echo $row->saran; ?></td>
                            <td></td>
                          </tr>
                          <?php
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