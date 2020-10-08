@extends('backend.index')
@section('title')
Data Pegawai
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                @if(Request::get('keyword'))
                <a href="{{ route('pegawai.index') }} " class="btn btn-success"><i class="fa fa-arrow-left"></i> Back</a>
                @else

                <a href="{{ route('pegawai.create')}} " class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Create</a>

                @endif
                <form action="{{ route('pegawai.index') }} " method="get">
                    <div class="form-group">
                        <label for="" class="col-sm-2 control-label">Search By Name</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="keyword" name="keyword" value="{{Request::get('keyword')}} ">
                        </div>
                        <div class="col-sm-6">
                            <button type="submit" class="btn btn-info"><span class="glyphicon glyphicon-search"></span></button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="box-body">
                @if(Request::get('keyword'))
                <div class="alert alert-success alert-block">
                    Hasil Pencarian pegawai dengan Keyword : <b>{{ Request::get('keyword')}}</b>
                </div>
                @endif

                @include('alert.success')

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Username</th>
                            <th>Nama Pegawai</th>
                            <th>Jenis Kelamin</th>
                            <th>Alamat</th>
                            <th>Status</th>
                            <th width="30%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pegawai as $peg)
                        <tr>
                            <td>{{ $loop->iteration + ($pegawai->perPage() * ($pegawai->currentPage() - 1) )}} </td>
                            <td>{{$peg->username}} </td>
                            <td>{{$peg->nama_pegawai}} </td>
                            <td>{{$peg->jk}} </td>
                            <td>{{$peg->alamat}} </td>
                            <td>
                                @if($peg->is_aktif == 1) Aktif
                                @else
                                Tidak Aktif
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('pegawai.destroy', $peg->username)}}" method="post" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini ?') ">
                                    @csrf
                                    {{method_field('DELETE')}}
                                    <a href="{{ route('pegawai.edit', $peg->username)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>

                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$pegawai->appends(Request::all())->links()}}
            </div>
        </div>
    </div>
</div>
@endsection