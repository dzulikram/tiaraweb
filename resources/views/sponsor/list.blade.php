@extends('layout.app')

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title ">AWARENESS</h4>
                  <p class="card-category">Divisi STI Operasional Kaltimra</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-paginate" cellspacing="0" width="100%">
                      <thead class=" text-info">
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;" width="95%">Awareness</th>
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;" width="5%">Edit</th>                        
                      </thead>
                      <tbody>
                        <?php
                        foreach ($sponsor as $row) 
                        {
                          ?>
                          <tr>
                            <td><?php echo $row->sponsor; ?></td>
                            <td style="text-align:center;"><a href="{{url('/sponsor/edit')}}/<?php echo $row->id;?>" class="btn btn-success btn-sm btn-round" ><i class="fa fa-edit"></i></a></td>
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