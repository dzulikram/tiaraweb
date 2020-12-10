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
                  <form class="form-horizontal" method="post" action="{{url('report-kategori/filter')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="table-responsive">
                      <table class="table">
                        <tbody>
                          <tr>
                            <td width="7%">Bulan :</td>
                            <td width="33%">
                              <select name="bulan" class="form-control">
                                <option></option>
                                <option value="1" <?php if(!empty($bulan) && $bulan == "1") echo "selected"; ?>>Januari</option>
                                <option value="2" <?php if(!empty($bulan) && $bulan == "2") echo "selected"; ?>>Februari</option>
                                <option value="3" <?php if(!empty($bulan) && $bulan == "3") echo "selected"; ?>>Maret</option>
                                <option value="4" <?php if(!empty($bulan) && $bulan == "4") echo "selected"; ?>>April</option>
                                <option value="5" <?php if(!empty($bulan) && $bulan == "5") echo "selected"; ?>>Mei</option>
                                <option value="6" <?php if(!empty($bulan) && $bulan == "6") echo "selected"; ?>>Juni</option>
                                <option value="7" <?php if(!empty($bulan) && $bulan == "7") echo "selected"; ?>>Juli</option>
                                <option value="8" <?php if(!empty($bulan) && $bulan == "8") echo "selected"; ?>>Agustus</option>
                                <option value="9" <?php if(!empty($bulan) && $bulan == "9") echo "selected"; ?>>September</option>
                                <option value="10" <?php if(!empty($bulan) && $bulan == "10") echo "selected"; ?>>Oktober</option>
                                <option value="11" <?php if(!empty($bulan) && $bulan == "11") echo "selected"; ?>>November</option>
                                <option value="12" <?php if(!empty($bulan) && $bulan == "12") echo "selected"; ?>>Desember</option>
                              </select>
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
            <!-- <?php if(!empty($rekap))
            {
              ?> -->
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title ">DAFTAR TIKET PER KATEGORI</h4>
                  <p class="card-category">Divisi STI Operasional Kaltimra</p>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table table-striped table-bordered table-paginate" cellspacing="0" width="100%">
                      <thead class=" text-info">
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">No.</th>
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">Tanggal</th>
                        <th nowrap bgcolor="#1CBFD4" style="vertical-align:middle;text-align:center;color:white;">Jumlah</th>
                      </thead>
                      <tbody>
                        <?php
                        $no=1;
                        foreach ($rekap as $row){
                        ?>
                        <tr>
                          <td><?php echo $no;$no++;?></td>
                          <td><?php echo $row->kategori;?></td>
                          <td><?php echo $row->jumlah;?></td>                          
                        </tr>
                        <?php } ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
              <!-- <?php
            }
            ?> -->
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