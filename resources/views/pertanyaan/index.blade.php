@extends('layouts/admin/tabler')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <h2 class="page-title">
                        Data Pertanyaan Penilaian
                    </h2>
                </div>
            </div>
        </div>
    </div>

    <div class="page-body">
        <div class="container-xl">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    @if (Session::get('success'))
                                        <div class="alert alert-success">
                                            {{ Session::get('success') }}
                                        </div>
                                    @endif

                                    @if (Session::get('warning'))
                                        <div class="alert alert-warning">
                                            {{ Session::get('warning') }}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-12">
                                    <a href="#" class="btn btn-primary" id="btnTambahpertanyaan">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icon-tabler-plus">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M12 5l0 14" />
                                            <path d="M5 12l14 0" />
                                        </svg>
                                        Tambah Data Pertanyaan
                                    </a>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-12">
                                    <form action="/pertanyaan" method="GET">
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="form-group">
                                                    <select name="kode_kategori" id="kode_kategori" class="form-select">
                                                        <option value="">Pilih Kategori</option>
                                                        @foreach ($kategori as $d)
                                                            <option
                                                                {{ Request('kode_kategori') == $d->kode_kategori ? 'selected' : '' }}
                                                                value="{{ $d->kode_kategori }}">{{ $d->nama_kategori }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-2">
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none"
                                                            stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                                            stroke-linejoin="round"
                                                            class="icon icon-tabler icon-tabler-search">
                                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                                            <path d="M21 21l-6 -6" />
                                                        </svg>
                                                        Cari
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="row mt-2">
                                <div class="col-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Pertanyaan</th>
                                                <th>Kategori</th>
                                                <th>Aksi</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pertanyaan as $d)
                                                <tr>
                                                    <td>{{ $loop->iteration + $pertanyaan->firstItem() - 1 }}</td>
                                                    <td>{{ $d->pertanyaan }}</td>
                                                    <td>{{ $d->nama_kategori }}</td>
                                                    <td class="action-column">
                                                        <div class="btn-group">
                                                            <a href="#" class="edit btn btn-info btn-sm"
                                                                pertanyaan_id="{{ $d->pertanyaan_id }}">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                    height="24" viewBox="0 0 24 24" fill="none"
                                                                    stroke="currentColor" stroke-width="2"
                                                                    stroke-linecap="round" stroke-linejoin="round"
                                                                    class="icon icon-tabler icon-tabler-edit">
                                                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                                    <path
                                                                        d="M7 7h-1a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-1" />
                                                                    <path
                                                                        d="M20.385 6.585a2.1 2.1 0 0 0 -2.97 -2.97l-8.415 8.385v3h3l8.385 -8.415z" />
                                                                    <path d="M16 5l3 3" />
                                                                </svg>
                                                                Edit
                                                            </a>

                                                            <form action="/pertanyaan/{{ $d->pertanyaan_id }}/delete"
                                                                style="margin-left: 5px" method="POST">
                                                                @csrf
                                                                <a class="btn btn-danger btn-sm delete-confirm">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                        height="24" viewBox="0 0 24 24" fill="none"
                                                                        stroke="currentColor" stroke-width="2"
                                                                        stroke-linecap="round" stroke-linejoin="round"
                                                                        class="icon icon-tabler icon-tabler-trash">
                                                                        <path stroke="none" d="M0 0h24v24H0z"
                                                                            fill="none" />
                                                                        <path d="M4 7l16 0" />
                                                                        <path d="M10 11l0 6" />
                                                                        <path d="M14 11l0 6" />
                                                                        <path
                                                                            d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                                        <path
                                                                            d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                                                    </svg>
                                                                    Hapus
                                                                </a>
                                                            </form>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    {{ $pertanyaan->links('vendor.pagination.bootstrap-5') }}
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- modal Tambah Data Pertanyaan --}}
    <div class="modal modal-blur fade" id="modal-inputpertanyaan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Data Pertanyaan </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/pertanyaan/store" method="POST" id="formpertanyaan">
                        @csrf
                        <div class="row">
                            <div class="col-12">
                                <label for="pertanyaan">Nama Pertanyaan</label>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round"
                                            class="icon icon-tabler icons-tabler-outline icon-tabler-zoom-question">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M10 10m-7 0a7 7 0 1 0 14 0a7 7 0 1 0 -14 0" />
                                            <path d="M21 21l-6 -6" />
                                            <path d="M10 13l0 .01" />
                                            <path d="M10 10a1.5 1.5 0 1 0 -1.14 -2.474" />
                                        </svg>
                                    </span>
                                    <input type="text" id="pertanyaan" name="pertanyaan" class="form-control"
                                        placeholder="Pertanyaan">
                                </div>
                            </div>

                            <div class="col-12">
                                <label for="kode_kategori">Kategori</label>
                                <div class="input-icon mb-3">
                                    <span class="input-icon-addon">

                                    </span>
                                    <select name="kode_kategori" id="kode_kategori" class="form-select">
                                        <option value="">Pilih Kategori</option>
                                        @foreach ($kategori as $d)
                                            <option value="{{ $d->kode_kategori }}">{{ $d->nama_kategori }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary w-100">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                        stroke-linecap="round" stroke-linejoin="round"
                                        class="icon icon-tabler icon-tabler-send">
                                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                        <path d="M10 14l11 -11" />
                                        <path d="M21 3l-6 18a0.55 .55 0 0 1 -1 0l-4 -9l-9 -4a0.55 .55 0 0 1 0 -1l18 -6" />
                                    </svg>
                                    Simpan
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- modal Edit Data Pertanyaan --}}
    <div class="modal modal-blur fade" id="modal-editpertanyaan" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <!-- Form edit pertanyaan akan dimuat di sini melalui AJAX -->
            </div>
        </div>
    </div>
@endsection

@push('myscript')
    <script>
        $(function() {
            $("#btnTambahpertanyaan").click(function() {
                $("#modal-inputpertanyaan").modal("show");
            });

            $(".edit").click(function() {
                var pertanyaan_id = $(this).attr('pertanyaan_id');
                $.ajax({
                    type: 'POST',
                    url: '/pertanyaan/edit',
                    data: {
                        _token: "{{ csrf_token() }}",
                        pertanyaan_id: pertanyaan_id
                    },
                    cache: false,
                    success: function(respond) {
                        $("#modal-editpertanyaan .modal-content").html(respond);
                        $("#modal-editpertanyaan").modal("show");
                    }
                });
            });

            $(".delete-confirm").click(function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Apakah anda yakin?',
                    text: "Data yang sudah dihapus tidak bisa dikembalikan!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).parent('form').submit();
                    }
                });
            });
        });
    </script>
@endpush
