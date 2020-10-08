@extends('backend.index')
@section('title')
Edit Pegawai
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                @include('alert.error')
            </div>
            <div class="box-body">
                <form class="form-horizontal" method="post" action="{{ route('pegawai.update',$pegawai->username) }}">
                    @csrf
                    {{ method_field('PUT')}}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="username" class="col-sm-2 control-label">Username</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" disabled id="username" name="username" value="{{ $pegawai->username }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password" class="col-sm-2 control-label">Password</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control" id="password" name="password" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="nama_pegawai" class="col-sm-2 control-label">Nama Pegawai</label>
                            <div class="col-sm-8">
                                <input type="nama_pegawai" class="form-control" id="nama_pegawai" name="nama_pegawai" value="{{ $pegawai->nama_pegawai}} ">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="jk" class="col-sm-2 control-label">Jenis Kelamin</label>
                            <div class="col-sm-8">
                                <select name="jk" id="jk" class="form-control">
                                    <option value="PRIA" @if($pegawai->jk == "PRIA")
                                        selected
                                        @endif
                                        >
                                        PRIA
                                    </option>
                                    <option value="WANITA" @if($pegawai->jk == "WANITA")
                                        selected
                                        @endif 
                                        >
                                        WANITA</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat" class="col-sm-2 control-label">Alamat </label>
                            <div class="col-sm-8">
                                <textarea name="alamat" id="alamat" cols="113" rows="5">{{$pegawai->alamat}}</textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="is_aktif" class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-8">
                                <select name="is_aktif" id="is_aktif" class="form-control">
                                    <option value="1" @if($pegawai->is_aktif == 1)
                                        selected
                                        @endif
                                        >
                                        Aktif
                                    </option>
                                    <option value="0" @if($pegawai->is_aktif == 0)
                                        selected
                                        @endif
                                        >
                                        Tidak Aktif
                                    </option>
                                </select>
                            </div>
                        </div>

                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="pull-right">
                            <input type="submit" class="btn btn-success" name="tombol" value="Update">
                            <a href="{{route('pegawai.index')}} " class="btn btn-info">Kembali</a>
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