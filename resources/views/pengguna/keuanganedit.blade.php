@extends('pengguna/layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-3">{{ $title }}</h3>
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{ url('pengguna/keuanganeditsimpan/' . $row->idkeuangan) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Nama</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input type="text" class="form-control"
                                            value="{{ session('pengguna')->namapengguna }}" name="nama" readonly
                                            required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Judul</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input type="text" class="form-control" name="judul"
                                            value="{{ $row->judul }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Keterangan</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input type="text" class="form-control" name="keterangan"
                                            value="{{ $row->keterangan }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Tanggal</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input type="date" class="form-control" name="tanggal"
                                            value="{{ $row->tanggal }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Jumlah</label>
                                    <div class="col-sm-12 col-md-10">
                                        <input type="number" class="form-control" name="jumlah"
                                            value="{{ $row->jumlah }}" required>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-12 col-md-2 col-form-label">Tipe</label>
                                    <div class="col-sm-12 col-md-10">
                                        <select class="form-control" name="tipe" required>
                                            <option value="" disabled selected>Pilih Tipe</option>
                                            <option value="Pemasukan" {{ $row->tipe == 'Pemasukan' ? 'selected' : '' }}>
                                                Pemasukan</option>
                                            <option value="Pengeluaran" {{ $row->tipe == 'Pengeluaran' ? 'selected' : '' }}>
                                                Pengeluaran</option>
                                        </select>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-success pull-right" name="simpan">Simpan</button>
                                <br><br>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
