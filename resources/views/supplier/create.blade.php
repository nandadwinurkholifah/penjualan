@extends('backend.index')
@section('title')
Create Supplier
@endsection

@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="box">
            <div class="box-header with-border">
                @include('alert.error')
            </div>
            <div class="box-body">
                <form class="form-horizontal" method="post" action="{{ route('supplier.store') }}">
                    {{ csrf_field() }}
                    <div class="box-body">
                        <div class="form-group">
                            <label for="nama_supplier" class="col-sm-2 control-label">Nama Supplier</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control" id="nama_supplier" name="nama_supplier" value="{{ old('nama_supplier') }}">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="alamat_supplier" class="col-sm-2 control-label">Alamat Supplier</label>
                            <div class="col-sm-8">
                                <textarea name="alamat_supplier" id="alamat_supplier" cols="113" rows="5">{{ old('alamat_supplier')}}</textarea>
                            </div>
                        </div>


                    </div>
                    <!-- /.box-body -->
                    <div class="box-footer">
                        <div class="pull-right">
                            <input type="submit" class="btn btn-success" name="tombol" value="Save">
                            <a href="{{route('supplier.index')}} " class="btn btn-info">Kembali</a>
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