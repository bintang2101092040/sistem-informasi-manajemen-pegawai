@extends('layouts.admin.tabler')

@section('content')
    <div class="container">
        <h2>Hasil Penilaian Karyawan :
            <div class="badge bg-secondary" style="color: white">{{ $karyawan->nama_lengkap }}</div>
            @if ($bulan && $tahun)
                <div class="badge bg-info" style="color: white">Bulan: {{ $namabulan[$bulan] }}, Tahun: {{ $tahun }}
                </div>
            @endif
        </h2>

        <div class="mb-3">
            <a href="{{ route('evaluations.index', ['bulan' => $bulan, 'tahun' => $tahun]) }}"
                class="btn btn-secondary">Kembali ke Daftar Karyawan</a>
        </div>

        <div class="row">
            @foreach ($evaluations->groupBy('kategori') as $kategori => $items)
                <div class="col-md-6 mb-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-center">
                            <!-- Menggunakan d-flex dan justify-content-center -->
                            <h5 class="card-title mb-0">{{ $kategori }}</h5>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Pertanyaan</th>
                                        <th> Nilai</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->pertanyaan }}</td>
                                            <td>
                                                @if ($item->nilai == 5)
                                                    Sangat Baik({{ $item->nilai }})
                                                @elseif ($item->nilai == 4)
                                                    Baik({{ $item->nilai }})
                                                @elseif ($item->nilai == 3)
                                                    Cukup({{ $item->nilai }})
                                                @elseif ($item->nilai == 2)
                                                    Buruk({{ $item->nilai }})
                                                @else
                                                    Tidak Ada Penilaian({{ $item->nilai }})
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <p>Total Nilai: {{ $totalNilai }}</p>
        <p>Status: {{ $status }}</p>

    </div>
@endsection
