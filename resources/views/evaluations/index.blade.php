@extends('layouts/admin/tabler')

@section('content')
    <div class="container">
        <h2 class="page-title" style="margin-top: 20px">Daftar Karyawan</h2>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        <div class="card mt-4">
            <div class="card-body">
                <form method="GET" action="{{ route('evaluations.index') }}">
                    <div class="row" style="margin-bottom: 20px">
                        <div class="col-4">
                            <div class="form-group">
                                <select name="bulan" id="bulan" class="form-control selectmaterialize">
                                    <option value="">Bulan</option>
                                    @foreach ($namabulan as $key => $value)
                                        @if ($key != 0)
                                            <option value="{{ $key }}" {{ $bulan == $key ? 'selected' : '' }}>
                                                {{ $value }}
                                            </option>
                                        @endif
                                    @endforeach
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
                                    @for ($thn = $tahunmulai; $thn <= $tahunskrg; $thn++)
                                        <option value="{{ $thn }}" {{ $thn == $tahun ? 'selected' : '' }}>
                                            {{ $thn }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary">Filter</button>
                        </div>
                    </div>
                </form>

                @if ($karyawan->isEmpty())
                    <div class="alert alert-warning">
                        Tidak ada data karyawan untuk bulan dan tahun yang dipilih.
                    </div>
                @else
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Karyawan</th>
                                <th>Jumlah Penilaian</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($karyawan as $employee)
                                <tr>
                                    <td>{{ $loop->iteration + $karyawan->firstItem() - 1 }}</td>
                                    <td>{{ $employee->nama_lengkap }}</td>
                                    <td>{{ $employee->total_nilai }}</td>
                                    <td>
                                        @php
                                            $badgeClass = '';
                                            switch ($employee->status) {
                                                case 'Perpanjang PKWT':
                                                    $badgeClass = 'bg-success';
                                                    break;
                                                case 'Perpanjang PKWT dengan Catatan':
                                                    $badgeClass = 'bg-warning';
                                                    break;
                                                case 'Tidak Perpanjang PKWT':
                                                    $badgeClass = 'bg-danger';
                                                    break;
                                                case 'Belum dinilai':
                                                    $badgeClass = 'bg-secondary';
                                                    break;
                                                default:
                                                    $badgeClass = 'bg-info';
                                                    break;
                                            }
                                        @endphp
                                        <span class="badge {{ $badgeClass }}"
                                            style="color: white">{{ $employee->status }}</span>
                                    </td>
                                    <td>
                                        @if ($employee->total_nilai == 0)
                                            <a href="{{ route('evaluations.create', ['nik' => $employee->nik, 'bulan' => $bulan, 'tahun' => $tahun]) }}"
                                                class="btn btn-primary">Tambah Penilaian</a>
                                        @endif
                                        <a href="{{ route('evaluations.show', ['nik' => $employee->nik, 'bulan' => $bulan, 'tahun' => $tahun]) }}"
                                            class="btn btn-info">Lihat Hasil Penilaian</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <!-- Pagination Links -->
                    <div class="mt-3">
                        {{ $karyawan->links('vendor.pagination.bootstrap-5') }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection
