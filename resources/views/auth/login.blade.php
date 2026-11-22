@extends('layouts.app')

@section('auth')
<style>
/* ===============================
   AUTH BACKGROUND – UMKM STYLE
================================ */

.auth-bg {
    min-height: 100vh;
    background: linear-gradient(135deg, #6fcf97, #a8e6c3);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    position: relative;
    overflow: hidden;
}

/* layer animasi cahaya */
.auth-bg::before {
    content: '';
    position: absolute;
    inset: -40%;
    background:
        radial-gradient(circle at 30% 30%, #f7f796, transparent 40%),
        radial-gradient(circle at 70% 70%, rgba(255,255,255,.25), transparent 45%);
    animation: authFloat 22s linear infinite;
    z-index: 0;
}

/* animasi muter infinity */
@keyframes authFloat {
    0% {
        transform: rotate(0deg) scale(1);
    }
    50% {
        transform: rotate(180deg) scale(1.05);
    }
    100% {
        transform: rotate(360deg) scale(1);
    }
}

/* pastikan card di atas background */
.auth-bg > div {
    position: relative;
    z-index: 1;
}

/* ===============================
   CARD ENHANCEMENT (opsional tapi cakep)
================================ */

.card {
    border-radius: 20px;
    animation: fadeUp 0.8s ease forwards;
}

@keyframes fadeUp {
    from {
        opacity: 0;
        transform: translateY(30px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

/* tombol login biar nyatu sama UMKM */
.btn-primary {
    background: linear-gradient(135deg, #6fcf97, #f7f796);
    border: none;
    box-shadow: 0 6px 18px rgba(111,207,151,.45);
}

.btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(111,207,151,.6);
}
</style>


<div class="auth-bg w-100">
    <div class="col-12 col-sm-10 col-md-8 col-lg-5 col-xxl-4 mx-auto">
        <div class="card shadow-lg border-0 rounded-lg overflow-hidden">

            {{-- BAGIAN HEADER KARTU --}}
            <div class="card-header border-0 text-center py-4 bg-light">
                <a href="/" class="d-inline-block">
                    <img src="{{ isset($logo) && $logo->logo ? asset('storage/' . $logo->logo) : asset('assets/img/logo.png') }}" style="max-height: 110px; width: auto; object-fit: contain;" alt="Logo Desa">
                </a>
                <h3 class="fw-bold mt-3 mb-0">{{ $nm_desa ?? 'Desa Kertamukti' }}</h3>
                <p class="text-muted mb-0">Silakan login untuk melanjutkan</p>
            </div>

            {{-- BAGIAN BODY KARTU --}}
            <div class="card-body p-4 p-sm-5">

                @if (session('password-success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="bi bi-check-circle-fill me-2"></i>
                        {{ session('password-success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                @error('email')
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        {{ $message }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @enderror

                {{-- FORM LOGIN --}}
                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="form-floating mb-3">
                        <input type="email"
                            class="form-control @error('email') is-invalid @enderror"
                            id="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            placeholder="Email">
                        <label for="email">Alamat Email</label>
                    </div>

                    <div class="form-floating mb-4">
                        <input type="password"
                            class="form-control"
                            id="password"
                            name="password"
                            required
                            placeholder="Password">
                        <label for="password">Password</label>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">
                                Ingat saya
                            </label>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary btn-lg fw-bold">
                            Login
                        </button>
                    </div>
                </form>

                <hr class="my-4">

                <div class="text-center">
                    <p class="mb-0 small mt-2">
                        atau kembali ke
                        <a href="/" class="fw-bold text-primary">Halaman Utama</a>
                    </p>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
