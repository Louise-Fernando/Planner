@extends('pengguna/layout')
@section('content')
    <div class="content-body">
        <div class="container-fluid mt-3">
            <div class="row">
                <div class="col-lg-12">
                    <h3 class="mb-3">{{ $title }}</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <a href="{{ url('pengguna/tugasdaftar') }}">
                                <div class="card gradient-1">
                                    <div class="card-body">
                                        <h3 class="card-title text-white">Jumlah Kegiatan</h3>
                                        <div class="d-inline-block">
                                            <h2 class="text-white">{{ $jumlahkegiatan }}</h2>
                                        </div>
                                        <span class="float-right display-5 opacity-5"><i class="icon-list"></i></span>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <script src='https://cdn.jsdelivr.net/npm/fullcalendar/index.global.min.js'></script>
                            <script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
                            <div id='calendar'></div>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    var calendarEl = document.getElementById('calendar');
                                    var calendar = new FullCalendar.Calendar(calendarEl, {
                                        initialView: 'dayGridMonth',
                                        events: [
                                            @foreach ($kegiatan as $row)
                                                {
                                                    title: '{{ $row->namakegiatan }}',
                                                    start: '{{ $row->tanggal }}',
                                                    deskripsi: '{{ $row->deskripsikegiatan }}',
                                                    url: '{{ url('pengguna/kegiatanedit/' . $row->idkegiatan) }}',
                                                    lampiran: '{{ asset('kegiatan/' . $row->file) }}',
                                                    type: 'kegiatan'
                                                },
                                            @endforeach
                                        ],
                                        eventClick: function(info) {
                                            info.jsEvent.preventDefault();
                                            $('#modalTitle').html(info.event.start.toDateString());
                                            $('#namaKegiatan').html(info.event.title);
                                            $('#deskripsiKegiatan').html(info.event.extendedProps.deskripsi);
                                            $('#lampiranKegiatan').attr('href', info.event.extendedProps.lampiran);
                                            $('#exampleModal').modal('show');
                                        },
                                        eventRender: function(info) {
                                            if (info.event.extendedProps.type === 'tugas') {
                                                info.el.style.backgroundColor =
                                                    'orange';
                                            }
                                        },
                                        eventClassNames: function(info) {
                                            if (info.event.extendedProps.type === 'tugas') {
                                                return ['tugas-event'];
                                            }
                                            return [];
                                        }
                                    });
                                    calendar.render();


                                });
                            </script>
                        </div>
                    </div>
                </div>

                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="modalTitle"></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="modalBody">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th scope="row">Nama Kegiatan:</th>
                                            <td><span id="namaKegiatan"></span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">Deskripsi Kegiatan:</th>
                                            <td><span id="deskripsiKegiatan"></span></td>
                                        </tr>
                                        <tr>
                                            <th scope="row">File Lampiran:</th>
                                            <td><a id="lampiranKegiatan" href="#" class="btn btn-success"
                                                    target="_blank">Download</a></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
