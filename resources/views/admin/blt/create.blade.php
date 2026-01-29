@extends('admin.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow-lg">
            <div class="card-header bg-primary">
                <h5 class="card-title fw-semibold text-white mb-0">Tambah Data Penerima BLT</h5>
            </div>
            <div class="card-body">
                <form action="/admin/blt" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK (Nomor Induk Kependudukan)</label>
                        <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik') }}" placeholder="16 Digit NIK" required maxlength="16">
                        @error('nik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kk" class="form-label">Nomor KK</label>
                        <input type="text" class="form-control @error('kk') is-invalid @enderror" id="kk" name="kk" value="{{ old('kk') }}" placeholder="16 Digit Nomor KK" required maxlength="16">
                        @error('kk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat Lengkap</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" required>{{ old('alamat') }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="metode_pencairan" class="form-label">Metode Pencairan (Opsional)</label>
                        {{-- Atribut 'required' dihapus untuk membolehkan kosong --}}
                        <select class="form-select @error('metode_pencairan') is-invalid @enderror" name="metode_pencairan" id="metode_pencairan">
                            {{-- Tambahkan option kosong sebagai default --}}
                            <option value="" {{ old('metode_pencairan') == '' ? 'selected' : '' }}>-- Belum Memilih / Kosong --</option>
                            <option value="cash" {{ old('metode_pencairan') == 'cash' ? 'selected' : '' }}>Cash</option>
                            <option value="transfer" {{ old('metode_pencairan') == 'transfer' ? 'selected' : '' }}>Transfer</option>
                        </select>
                        @error('metode_pencairan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tahun" class="form-label">Tahun Anggaran</label>
                            <input type="number" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" value="{{ old('tahun', date('Y')) }}" required>
                            @error('tahun')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status Bantuan</label>
                            <select class="form-select @error('status') is-invalid @enderror" name="status" id="status" required>
                                <option value="cair" {{ old('status') == 'cair' ? 'selected' : '' }}>Cair</option>
                                <option value="ditolak" {{ old('status') == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="/admin/blt" class="btn btn-secondary">Kembali</a>
                        <button type="submit" class="btn btn-primary">Simpan Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
