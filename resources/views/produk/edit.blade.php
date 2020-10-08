@extends('backend.index')
@section('title')
Edit Data Produk
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                @include('alert.error')
            </div>
            <div class="box-body">
                <form class="form-horizontal" method="post" action="{{ route('produk.update',[$produk->kd_produk]) }}" enctype="multipart/form-data">
                    @csrf
                    {{ method_field('PUT') }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nama_produk" class="col-sm-2 control-label">Nama Produk</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_produk" name="nama_produk" value="{{ $produk->nama_produk }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kd_kategori" class="col-sm-2 control-label">Kategori Produk</label>
                            <div class="col-sm-8">
                                <select name="kd_kategori" id="kd_kategori" class="form-control">
                                    @foreach($kategori as $data)
                                    <option value="{{$data->kd_kategori}}" @if($produk->kd_kategori == $data->kd_kategori) Selected @endif>{{$data->kategori}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="harga" class="col-sm-2 control-label">Harga</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" id="harga" name="harga" value="{{ $produk->harga }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gambar_produk" class="col-sm-2 control-label"> </label>
                            <div class="col-sm-8">
                                <img class="img-thumbnail" width="100px" src="{{ asset('upload/'.$produk->gambar_produk) }} " alt="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="gambar_produk" class="col-sm-2 control-label">Gambar Kategori </label>
                            <div class="col-sm-8">
                                <input type="file" class="form-control" id="gambar_produk" name="gambar_produk" value="{{ $produk->gambar_produk }}">
                            </div>
                        </div>


                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="pull-right">
                            <input type="submit" class="btn btn-success" name="tombol" value="Update">
                            <a href="{{route('produk.index')}} " class="btn btn-info">Kembali</a>
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