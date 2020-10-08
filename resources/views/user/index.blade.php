@extends('backend.index')
@section('title')
Data User
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                @if(Request::get('keyword'))
                <a href="{{ route('user.index') }} " class="btn btn-success"><i class="fa fa-arrow-left"></i> Back</a>
                @else

                <a href="{{ route('user.create')}} " class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Create</a>

                @endif
                <form action="{{ route('user.index') }} " method="get">
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
                    Hasil Pencarian User dengan Keyword : <b>{{ Request::get('keyword')}}</b>
                </div>
                @endif

                @include('alert.success')

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th width="5%">#</th>
                            <th>Nama</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th>Level</th>
                            <th width="30%">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($user as $data)
                        <tr>
                            <td>{{$loop->iteration + ($user->perpage() * ($user->currentPage() - 1)) }} </td>
                            <td>{{ $data->name}} </td>
                            <td>{{ $data->username}} </td>
                            <td>{{ $data->email}} </td>
                            <td>{{ $data->level}} </td>
                            <td>
                                <form action="{{ route('user.destroy', $data->id)}}" method="post" onsubmit="return confirm('Apakah anda yakin akan menghapus data ini ?') ">
                                    @csrf
                                    {{method_field('DELETE')}}

                                    <a href="{{ route('user.show', $data->id)}}" class="btn btn-primary"><i class="fa fa-list"></i></a>
                                    <a href="{{ route('user.edit', $data->id)}}" class="btn btn-warning"><i class="fa fa-edit"></i></a>
                                    <button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {{$user->appends(Request::all())->links()}}
            </div>
        </div>
    </div>
</div>
@endsection