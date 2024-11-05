@extends('layouts.admin.tabler')

@section('content')
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: center;
        }

        th {
            background-color: #c4b638;
            color: black
        }

        .question-group {
            display: flex;
            align-items: center;
            margin-bottom: 1rem;
        }

        .question-group label {
            margin-right: 1.5rem;
        }

        .radio-label {
            display: inline-block;
            margin-right: 10px;
        }
    </style>

    <div class="container">
        <h2 class="page-title mt-4">Tambah Penilaian Karyawan :
            <div class="badge bg-secondary" style="color: white">{{ $karyawan->nama_lengkap }}</div>
        </h2>
        <form id="evaluation-form" action="{{ route('evaluations.store', $nik) }}" method="POST" style="margin-top: 10px">
            @csrf
            <input type="hidden" name="bulan" value="{{ request()->query('bulan') }}">
            <input type="hidden" name="tahun" value="{{ request()->query('tahun') }}">

            @foreach ($kategori as $index => $category)
                <div class="card mb-3">
                    <div class="card-header">
                        <h3>{{ $index + 1 }}. {{ $category->nama_kategori }}</h3>
                    </div>
                    <div class="card-body">
                        <table>
                            <thead>
                                <tr>
                                    <th>Pertanyaan</th>
                                    <th>Sangat Baik</th>
                                    <th>Baik</th>
                                    <th>Cukup</th>
                                    <th>Buruk</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pertanyaan->where('kode_kategori', $category->kode_kategori) as $question)
                                    <tr>
                                        <td>{{ $question->pertanyaan }}</td>
                                        <td>
                                            <input type="radio" name="questions[{{ $question->pertanyaan_id }}]"
                                                value="5" required>
                                        </td>
                                        <td>
                                            <input type="radio" name="questions[{{ $question->pertanyaan_id }}]"
                                                value="4" required>
                                        </td>
                                        <td>
                                            <input type="radio" name="questions[{{ $question->pertanyaan_id }}]"
                                                value="3" required>
                                        </td>
                                        <td>
                                            <input type="radio" name="questions[{{ $question->pertanyaan_id }}]"
                                                value="2" required>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endforeach
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>

    <script>
        document.getElementById('evaluation-form').addEventListener('submit', function(event) {
            const questions = document.querySelectorAll('input[type="radio"]');
            const questionIds = [...new Set(Array.from(questions).map(input => input.name))];

            let allSelected = true;
            let unselectedQuestions = [];

            questionIds.forEach(id => {
                const selected = document.querySelector(`input[name="${id}"]:checked`);
                if (!selected) {
                    // Extract question ID from name
                    const questionId = id.match(/\d+/)[0];
                    const questionText = document.querySelector(`input[name="${id}"]`).closest('tr')
                        .querySelector('td').textContent;
                    unselectedQuestions.push(questionText);
                    allSelected = false;
                }
            });

            if (!allSelected) {
                event.preventDefault();
                alert('Pertanyaan berikut belum dijawab:\n' + unselectedQuestions.join('\n'));
            }
        });
    </script>
@endsection
