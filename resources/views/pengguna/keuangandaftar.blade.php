@extends('pengguna/layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-3">{{ $title }}</h3>
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ url('pengguna/keuanganfilter') }}" method="GET">
                                <div class="row mb-3">
                                    <div class="col-md-3">
                                        <label for="tanggal_awal" class="form-label">Tanggal Awal</label>
                                        <input type="date" class="form-control" id="tanggal_awal" name="tanggal_awal"
                                            value="{{ old('tanggal_awal') }}" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label for="tanggal_akhir" class="form-label">Tanggal Akhir</label>
                                        <input type="date" class="form-control" id="tanggal_akhir" name="tanggal_akhir"
                                            value="{{ old('tanggal_akhir') }}" required>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label">&nbsp;</label><br>
                                        <button type="submit" class="btn btn-primary">Filter</button>
                                        <a href="{{ url('pengguna/keuangandaftar') }}" class="btn btn-primary">Lihat
                                            Semua</a>
                                    </div>
                                </div>
                            </form>
                            <a class="btn btn-primary mb-3" href="{{ url('pengguna/keuangantambah') }}">Tambah Data</a>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table">
                                    <!-- Table Header -->
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama</th>
                                            <th>Judul</th>
                                            <th>Keterangan</th>
                                            <th>Tanggal</th>
                                            <th>Pemasukan</th>
                                            <th>Pengeluaran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <!-- Table Body -->
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        $totalPemasukan = 0;
                                        $totalPengeluaran = 0;
                                        ?>
                                        @foreach ($keuangan as $row)
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ $row->namapengguna }}</td>
                                                <td>{{ $row->judul }}</td>
                                                <td>{{ $row->keterangan }}</td>
                                                <td>{{ tanggal($row->tanggal) }}</td>
                                                <td class="text-center">
                                                    @if ($row->tipe == 'Pemasukan')
                                                        Rp. {{ number_format($row->jumlah, 0, ',', '.') }}
                                                        <?php $totalPemasukan += $row->jumlah; ?>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td class="text-center">
                                                    @if ($row->tipe == 'Pengeluaran')
                                                        Rp. {{ number_format($row->jumlah, 0, ',', '.') }}
                                                        <?php $totalPengeluaran += $row->jumlah; ?>
                                                    @else
                                                        -
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary m-1"
                                                        href="{{ url('pengguna/keuanganedit/' . $row->idkeuangan) }}">Edit</a>
                                                    <a class="btn btn-danger bdel m-1"
                                                        href="{{ url('pengguna/keuanganhapus/' . $row->idkeuangan) }}">Hapus</a>
                                                </td>
                                            </tr>
                                            <?php $no++; ?>
                                        @endforeach
                                    </tbody>
                                    <!-- Table Footer -->
                                    <tfoot>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td><strong>Rp. {{ number_format($totalPemasukan, 0, ',', '.') }}</strong></td>
                                            <td><strong>Rp. {{ number_format($totalPengeluaran, 0, ',', '.') }}</strong>
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="text-right">Sisa Saldo:</td>
                                            <td colspan="2">
                                                <strong>Rp.
                                                    {{ number_format($totalPemasukan - $totalPengeluaran, 0, ',', '.') }}</strong>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
