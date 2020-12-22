@extends('layout.app')

@section('title', 'ChatKategori')

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">              
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title ">EDIT CHAT KATEGORI</h4>
                  <p class="card-category">Divisi STI Operasional Kaltimra</p>
                </div>
                <div class="card-body">
                  <form method="post" action="{{url('chatkategori/{id}')}}">
                    @csrf         
                    {{ method_field('put') }}
                    <input type="hidden" name="id" value="<?php echo $chatkategori->id;?>" class="form-control">
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">CHAT Kategori</label>
                          <input type="text" name="chatkategori" value="<?php echo $chatkategori->chatkategori;?>" class="form-control">
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-info pull-right">UPDATE CHAT KATEGORI IT</button>
                    <div class="clearfix"></div>
                  </form>
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