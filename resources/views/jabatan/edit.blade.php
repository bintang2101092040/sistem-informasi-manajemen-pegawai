<form action="/jabatan/{{ $jabatan->nama_jabatan }}/update" method="POST" id="formjabatan">
    @csrf
    <div class="row">
        <div class="col-12">
            <!-- Input Kode Kategori -->
            <div class="form-label">Nama Jabatan</div>
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
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
                <input type="text" value="{{ $jabatan->nama_jabatan }}" id="nama_jabatan" name="nama_jabatan"
                    class="form-control @error('nama_jabatan') is-invalid @enderror" placeholder="Nama Jabatan"
                    disabled>
                @error('nama_jabatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Input Gaji Pokok -->
            <div class="form-label">Gaji Pokok</div>
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-user">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg>
                </span>
                <input type="text" value="{{ number_format($jabatan->gaji_pokok, 0, ',', '.') }}" id="gaji_pokok"
                    name="gaji_pokok" class="form-control currency @error('gaji_pokok') is-invalid @enderror"
                    placeholder="Gaji Pokok">
                @error('gaji_pokok')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <!-- Input Tunjangan Tetap -->
            <div class="form-label">Tunjangan Tetap</div>
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-user">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg>
                </span>
                <input type="text" value="{{ number_format($jabatan->tunjangan_tetap, 0, ',', '.') }}"
                    id="tunjangan_tetap" name="tunjangan_tetap"
                    class="form-control currency @error('tunjangan_tetap') is-invalid @enderror"
                    placeholder="Tunjangan Tetap">
                @error('tunjangan_tetap')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Input Tunjangan Tidak Tetap -->
            <div class="form-label">Tunjangan Tidak Tetap</div>
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-user">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg>
                </span>
                <input type="text"
                    value="{{ $jabatan->tunjangan_tidak_tetap ? number_format($jabatan->tunjangan_tidak_tetap, 0, ',', '.') : '' }}"
                    id="tunjangan_tidak_tetap" name="tunjangan_tidak_tetap"
                    class="form-control currency @error('tunjangan_tidak_tetap') is-invalid @enderror"
                    placeholder="Tunjangan Tidak Tetap">
                @error('tunjangan_tidak_tetap')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Input BPJS Ketenagakerjaan -->
            <div class="form-label">BPJS Ketenagakerjaan</div>
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-user">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg>
                </span>
                <input type="text" value="{{ number_format($jabatan->gaji_bpjs_ketenagakerjaan, 0, ',', '.') }}"
                    id="gaji_bpjs_ketenagakerjaan" name="gaji_bpjs_ketenagakerjaan"
                    class="form-control currency @error('gaji_bpjs_ketenagakerjaan') is-invalid @enderror"
                    placeholder="BPJS Ketenagakerjaan">
                @error('gaji_bpjs_ketenagakerjaan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <!-- Input BPJS Kesehatan -->
            <div class="form-label">BPJS Kesehatan</div>
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-user">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0 -8 0" />
                        <path d="M6 21v-2a4 4 0 0 1 4 -4h4a4 4 0 0 1 4 4v2" />
                    </svg>
                </span>
                <input type="text" value="{{ number_format($jabatan->gaji_bpjs_kesehatan, 0, ',', '.') }}"
                    id="gaji_bpjs_kesehatan" name="gaji_bpjs_kesehatan"
                    class="form-control currency @error('gaji_bpjs_kesehatan') is-invalid @enderror"
                    placeholder="BPJS Kesehatan">
                @error('gaji_bpjs_kesehatan')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
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
                Update
            </button>
        </div>
    </div>
</form>

<!-- Tambahkan JavaScript -->
<script>
    document.querySelectorAll('.currency').forEach(function(input) {
        input.addEventListener('input', function() {
            let value = input.value.replace(/[^0-9]/g, '');
            input.value = new Intl.NumberFormat('id-ID').format(value);
        });
        input.form.addEventListener('submit', function() {
            let rawValue = input.value.replace(/[^\d]/g, ''); // Remove formatting
            input.value = rawValue;
        });

    });
</script>
