@extends('backend.index')
@section('title')
Data Kategori
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                @if(Request::get('keyword'))
                <a href="{{ route('kategori.index') }} " class="btn btn-success"><i class="fa fa-arrow-left"></i> Back</a>
                @else

                <a href="{{ route('kategori.create')}} " class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Create</a>

                @endif
                <form action="{{ route('kategori.index') }} " method="get">
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
                    Hasil Pencarian Kategori dengan Keyword : <b>{{ Request::get('keyword')}}</b>
                </div>
                @endif

                @include('alert.success')

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Kategori </th>
                            <th>Gambar Kategori </th>
                            <th width="30%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($kategori as $data)
                        <tr>
                            <td>{{$loop->iteration + ($kategori->perpage() * ($kategori->currentPage() - 1)) }} </td>
                            <td>{{ $data->kategori}} </td>
                            
                            <td><img class="img-thumbnail" src="{{ asset('upload/'.$data->gambar_kategori)}}" width="100px"></td>
                            <td>
                                <form action="{{ route('kategori.destroy', $data->kd_kategori)}}" method="post" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini ?') ">
                                    @csrf
                                    {{method_field('DELETE')}}

                                    <a href="{{ route('kategori.edit', $data->kd_kategori)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$kategori->appends(Request::all())->links()}}
            </div>
        </div>
    </div>
</div>
@endsection