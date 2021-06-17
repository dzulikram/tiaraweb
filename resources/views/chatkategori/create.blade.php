@extends('layout.app')

@section('title', 'ChatKategori')

@section('content')
<div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12">              
              <div class="card">
                <div class="card-header card-header-info">
                  <h4 class="card-title ">INPUT CHAT KATEGORI</h4>
                  <p class="card-category">Divisi STI</p>
                </div>
                <div class="card-body">
                  <form method="post" action="{{url('chatkategori')}}">
                    @csrf
                    <div class="row">
                      <div class="col-md-12">
                        <div class="form-group label-floating has-info">
                          <label class="bmd-label-floating">Chat Kategori</label>
                          <input type="text" name="chatkategori" class="form-control">
                        </div>
                      </div>
                    </div>
                    <button type="submit" class="btn btn-info pull-right">INPUT CHAT KATEGORI</button>
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