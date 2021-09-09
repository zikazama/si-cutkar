@extends('template')

@section('title','- Form Karyawan')

@section('konten')
<div class="container-fluid">
    <div class="row bg-title">
        <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
            <h4 class="page-title">Form</h4>
        </div>
        <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

        </div>
        <!-- /.col-lg-12 -->
    </div>

    @if (Request::segment(3) == 'create')
    <!-- .row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">Form Karyawan</h3>
                <hr>
                <form class="form" action="/{{ Session('user')['role'] }}/manage-karyawan" method="post">
                    @csrf
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">Nama Karyawan</label>
                        <div class="col-10">
                            <input class="form-control" name="nama_karyawan" type="text" value="" id="example-text-input" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-search-input" class="col-2 col-form-label">Email</label>
                        <div class="col-10">
                            <input class="form-control" name="email" type="email" value="" id="example-search-input" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-email-input" class="col-2 col-form-label">Password</label>
                        <div class="col-10">
                            <input class="form-control" name="password" type="password" value="" id="example-email-input" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-email-input" class="col-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-10">
                            <input class="form-control" name="tanggal_lahir" type="date" value="" id="example-email-input" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-email-input" class="col-2 col-form-label">Posisi</label>
                        <div class="col-10">
                            <input class="form-control" name="posisi" type="text" value="" id="example-email-input" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">

                            <button class="btn btn-primary btn-block" type="submit">Buat</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->
    @else
    <!-- .row -->
    <div class="row">
        <div class="col-sm-12">
            <div class="white-box">
                <h3 class="box-title m-b-0">Form Karyawan</h3>
                <hr>
                <form class="form" action="/{{ Session('user')['role'] }}/manage-karyawan/{{Request::segment(3)}}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="example-text-input" class="col-2 col-form-label">Nama Karyawan</label>
                        <div class="col-10">
                            <input class="form-control" name="nama_karyawan" type="text" value="{{$karyawan->nama_karyawan}}" id="example-text-input" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-search-input" class="col-2 col-form-label">Email</label>
                        <div class="col-10">
                            <input class="form-control" name="email" type="email" value="{{$karyawan->email}}" id="example-search-input" required>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <label for="example-email-input" class="col-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-10">
                            <input class="form-control" name="tanggal_lahir" type="date" value="{{$karyawan->tanggal_lahir}}" id="example-email-input" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="example-email-input" class="col-2 col-form-label">Posisi</label>
                        <div class="col-10">
                            <input class="form-control" name="posisi" type="text" value="{{$karyawan->posisi}}" id="example-email-input" required>
                        </div>
                    </div>
                    
                    <div class="form-group row">
                        <div class="col-md-12">

                            <button class="btn btn-primary btn-block" type="submit">Update</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /.row -->
    @endif

</div>
@endsection