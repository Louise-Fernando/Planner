@extends('pengguna/layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-12">
                    <h3 class="mb-3">{{ $title }}</h3>
                    <div class="card">
                        <div class="card-body">
                            <a class="btn btn-primary mb-3" href="{{ url('pengguna/kegiatantambah') }}">Tambah Data</a>
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="table">
                                    <thead>
                                        <tr>
                                            <th>No.</th>
                                            <th>Nama Kegiatan</th>
                                            <th>Deskripsi Kegiatan</th>
                                            <th>Tanggal Kegiatan</th>
                                            <th>Lampiran</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $no = 1;
                                        ?>
                                        @foreach ($kegiatan as $row)
                                            <tr>
                                                <td>{{ $no }}</td>
                                                <td>{{ $row->namakegiatan }}</td>
                                                <td>{{ $row->deskripsikegiatan }}</td>
                                                <td>{{ tanggal($row->tanggal) }}</td>
                                                <td>
                                                    @if ($row->file != '')
                                                        :
                                                        <a href="{{ asset('kegiatan/' . $row->file) }}" target="_blank"
                                                            class="btn btn-success">Download</a>
                                                    @else
                                                        Tidak Ada
                                                    @endif
                                                </td>
                                                <td>
                                                    <a class="btn btn-primary m-1"
                                                        href="{{ url('pengguna/kegiatanedit/' . $row->idkegiatan) }}">Edit</a>
                                                    <a class="btn btn-danger bdel m-1"
                                                        href="{{ url('pengguna/kegiatanhapus/' . $row->idkegiatan) }}">Hapus</a>
                                                </td>
                                            </tr>
                                            <?php
                                            $no++;
                                            ?>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
