@extends('layouts.presensi')

@section('header')
    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="/dashboard" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class='pageTitle'>Data Izin / Sakit</div>
        <div class="right"></div>
    </div>
@endsection

@section('content')
    <div class="row" style="margin-top: 70px">
        <div class="col">
            @php
                $messagesuccess = Session::get('success');
                $messageerror = Session::get('error');
                $namabulan = [
                    1 => 'Januari',
                    2 => 'Februari',
                    3 => 'Maret',
                    4 => 'April',
                    5 => 'Mei',
                    6 => 'Juni',
                    7 => 'Juli',
                    8 => 'Agustus',
                    9 => 'September',
                    10 => 'Oktober',
                    11 => 'November',
                    12 => 'Desember',
                ];
            @endphp
            @if (Session::get('success'))
                <div class="alert alert-success">
                    {{ $messagesuccess }}
                </div>
            @endif
            @if (Session::get('error'))
                <div class="alert alert-danger">
                    {{ $messageerror }}
                </div>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col">
            <form action="/presensi/izin" method="GET">
                <div class="row">
                    <div class="col-8">

                        <div class="form-group">
                            <select name="bulan" id="bulan" class="form-control selectmaterialize">
                                <option value="">Bulan</option>
                                @for ($i = 1; $i <= 12; $i++)
                                    <option value="{{ $i }}" {{ date('m') == $i ? 'selected' : '' }}>
                                        {{ $namabulan[$i] }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                    <div class="col-4">

                        <div class="form-group">
                            <select name="tahun" id="tahun" class="form-control selectmaterialize">
                                <option value="">Tahun</option>
                                @php
                                    $tahunmulai = 2022;
                                    $tahunskrg = date('Y');
                                @endphp
                                @for ($tahun = $tahunmulai; $tahun <= $tahunskrg; $tahun++)
                                    <option value="{{ $tahun }}" {{ date('Y') == $tahun ? 'selected' : '' }}>
                                        {{ $tahun }}</option>
                                @endfor
                            </select>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <button class="btn btn-primary w-100">Cari Data</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row" style="margin-bottom: 70px; position:fixed; overflow-y:scroll; height: 500px; margin:auto ">
        <div class="col" style="margin-bottom: 80px">
            <style>
                .historicontent {
                    display: flex;
                    gap: 1px;
                    margin-top: 20px;

                }

                .datapresensi {
                    margin-left: 10px;
                }

                .card {
                    border: 1px solid rgb(59, 59, 65)
                }
            </style>
            @if ($dataizin->isEmpty())
                <div class="alert alert-outline-danger mt-2" style="width: 100%">
                    <p>Belum Ada Data Izin!</p>
                </div>
            @else
                @foreach ($dataizin as $d)
                    @php
                        $tanggal = date('d', strtotime($d->tgl_izin_dari));
                        $bulan = date('n', strtotime($d->tgl_izin_dari));
                        $tahun = date('Y', strtotime($d->tgl_izin_dari));
                        $namaBulan = $namabulan[$bulan];
                        $tanggalsampai = date('d', strtotime($d->tgl_izin_sampai));
                        $bulansampai = date('n', strtotime($d->tgl_izin_sampai));
                        $tahunsampai = date('Y', strtotime($d->tgl_izin_sampai));
                        $namaBulansampai = $namabulan[$bulansampai];

                        if ($d->status_izin == 'i') {
                            $status = 'Izin';
                        } elseif ($d->status_izin == 's') {
                            $status = 'Sakit';
                        } elseif ($d->status_izin == 'c') {
                            $status = 'Cuti';
                        } else {
                            $status = 'Not Found';
                        }
                    @endphp

                    <div class="card card_izin" izin_id="{{ $d->izin_id }}" status_approved="{{ $d->status_approved }}"
                        style="margin-top: 12px; margin-" data-toggle="modal" data-target="#actionSheetIconed">
                        <div class="card-body " style="padding: 10px 10px; ">
                            <div class="historicontent" style="display: flex;  justify-content: space-between;">
                                <div class="iconpresensi">
                                    @if ($d->status_izin == 'i')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-file-description">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M14 3v4a1 1 0 0 0 1 1h4" />
                                            <path
                                                d="M17 21h-10a2 2 0 0 1 -2 -2v-14a2 2 0 0 1 2 -2h7l5 5v11a2 2 0 0 1 -2 2z" />
                                            <path d="M9 17h6" />
                                            <path d="M9 13h6" />
                                        </svg>
                                    @elseif($d->status_izin == 's')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52"
                                            viewBox="0 0 24 24" fill="none" stroke="#910808" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-first-aid-kit">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M8 8v-2a2 2 0 0 1 2 -2h4a2 2 0 0 1 2 2v2" />
                                            <path
                                                d="M4 8m0 2a2 2 0 0 1 2 -2h12a2 2 0 0 1 2 2v8a2 2 0 0 1 -2 2h-12a2 2 0 0 1 -2 -2z" />
                                            <path d="M10 14h4" />
                                            <path d="M12 12v4" />
                                        </svg>
                                    @elseif($d->status_izin == 'c')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="52" height="52"
                                            viewBox="0 0 24 24" fill="none" stroke="#0b7f77" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-beach">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M17.553 16.75a7.5 7.5 0 0 0 -10.606 0" />
                                            <path d="M18 3.804a6 6 0 0 0 -8.196 2.196l10.392 6a6 6 0 0 0 -2.196 -8.196z" />
                                            <path
                                                d="M16.732 10c1.658 -2.87 2.225 -5.644 1.268 -6.196c-.957 -.552 -3.075 1.326 -4.732 4.196" />
                                            <path d="M15 9l-3 5.196" />
                                            <path
                                                d="M3 19.25a2.4 2.4 0 0 1 1 -.25a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 2 1a2.4 2.4 0 0 0 2 1a2.4 2.4 0 0 0 2 -1a2.4 2.4 0 0 1 2 -1a2.4 2.4 0 0 1 1 .25" />
                                        </svg>
                                    @endif
                                </div>
                                <div class="datapresensi" style="flex-grow: 1;">
                                    <h3 style="line-height: 3px;"> {{ $tanggal }} {{ $namaBulan }}
                                        {{ $tahun }}
                                        ({{ $status }})
                                    </h3>
                                    <small style="line-height: 3px; margin-right:15px"> {{ $tanggal }}
                                        {{ $namaBulan }}
                                        {{ $tahun }} s/d {{ $tanggalsampai }} {{ $namaBulansampai }}
                                        {{ $tahunsampai }}</small>
                                    <p>


                                        <b>{{ $d->keterangan }}</b>
                                        <br>
                                        @if ($d->status_izin == 'c')
                                            <span class="badge bg-primary">Cuti {{ $d->nama_cuti }}</span>
                                            <br>
                                        @endif
                                        @php
                                            $path = Storage::url('uploads/izin/' . $d->foto_izin);
                                        @endphp
                                        @if (!empty($d->foto_izin))
                                            <a href="{{ url($path) }}" target="_blank"
                                                style="color: blue; margin-top:2px">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18"
                                                    viewBox="0 0 24 24" fill="none" stroke="#0a57a4" stroke-width="2"
                                                    stroke-linecap="round" stroke-linejoin="round"
                                                    class="icon icon-tabler icons-tabler-outline icon-tabler-paperclip">
                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                    <path
                                                        d="M15 7l-6.5 6.5a1.5 1.5 0 0 0 3 3l6.5 -6.5a3 3 0 0 0 -6 -6l-6.5 6.5a4.5 4.5 0 0 0 9 9l6.5 -6.5" />
                                                </svg> Lihat Lampiran Dokter
                                            </a>
                                        @endif
                                    </p>

                                </div>
                                <div class="status-badge" style="margin-left: auto;">
                                    @if ($d->status_approved == 0)
                                        <span class="badge bg-warning">Waiting</span>
                                    @elseif($d->status_approved == 1)
                                        <span class="badge bg-success">Approved</span>
                                    @elseif($d->status_approved == 2)
                                        <span class="badge bg-danger">Rejected</span>
                                    @endif
                                    <p style="margin-top: 5px; font-weight:bold">
                                        {{ hitunghari($d->tgl_izin_dari, $d->tgl_izin_sampai) }}
                                        Hari
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- <ul class="listview image-listview">
                    <li>
                        <div class="item">
                            <div class="in">
                                <div>
                                    <b>{{ $tanggal }} {{ $namaBulan }} {{ $tahun }}
                                        ({{ $d->status_izin == 's' ? 'Sakit' : 'Izin' }})
                                    </b><br>
                                    <small class="text-muted">{{ $d->keterangan }}</small>
                                </div>
                                @if ($d->status_approved == 0)
                                    <span class="badge bg-warning">Waiting</span>
                                @elseif($d->status_approved == 1)
                                    <span class="badge bg-success">Approved</span>
                                @elseif($d->status_approved == 2)
                                    <span class="badge bg-danger">Rejected</span>
                                @endif
                            </div>
                        </div>
                    </li>
                </ul> --}}
                @endforeach
            @endif
        </div>
    </div>
    <div class="fab-button animate bottom-right dropdown" style="margin-bottom: 70px">
        <a href="#" class="fab bg-primary" data-toggle="dropdown">
            <ion-icon name="add-outline" role="img" class="md hydrated" aria-label="add outline"></ion-icon>
        </a>
        <div class="dropdown-menu">
            <a href="/izinabsen" class="dropdown-item bg-primary">

                <ion-icon name="document-outline" role="img" class="md hydrated"
                    aria-label="image outline"></ion-icon>
                <p>Izin Absen</p>
            </a>
            <a href="/izinsakit" class="dropdown-item bg-primary">

                <ion-icon name="document-outline" role="img" class="md hydrated"
                    aria-label="videocam outline"></ion-icon>
                <p>Sakit</p>
            </a>
            <a href="/izincuti" class="dropdown-item bg-primary">

                <ion-icon name="document-outline" role="img" class="md hydrated"
                    aria-label="videocam outline"></ion-icon>
                <p>Cuti</p>
            </a>
        </div>
    </div>

    <div class="modal fade action-sheet" id="actionSheetIconed" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" style="font-size: 20px">Aksi</h5>
                </div>
                <div class="modal-body" id="showact">

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade dialogbox" id="deleteConfirm" data-backdrop="static" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Yakin Dihapus ?</h5>
                </div>
                <div class="modal-body">
                    Data Pengajuan Izin Akan dihapus
                </div>
                <div class="modal-footer">
                    <div class="btn-inline">
                        <a href="#" class="btn btn-text-secondary" data-dismiss="modal">Batalkan</a>
                        <a href="" class="btn btn-text-primary" id="hapuspengajuan">Hapus</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(function() {
            $(".card_izin").click(function(e) {
                var izin_id = $(this).attr("izin_id");
                var status_approved = $(this).attr("status_approved");

                if (status_approved == 1) {

                    Swal.fire({
                        title: 'Opps!',
                        text: 'Data Sudah Disetujui, Tidak Dapat Diubah',
                        icon: 'warning',

                    });
                } else {

                    $("#showact").load('/izin/' + izin_id + '/showact');
                }
            });
        });
    </script>
@endpush
