<form action="/karyawan/{{ $karyawan->nik }}/update" method="POST" id="formkaryawan" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-6">
            <!-- Input NIK -->
            <div class="form-label">NIK</div>
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- SVG Icon for NIK -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-barcode">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M4 7v-1a2 2 0 0 1 2 -2h2" />
                        <path d="M4 17v1a2 2 0 0 0 2 2h2" />
                        <path d="M16 4h2a2 2 0 0 1 2 2v1" />
                        <path d="M16 20h2a2 2 0 0 0 2 -2v-1" />
                        <path d="M5 11h1v2h-1z" />
                        <path d="M10 11v2" />
                        <path d="M14 11h1v2h-1z" />
                        <path d="M19 11v2" />
                    </svg>
                </span>
                <input type="text" value="{{ $karyawan->nik }}" id="nik" name="nik" class="form-control"
                    placeholder="NIK" disabled>
            </div>
        </div>

        <div class="col-6">
            <!-- Input Nama Lengkap -->
            <div class="form-label">Nama Lengkap</div>
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- SVG Icon for Nama Lengkap -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-user">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg>
                </span>
                <input type="text" value="{{ $karyawan->nama_lengkap }}" id="nama_lengkap" name="nama_lengkap"
                    class="form-control" placeholder="Nama Lengkap">
            </div>
        </div>
    </div>

    <div class="row">


        <div class="col-6">
            <div class="form-label">Jabatan</div>
            <select name="nama_jabatan" id="nama_jabatan" class="form-select">
                <option value="">Pilih Cabang</option>
                @foreach ($jabatan as $d)
                    <option {{ $karyawan->nama_jabatan == $d->nama_jabatan ? 'selected' : '' }}
                        value="{{ $d->nama_jabatan }}">{{ $d->nama_jabatan }}</option>
                @endforeach
            </select>
        </div>


        <div class="col-6">
            <!-- Input NO. HP -->
            <div class="form-label">No. HP</div>
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- SVG Icon for NO. HP -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-phone">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M5 4h4l2 5l-2.5 1.5a11 11 0 0 0 5 5l1.5 -2.5l5 2v4a2 2 0 0 1 -2 2a16 16 0 0 1 -15 -15a2 2 0 0 1 2 -2" />
                    </svg>
                </span>
                <input type="text" value="{{ $karyawan->no_hp }}" id="no_hp" name="no_hp" class="form-control"
                    placeholder="NO. Hp">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-6">
            <div class="form-label">Cabang</div>
            <select name="kode_cabang" id="kode_cabang" class="form-select">
                <option value="">Pilih Cabang</option>
                @foreach ($cabang as $d)
                    <option {{ $karyawan->kode_cabang == $d->kode_cabang ? 'selected' : '' }}
                        value="{{ $d->kode_cabang }}">{{ $d->nama_cabang }}</option>
                @endforeach
            </select>
        </div>
    </div>


    <!-- Input Tambahan -->
    <div class="row mt-2">
        <div class="col-6">
            <!-- Input Jenis Kelamin -->
            <div class="form-label">Jenis Kelamin</div>
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- SVG Icon for Jenis Kelamin -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-gender">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="12" cy="9" r="6" />
                        <path d="M12 3v6h6" />
                        <path d="M5.5 17h2.5l1 3l3 -6h2.5" />
                    </svg>
                </span>
                <input type="text" value="{{ $karyawan->jenis_kelamin }}" id="jenis_kelamin"
                    name="jenis_kelamin" class="form-control" placeholder="Jenis Kelamin">
            </div>
        </div>


        <div class="col-6">
            <!-- Input Tempat Tanggal Lahir -->
            <div class="form-label">Tempat Tanggal Lahir</div>
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- SVG Icon for Tempat Tanggal Lahir -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-calendar">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <rect x="4" y="5" width="16" height="16" rx="2" />
                        <line x1="16" y1="3" x2="16" y2="7" />
                        <line x1="8" y1="3" x2="8" y2="7" />
                        <line x1="4" y1="11" x2="20" y2="11" />
                    </svg>
                </span>
                <input type="text" value="{{ $karyawan->tempat_tgl_lahir }}" id="tempat_tgl_lahir"
                    name="tempat_tgl_lahir" class="form-control" placeholder="Tempat, Tanggal Lahir">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <!-- Input NO. KK -->
            <div class="form-label">No. KK</div>
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- SVG Icon for NO. KK -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-id">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <rect x="4" y="4" width="16" height="16" rx="2" />
                        <line x1="9" y1="9" x2="9.01" y2="9" />
                        <line x1="9" y1="15" x2="15" y2="15" />
                        <line x1="9" y1="11" x2="15" y2="11" />
                    </svg>
                </span>
                <input type="text" value="{{ $karyawan->no_kk }}" id="no_kk" name="no_kk"
                    class="form-control" placeholder="NO. KK">
            </div>
        </div>

        <div class="col-6">
            <!-- Input NIK Karyawan -->
            <div class="form-label">NIK. Karyawan</div>
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- SVG Icon for NIK Karyawan -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-badge">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <rect x="4" y="4" width="16" height="16" rx="2" />
                        <circle cx="12" cy="10" r="3" />
                        <path d="M8 16h8" />
                    </svg>
                </span>
                <input type="text" value="{{ $karyawan->nik_karyawan }}" id="nik_karyawan" name="nik_karyawan"
                    class="form-control" placeholder="NIK Karyawan">
            </div>
        </div>

    </div>

    <div class="row">




    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-label">Tanggal Gabung</div>
            <!-- Input Tanggal Gabung -->
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- SVG Icon for Tanggal Gabung -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-calendar">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <rect x="4" y="5" width="16" height="16" rx="2" />
                        <line x1="16" y1="3" x2="16" y2="7" />
                        <line x1="8" y1="3" x2="8" y2="7" />
                        <line x1="4" y1="11" x2="20" y2="11" />
                    </svg>
                </span>
                <input type="date" value="{{ $karyawan->tanggal_gabung }}" id="tanggal_gabung"
                    name="tanggal_gabung" class="form-control" placeholder="Tanggal Gabung">
            </div>
        </div>


        <div class="col-6">
            <!-- Input BPJS Kesehatan -->
            <div class="form-label">BPJS Kesehatan</div>
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- SVG Icon for BPJS Kesehatan -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-heart-rate-monitor">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 5v14" />
                        <path d="M8 8v8" />
                        <path d="M16 8v8" />
                        <path d="M20 10v4" />
                        <path d="M4 10v4" />
                    </svg>
                </span>
                <input type="text" value="{{ $karyawan->bpjs_kesehatan }}" id="bpjs_kesehatan"
                    name="bpjs_kesehatan" class="form-control" placeholder="BPJS Kesehatan">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <div class="form-label">BPJS Ketenagakerjaan</div>
            <!-- Input BPJS Ketenagakerjaan -->
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- SVG Icon for BPJS Ketenagakerjaan -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-heart">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 21c-4.636 0 -9 -4.29 -9 -9.5a9 9 0 0 1 17.543 -3.78a9 9 0 0 1 -2.543 13.28" />
                    </svg>
                </span>
                <input type="text" value="{{ $karyawan->bpjs_ketenagakerjaan }}" id="bpjs_ketenagakerjaan"
                    name="bpjs_ketenagakerjaan" class="form-control" placeholder="BPJS Ketenagakerjaan">
            </div>
        </div>


        <div class="col-6">
            <!-- Input Rekening Mandiri -->
            <div class="form-label">Input Rekening Mandiri</div>
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- SVG Icon for Rekening Mandiri -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-credit-card">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <rect x="3" y="5" width="18" height="14" rx="3" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                        <line x1="7" y1="15" x2="7.01" y2="15" />
                        <line x1="11" y1="15" x2="13" y2="15" />
                    </svg>
                </span>
                <input type="text" value="{{ $karyawan->rek_mandiri }}" id="rek_mandiri" name="rek_mandiri"
                    class="form-control" placeholder="Rek Mandiri">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <!-- Input Email -->
            <div class="form-label">Email</div>
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- SVG Icon for Email -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-mail">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <rect x="3" y="5" width="18" height="14" rx="2" />
                        <path d="M3 7l9 6l9 -6" />
                    </svg>
                </span>
                <input type="email" value="{{ $karyawan->email }}" id="email" name="email"
                    class="form-control" placeholder="Email">
            </div>
        </div>

        <div class="col-6">
            <!-- Input NPWP -->
            <div class="form-label">NPWP</div>
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- SVG Icon for NPWP -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-id">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <rect x="4" y="4" width="16" height="16" rx="2" />
                        <line x1="9" y1="9" x2="9.01" y2="9" />
                        <line x1="9" y1="15" x2="15" y2="15" />
                        <line x1="9" y1="11" x2="15" y2="11" />
                    </svg>
                </span>
                <input type="text" value="{{ $karyawan->npwp }}" id="npwp" name="npwp"
                    class="form-control" placeholder="NPWP">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6">
            <!-- Input Golongan Darah -->
            <div class="form-label">Golongan Darah</div>
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- SVG Icon for Golongan Darah -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-drop">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M12 3l-6 7a6 6 0 0 0 12 0z" />
                    </svg>
                </span>
                <input type="text" value="{{ $karyawan->golongan_darah }}" id="golongan_darah"
                    name="golongan_darah" class="form-control" placeholder="Golongan Darah">
            </div>
        </div>
        <div class="col-6">
            <div class="form-label">Status</div>
            <!-- Input Status -->
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- SVG Icon for Status -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-flag">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 4v17" />
                        <path d="M5 4a5 5 0 0 0 5 5h7l-2 7h-5a5 5 0 0 0 -5 5" />
                    </svg>
                </span>
                <input type="text" value="{{ $karyawan->status }}" id="status" name="status"
                    class="form-control" placeholder="Status">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Input Data Keluarga -->
            <div class="form-label">Data Keluarga</div>
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- SVG Icon for Data Keluarga -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-users">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="9" cy="7" r="4" />
                        <circle cx="20" cy="7" r="4" />
                        <circle cx="20" cy="17" r="4" />
                        <circle cx="9" cy="17" r="4" />
                    </svg>
                </span>
                <textarea id="data_keluarga" name="data_keluarga" class="form-control" placeholder="Data Keluarga" rows="6">{{ $karyawan->data_keluarga }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Input Alamat KTP -->
            <div class="form-label">Alamat KTP</div>
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- SVG Icon for Alamat KTP -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-map-pin">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <circle cx="12" cy="11" r="3" />
                        <path d="M12 2a9 9 0 0 0 -9 9c0 5 9 13 9 13s9 -8 9 -13a9 9 0 0 0 -9 -9" />
                    </svg>
                </span>

                <textarea id="alamat_ktp" name="alamat_ktp" class="form-control" placeholder="Alamat KTP" rows="6">{{ $karyawan->alamat_ktp }}</textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-label">Alamat Domisili</div>
            <!-- Input Alamat Domisili -->
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <!-- SVG Icon for Alamat Domisili -->
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-home">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M5 12h14" />
                        <path d="M12 5l-7 7v6h14v-6z" />
                    </svg>
                </span>


                <textarea id="alamat_domisili" name="alamat_domisili" class="form-control" placeholder="Alamat Domisili"
                    rows="6">{{ $karyawan->alamat_domisili }}</textarea>
            </div>
        </div>

    </div>


    <div class="row mt-2">
        <div class="col-12">
            <!-- Input Foto -->
            <div class="form-label">Foto</div>
            <input type="file" name="foto" class="form-control">
            <input type="hidden" name="old_foto" value="{{ $karyawan->foto }}">
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-12">
            <button type="submit" class="btn btn-primary w-100">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                    stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-upload">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                    <path d="M4 17v2a2 2 0 0 0 2 2h12a2 2 0 0 0 2 -2v-2" />
                    <path d="M7 9l5 -5l5 5" />
                    <path d="M12 4l0 12" />
                </svg>
                Update</button>
        </div>
    </div>
</form>
