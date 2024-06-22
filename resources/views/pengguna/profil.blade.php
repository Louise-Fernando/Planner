@extends('pengguna/layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-3">{{ $title }}</h3>
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td>Nama</td>
                                            <td>: <?= $row->namapengguna ?></td>
                                        </tr>
                                        <tr>
                                            <td>Email</td>
                                            <td>: <?= $row->email ?></td>
                                        </tr>
                                        <tr>
                                            <td>Password</td>
                                            <td>: <?= $row->password ?></td>
                                        </tr>
                                        <tr>
                                            <td>No. Telp</td>
                                            <td>: <?= $row->notelp ?></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <a href="{{ url('pengguna/profiledit') }}" class="btn btn-warning pull-right" name="simpan"><i
                                    class="fa fa-edit"></i>
                                Edit Profil</a>
                            <br><br>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
