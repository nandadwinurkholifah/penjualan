@extends('backend.index')
@section('title')
Edit Kategori
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                @include('alert.error')
            </div>
            <div class="box-body">
                <form class="form-horizontal" method="post" action="{{ route('kategori.update',$kategori->kd_kategori) }}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="kategori" class="col-sm-2 control-label">Nama Kategori</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="kategori" name="kategori" value="{{ $kategori->kategori }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gambar_kategori" class="col-sm-2 control-label"></label>
                            <div class="col-sm-8">
                                <img class="img-thumbnail" src="{{ asset('upload/'.$kategori->gambar_kategori)}}" width="100px">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gambar_kategori" class="col-sm-2 control-label">Gambar Kategori </label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" id="gambar_kategori" name="gambar_kategori" value="{{ $kategori->gambar_kategori }}">
                            </div>
                        </div>


                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="pull-right">
                            <input type="submit" class="btn btn-success" name="tombol" value="Update">
                            <a href="{{route('kategori.index')}} " class="btn btn-info">Kembali</a>
                            <button type="reset" class="btn btn-danger">Batal</button>

                        </div>
                    </div>
                    <!-- /.box-footer -->
                </form>
            </div>
        </div>
    </div>
</div>
@endsection