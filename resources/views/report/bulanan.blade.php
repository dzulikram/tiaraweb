@extends('layout.app')

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
          <div class="col-md-12">              
              <div class="card">
                <div class="card-header card-header-info">
                  <p class="card-title">FILTER</p>
                </div>
                <div class="card-body">
                  @hasrole('admin')
                  <form class="form-horizontal" method="post" action="{{url('report-bulanan/filter')}}" enctype="multipart/form-data">
                  @endhasrole
                  @hasrole('dispatcher_unit')
                  <form class="form-horizontal" method="post" action="{{url('report-bulanan-unit/filter')}}" enctype="multipart/form-data">
                  @endhasrole
                    @csrf
                    <div class="table-responsive">
                      <table class="table">
                        <tbody>
                          <tr>
                            </td>
                            <td width="7%">Tahun :</td>   
                            <td width="33%"><select name="tahun" class="form-control">
                                <option></option>
                                <option value="2020" <?php if(!empty($tahun) && $tahun == "2020") echo "selected"; ?>>2020</option>
                                <option value="2021" <?php if(!empty($tahun) && $tahun == "2021") echo "selected"; ?>>2021</option>
                                <option value="2022" <?php if(!empty($tahun) && $tahun == "2022") echo "selected"; ?>>2022</option>                                
                              </select></td>
                            <td><input type="submit" value="FILTER" class="btn btn-info"></td>                        
                          </tr>                        
                        </tbody>
                      </table>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <?php if(!empty($rekap))
            {
              ?>
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title ">DAFTAR TIKET PER BULAN</h4>
                  <p class="card-category">Divisi STI Operasional Kaltimra</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-paginate" cellspacing="0" width="100%">
                      <thead class=" text-info">
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">No.</th>
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">Bulan</th>
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">Jumlah</th>
                      </thead>
                      <tbody>
                        <?php
                        $no=1;
                        foreach ($rekap as $row){
                        ?>
                        <tr>
                          <td><?php echo $no;$no++;?></td>
                          <td><?php echo $row->bulan;?></td>
                          <td><?php echo $row->jumlah;?></td>                          
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
              <?php
            }
            ?>
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