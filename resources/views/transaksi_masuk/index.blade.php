@extends('backend.index')
@section('title')
Data Transaksi Masuk
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                @if(Request::get('start_date') !== "" && Request::get('end_date') !== "")
                <a class="btn btn-success" href="{{ route('transaksi_masuk.index') }}">Back</a>
                @else
                <a class="btn btn-success" href="{{ route('transaksi_masuk.create') }}">
                    <span class="glyphicon glyphicon-plus"></span>Create</a>
                @endif
                <br><br>
                <form method="get" action="{{ route('transaksi_masuk.index')}} ">
                    <div class="form-group">
                        <label for="nama_produk" class="col-sm-2 control-label">Search By Date</label>
                        <div class="col-sm-4">
                            <input type="text" readonly name="start_date" placeholder="Start Date" class="form-control datepicker">
                        </div>

                        <div class="col-sm-4">
                            <input type="text" readonly name="end_date" placeholder="Finish Date" class="form-control datepicker">
                        </div>

                        <div class="col-sm-2">
                            <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="box-body">
                @if( Request::get('start_date') != "" && Request::get('end_date') != "")
                <div class="alert alert-success alert-block">
                    Hasil Pencarian Transaksi Masuk Dari Tanggal : {{ $start_date }} s/d {{$end_date}}
                </div>
                @endif

                @include('alert.success')

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Produk</th>
                            <th>Supplier</th>
                            <th>Tanggal Transaksi</th>
                            <th>Jumlah</th>
                            <th>Harga</th>
                            <th width="30%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($transaksi_masuk as $data)
                        <tr>
                            <td>{{$loop->iteration + ($transaksi_masuk->perpage() * ($transaksi_masuk->currentPage() - 1)) }} </td>
                            <td>{{ $data->produk->nama_produk}} </td>
                            <td>{{ $data->supplier->nama_supplier}} </td>
                            <td>{{ $data->tgl_transaksi}} </td>
                            <td>{{ $data->jumlah}} </td>
                            <td>@rupiah($data->harga) </td>
                            <td>
                                <form action="{{ route('transaksi_masuk.destroy', $data->kd_transaksi_masuk)}}" method="post" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini ?') ">
                                    @csrf
                                    {{method_field('DELETE')}}

                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$transaksi_masuk->appends(Request::all())->links()}}
            </div>
        </div>
    </div>
</div>
@endsection