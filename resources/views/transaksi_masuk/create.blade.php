@extends('backend.index')
@section('title')
Create Data Transaki Masuk
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                @include('alert.error')
            </div>
            <div class="box-body">
                <form class="form-horizontal" method="post" action="{{ route('transaksi_masuk.store') }}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="kd_produk" class="col-sm-2 control-label">Produk</label>
                            <div class="col-sm-8">
                                <select name="kd_produk" id="kd_produk" class="form-control">
                                    @foreach($produk as $data)
                                    <option value="{{ $data->kd_produk}}">{{$data->nama_produk}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="kd_supplier" class="col-sm-2 control-label">Supplier</label>
                            <div class="col-sm-8">
                                <select name="kd_supplier" id="kd_supplier" class="form-control">
                                    @foreach($supplier as $data)
                                    <option value="{{ $data->kd_supplier}}">{{$data->nama_supplier}} </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="tgl_transaksi" class="col-sm-2 control-label">Tanggal Transaksi</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control datepicker" name="tgl_transaksi" id="tgl_transaksi" value="{{ old('tgl_transaksi')}} " readonly>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="jumlah" class="col-sm-2 control-label">Jumlah</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="jumlah" id="jumlah" value="{{ old('jumlah')}} " >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="harga" class="col-sm-2 control-label">Harga</label>
                            <div class="col-sm-8">
                                <input type="number" class="form-control" name="harga" id="harga" value="{{ old('harga')}} " >
                            </div>
                        </div>
                    </div>
                    <!-- /.box-body -->

                    <div class="box-footer">
                        <div class="pull-right">
                            <input type="submit" class="btn btn-success" name="tombol" value="Save">
                            <a href="{{route('transaksi_masuk.index')}} " class="btn btn-info">Kembali</a>
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