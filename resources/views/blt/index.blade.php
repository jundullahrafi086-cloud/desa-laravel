@extends('layouts.main')

@section('content')
<style>
/* ===============================
   HERO – UMKM STYLE
================================ */
.hero-section {
  background: linear-gradient(135deg, #6fcf97, #a8e6c3);
  color: white;
  padding: 6rem 0 7rem;
  margin-bottom: 3rem;
  border-radius: 0 0 50px 0;
  position: relative;
  overflow: hidden;
}

.hero-section::before {
  content: '';
  position: absolute;
  inset: -40%;
  background:
    radial-gradient(circle at 30% 30%, #f7f796, transparent 40%),
    radial-gradient(circle at 70% 70%, rgba(255,255,255,.25), transparent 45%);
  animation: floatBg 22s linear infinite;
}

@keyframes floatBg {
  0% { transform: rotate(0deg) scale(1); }
  50% { transform: rotate(180deg) scale(1.05); }
  100% { transform: rotate(360deg) scale(1); }
}

.hero-section .container {
  position: relative;
  z-index: 1;
}

/* ===============================
   SEARCH CARD – UMKM STYLE
================================ */
.search-section {
  background: white;
  border-radius: 20px;
  padding: 2.5rem;
  box-shadow: 0 20px 40px rgba(111,207,151,.35);
  margin-top: -60px;
  position: relative;
  z-index: 5;
  border-top: 5px solid #6fcf97;
  animation: fadeUp .8s ease forwards;
}

@media (max-width: 768px) {
  .search-section {
    padding: 1.5rem;
    margin-top: -40px;
  }
  .result-card {
    padding: 1.25rem;
  }
}

/* ===============================
   BUTTON
================================ */
.btn-search {
  background: linear-gradient(135deg, #6fcf97, #f7f796);
  color: white;
  border-radius: 14px;
  padding: 0.9rem 2rem;
  font-weight: 700;
  border: none;
  box-shadow: 0 6px 18px rgba(111,207,151,.45);
  transition: .3s;
}

.btn-search:hover {
  transform: translateY(-2px);
  box-shadow: 0 10px 28px rgba(111,207,151,.6);
  color: white;
}

/* ===============================
   RESULT CARD – UMKM STYLE
================================ */
.result-card {
  background: white;
  border-radius: 20px;
  padding: 2rem;
  box-shadow: 0 15px 35px rgba(0,0,0,.08);
  border-left: 6px solid #6fcf97;
  animation: fadeUp .6s ease forwards;
}

/* ===============================
   STATUS BADGE
================================ */
.status-badge {
  padding: .6rem 1.4rem;
  border-radius: 50px;
  font-weight: 700;
  font-size: .85rem;
  display: inline-flex;
  align-items: center;
  gap: .4rem;
}

/* ===============================
   ANIMATION
================================ */
@keyframes fadeUp {
  from {
    opacity: 0;
    transform: translateY(25px);
  }
  to {
    opacity: 1;
    transform: translateY(0);
  }
}
</style>


<div class="hero-section">
  <div class="container text-center text-md-start">
    <h1 class="display-5 fw-bold mb-2" data-aos="fade-up">Cek Bantuan Langsung Tunai</h1>
    <p class="lead" data-aos="fade-up" data-aos-delay="100">Transparansi penyaluran bantuan untuk masyarakat desa.</p>
  </div>
</div>

<div class="container mb-5">
  <div class="search-section" data-aos="zoom-in">
    <form action="{{ route('blt.public') }}" method="GET">
      <div class="row g-3 align-items-center">
        <div class="col-md-9">
          <label class="form-label fw-bold text-muted">Nomor Induk Kependudukan (NIK)</label>
          <input type="text" name="nik" class="form-control form-control-lg @error('nik') is-invalid @enderror"
                 placeholder="Masukkan 16 digit NIK sesuai KTP..." value="{{ request('nik') }}" maxlength="16">
          @error('nik')
            <div class="invalid-feedback">{{ $message }}</div>
          @enderror
        </div>
        <div class="col-md-3 mt-md-4">
          <button type="submit" class="btn btn-search w-100 mt-2">
            <i class="ti ti-search me-2"></i> Periksa Data
          </button>
        </div>
      </div>
    </form>
  </div>

  @if($searchPerformed)
  <div class="mt-5" data-aos="fade-up">
    <div class="d-flex align-items-center mb-4">
        <div class="bg-success p-2 rounded-circle me-3">
            <i class="ti ti-info-circle text-white fs-4"></i>
        </div>
        <h3 class="fw-bold mb-0">Hasil Pencarian</h3>
    </div>

    @if($hasil)
    <div class="result-card mb-4">
      <div class="row">
        <div class="col-md-6 mb-3">
          <small class="text-muted d-block mb-1 text-uppercase">Nama Penerima</small>
          <h4 class="fw-bold">{{ strtoupper($hasil->nama) }}</h4>
        </div>
        <div class="col-md-6 mb-3 text-md-end">
          <small class="text-muted d-block mb-1 text-uppercase">Tahun Anggaran</small>
          <h4 class="fw-bold">{{ $hasil->tahun }}</h4>
        </div>
        <hr>
        <div class="col-md-6">
          <p class="mb-1 text-muted">Nomor KK (Disamarkan):</p>
          <p class="fw-semibold">{{ substr($hasil->kk, 0, 6) }}**********</p>

          <p class="mb-1 text-muted">Alamat:</p>
          <p class="fw-semibold">{{ $hasil->alamat }}</p>
        </div>
        <div class="col-md-6 text-md-end">
          <p class="mb-2 text-muted">Status Saat Ini:</p>
          @if($hasil->status == 'cair')
            <span class="status-badge bg-success text-white">
                <i class="ti ti-check me-1"></i> CAIR
            </span>
            {{-- Di dalam bagian @if($hasil->status == 'cair') --}}
<div class="mt-4 p-3 border-top">
    @if($hasil->metode_pencairan)
        {{-- Jika sudah memilih --}}
        <div class="alert alert-success d-flex align-items-center mb-0">
            <i class="ti ti-circle-check fs-2 me-2"></i>
            <div>
                Metode pencairan terpilih: <strong>{{ strtoupper($hasil->metode_pencairan) }}</strong>
            </div>
        </div>
    @else
        {{-- Jika belum memilih --}}
        <h6 class="fw-bold mb-3 text-dark">
            <i class="ti ti-settings me-2"></i>Opsi Pencairan Dana:
        </h6>

        @if(session('success_metode'))
            <div class="alert alert-success py-2">{{ session('success_metode') }}</div>
        @endif

        <form action="{{ route('blt.pilih-metode') }}" method="POST">
            @csrf
            <input type="hidden" name="nik" value="{{ $hasil->nik }}">
            <div class="row g-2">
                <div class="col-6">
                    <input type="radio" class="btn-check" name="metode" id="opt_cash" value="cash" autocomplete="off" required>
                    <label class="btn btn-outline-success w-100 py-3 rounded-4 shadow-sm" for="opt_cash">
                        <i class="ti ti-cash d-block fs-1 mb-1"></i>
                        <span>Tunai (Cash)</span>
                    </label>
                </div>
                <div class="col-6">
                    <input type="radio" class="btn-check" name="metode" id="opt_bank" value="transfer" autocomplete="off">
                    <label class="btn btn-outline-primary w-100 py-3 rounded-4 shadow-sm" for="opt_bank">
                        <i class="ti ti-building-bank d-block fs-1 mb-1"></i>
                        <span>Transfer Bank</span>
                    </label>
                </div>
            </div>
            <button type="submit" class="btn btn-dark w-100 mt-3 rounded-3 fw-bold py-2">
                Konfirmasi Pilihan Metode
            </button>
        </form>
    @endif
</div>
          @else
            <span class="status-badge bg-secondary text-white">
                {{ strtoupper($hasil->status) }}
            </span>
          @endif
        </div>
      </div>
    </div>
    @else
    <div class="alert alert-danger border-0 shadow-sm p-4 rounded-4">
        <div class="d-flex">
            <i class="ti ti-user-x fs-1 me-3"></i>
            <div>
                <h5 class="fw-bold">Data Tidak Ditemukan</h5>
                <p class="mb-0">NIK <strong>{{ request('nik') }}</strong> tidak terdaftar sebagai penerima BLT tahun {{ date('Y') }}. Silakan hubungi operator desa jika menurut Anda ini adalah kesalahan.</p>
            </div>
        </div>
    </div>
    @endif
  </div>
  @endif
</div>
@endsection
