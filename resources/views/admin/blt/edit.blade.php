@extends('admin.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-8 mx-auto">
        <div class="card shadow-lg">
            <div class="card-header bg-warning">
                <h5 class="card-title fw-semibold text-dark mb-0">Edit Data: {{ $blt->nama }}</h5>
            </div>
            <div class="card-body">
                <form action="/admin/blt/{{ $blt->id }}" method="POST">
                    @method('put')
                    @csrf

                    <div class="mb-3">
                        <label for="nik" class="form-label">NIK</label>
                        <input type="text" class="form-control @error('nik') is-invalid @enderror" id="nik" name="nik" value="{{ old('nik', $blt->nik) }}" required maxlength="16">
                        @error('nik')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="kk" class="form-label">Nomor KK</label>
                        <input type="text" class="form-control @error('kk') is-invalid @enderror" id="kk" name="kk" value="{{ old('kk', $blt->kk) }}" required maxlength="16">
                        @error('kk')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $blt->nama) }}" required>
                        @error('nama')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="metode_pencairan" class="form-label">Metode Pencairan (Opsional)</label>
                        <select class="form-control form-select @error('metode_pencairan') is-invalid @enderror" name="metode_pencairan" id="metode_pencairan">
                            {{-- Tambahkan opsi kosong di sini --}}
                            <option value="" {{ old('metode_pencairan', $blt->metode_pencarian) == '' ? 'selected' : '' }}>-- Belum Memilih --</option>

                            @foreach(['cash', 'transfer'] as $metode)
                                <option value="{{ $metode }}" {{ old('metode_pencairan', $blt->metode_pencarian) == $metode ? 'selected' : '' }}>
                                    {{ ucfirst($metode) }}
                                </option>
                            @endforeach
                        </select>
                        @error('metode_pencairan')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3" required>{{ old('alamat', $blt->alamat) }}</textarea>
                        @error('alamat')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="tahun" class="form-label">Tahun</label>
                            <input type="number" class="form-control @error('tahun') is-invalid @enderror" id="tahun" name="tahun" value="{{ old('tahun', $blt->tahun) }}" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select" name="status" id="status">
                                @foreach(['cair', 'ditolak'] as $status)
                                    <option value="{{ $status }}" {{ old('status', $blt->status) == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mt-4 d-flex justify-content-between">
                        <a href="/admin/blt" class="btn btn-secondary">Batal</a>
                        <button type="submit" class="btn btn-warning">Perbarui Data</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
