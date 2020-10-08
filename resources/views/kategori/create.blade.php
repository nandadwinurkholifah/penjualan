@extends('backend.index')
@section('title')
Create kategori
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                @include('alert.error')
            </div>
            <div class="box-body">
                <form class="form-horizontal" method="post" action="{{ route('kategori.store') }}" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="kategori" class="col-sm-2 control-label">Nama Kategori</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="kategori" name="kategori" value="{{ old('kategori') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gambar_kategori" class="col-sm-2 control-label">Gambar Kategori </label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" id="gambar_kategori" name="gambar_kategori" value="{{ old('gambar_kategori') }}">
                            </div>
                        </div>


                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="pull-right">
                            <input type="submit" class="btn btn-success" name="tombol" value="Save">
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