<form action="/pertanyaan/{{ $pertanyaan->pertanyaan_id }}/update" method="POST" id="formeditpertanyaan">
    @csrf
    <input type="hidden" name="pertanyaan_id" value="{{ $pertanyaan->pertanyaan_id }}">
    <div class="row">
        <div class="col-12">
            <label for="pertanyaan">Nama Pertanyaan</label>
            <div class="input-icon mb-3">
                <span class="input-icon-addon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-barcode">
                        <path stroke="none" d="M0 0h24H0z" fill="none" />
                        <path d="M4 7v-1a2 2 0 0 1 2 -2h2" />
                        <path d="M4 17v1a2 2 0 0 0 2 2h2" />
                        <path d="M16 4h2a2 2 0 0 1 2 2v1" />
                        <path d="M16 20h2a2 2 0 0 0 2 -2v-1" />
                        <path d="M5 11h1v2h-1z" />
                        <path d="M10 11l0 2" />
                        <path d="M14 11h1v2h-1z" />
                        <path d="M19 11l0 2" />
                    </svg>
                </span>
                <input type="text" value="{{ $pertanyaan->pertanyaan }}" id="pertanyaan" name="pertanyaan"
                    class="form-control" placeholder="Nama Pertanyaan">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="form-label">Kategori</div>
            <select name="kode_kategori" id="kode_kategori" class="form-select">
                <option value="">Pilih Kategori</option>
                @foreach ($kategori as $d)
                    <option value="{{ $d->kode_kategori }}"
                        {{ $d->kode_kategori == $pertanyaan->kode_kategori ? 'selected' : '' }}>{{ $d->nama_kategori }}
                    </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-12">
            <div class="form-group">
                <button class="btn btn-primary w-100">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                        fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round" class="icon icon-tabler icon-tabler-send">
                        <path stroke="none" d="M0 0h24H0z" fill="none" />
                        <path d="M10 14l11 -11" />
                        <path d="M21 3l-6.5 18a.55 .55 0 0 1 -1 0l-3.5 -7l-7 -3.5a.55 .55 0 0 1 0 -1l18 -6.5" />
                    </svg>
                    Simpan
                </button>
            </div>
        </div>
    </div>
</form>
