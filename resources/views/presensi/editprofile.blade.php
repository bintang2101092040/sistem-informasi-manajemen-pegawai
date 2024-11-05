@extends('layouts.presensi')

@section('header')
    <style>
        .upload-label {
            display: block;
            border: 5px dashed #007bff;
            /* Dashed border with primary color */
            padding: 20px;
            text-align: center;
            cursor: pointer;
            border-radius: 5px;
            /* Rounded corners */
            margin-top: 10px;
        }

        .upload-label:hover {
            background-color: #f0f8ff;
            /* Light blue background on hover */
        }
    </style>

    <div class="appHeader bg-primary text-light">
        <div class="left">
            <a href="/dashboard" class="headerButton goBack">
                <ion-icon name="chevron-back-outline"></ion-icon>
            </a>
        </div>
        <div class='pageTitle'>Edit Profile</div>
        <div class="right"></div>
    </div>
@endsection


@section('content')
    <div class="row" style="margin-top:4rem">
        <div class="col">
            @php
                $messagesuccess = Session::get('success');
                $messageerror = Session::get('error');
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

            @error('foto')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

        </div>
    </div>
    <form action="/presensi/{{ $karyawan->nik }}/updateprofile" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col">
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" class="form-control" value="{{ $karyawan->nama_lengkap }}" name="nama_lengkap"
                        placeholder="Nama Lengkap" autocomplete="off">
                </div>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <label for="no_hp">No. HP</label>
                    <input type="text" class="form-control" value="{{ $karyawan->no_hp }}" name="no_hp"
                        placeholder="No. HP" autocomplete="off">
                </div>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password" autocomplete="off">
                </div>
            </div>
            <label for="foto">Foto Profile</label>
            <div class="custom-file-upload" id="fileUpload1">
                <input type="file" name="foto" id="fileuploadInput" accept=".png, .jpg, .jpeg">
                <label for="fileuploadInput" class="upload-label">
                    <span>
                        <strong>
                            <ion-icon name="cloud-upload-outline" role="img" class="md hydrated"
                                aria-label="cloud upload outline"></ion-icon>
                            <i>Tap to Upload</i>
                        </strong>
                    </span>
                </label>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <button type="submit" class="btn btn-primary btn-block">
                        <ion-icon name="refresh-outline"></ion-icon>
                        Update
                    </button>
                </div>
            </div>
            <div class="form-group boxed">
                <div class="input-wrapper">
                    <a href="/proseslogout" class="btn btn-danger btn-block mt-2" style="margin-bottom:4rem">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-power">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M7 6a7.75 7.75 0 1 0 10 0" />
                            <path d="M12 4l0 8" />
                        </svg>
                        Log out
                    </a>
                </div>
            </div>
        </div>
    </form>
@endsection
