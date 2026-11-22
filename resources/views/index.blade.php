@extends('layouts.main')
@section('content')
<style>
  /* ====== Palette ====== */
  :root {
    --green: #11998e;                
    --green-soft: #6fcf97;           
    --yellow-soft: rgba(247,247,150,1); 
    --shadow: 0 10px 30px rgba(17, 153, 142, 0.12);
  }
  /* ===== Hero Section ===== */
  #hero {
    background: linear-gradient(135deg, var(--green-soft) 0%, var(--yellow-soft) 100%);
    position: relative;
    overflow: hidden;
    border-radius: 0 0 50px 0;
  }
  #hero::before {
    content: '';
    position: absolute;
    top: -50%; right: -50%;
    width: 200%; height: 200%;
    background: radial-gradient(circle, var(--yellow-soft) 0%, transparent 70%);
    animation: float 20s infinite linear;
    z-index: 1;
  }
  @keyframes float { 0%{transform:rotate(0)} 100%{transform:rotate(360deg)} }
  .hero-container { position: relative; z-index: 2; }
  .carousel-item {
    position: relative; height: 70vh; background-size: cover; background-position: center;
  }
  .carousel-item::before {
    content: ''; position: absolute; inset: 0;
    background: rgba(0,0,0,.25); z-index: 1;
  }
  .carousel-container { position: relative; z-index: 2; height: 100%; display: flex; align-items: center; }
  .carousel-content h2 { font-size: 3rem; font-weight: 700; color: #fff; text-shadow: 0 2px 10px rgba(0,0,0,.3); margin-bottom: 1rem; }
  .carousel-content p { font-size: 1.2rem; color: #f8fafc; margin-bottom: 2rem; max-width: 680px; }
  .btn-get-started {
    background: linear-gradient(135deg, var(--green-soft) 0%, var(--yellow-soft) 100%);
    color: #fff; border: none; border-radius: 50px; padding: .75rem 2rem; font-weight: 600;
    transition: all .3s ease; box-shadow: 0 5px 15px rgba(25,135,84,.25);
    display: inline-block; text-decoration: none;
  }
  .btn-get-started:hover { transform: translateY(-3px); box-shadow: 0 8px 20px  #6fcf97; }
  .carousel-control-prev, .carousel-control-next { z-index: 3; width: 5%; }
  .carousel-control-prev-icon, .carousel-control-next-icon {
    background-color: var(--green-soft); border-radius: 50%; width: 40px; height: 40px;
  }
  .carousel-control-prev:hover .carousel-control-prev-icon,
  .carousel-control-next:hover .carousel-control-next-icon { background-color: var(--green); }
  /* ===== Services Section ===== */
  .services { padding: 4rem 0; background: #f8f9fa; }
  .icon-box {
    background: #fff; border-radius: 20px; box-shadow: var(--shadow);
    padding: 2rem; text-align: center; transition: all .3s ease;
    height: 100%; position: relative; overflow: hidden;
  }
  .icon-box::before {
    content: ''; position: absolute; left: 0; right: 0; top: 0; height: 5px;
    background: linear-gradient(90deg, var(--green-soft) 0%, var(--yellow-soft) 100%);
    transform: scaleX(0); transition: transform .3s ease; transform-origin: left;
  }
  .icon-box:hover { transform: translateY(-10px); box-shadow: 0 25px 50px rgba(25,135,84,.18); }
  .icon-box:hover::before { transform: scaleX(1); }
  .icon-box .icon {
    width: 80px; height: 80px; border-radius: 20px;
    background: linear-gradient(135deg, var(--green-soft) 0%, var(--yellow-soft) 100%);
    display: flex; align-items: center; justify-content: center; color: #fff;
    font-size: 2rem; margin: 0 auto 1.25rem;
    box-shadow: 0 10px 25px  #6fcf97; transition: all .3s ease;
  }
  .icon-box:hover .icon { transform: scale(1.1) rotate(5deg); }
  .icon-box .title {
    font-size: 1.25rem; font-weight: 700; color: var(--green);
    margin: 0; transition: color .3s ease;
  }
  .icon-box:hover .title { color: var(--green-soft); }
  .icon-box a, .icon-box a h4 { color: var(--green) !important; text-decoration: none; }
  /* ===== Video Section ===== */
  #video { padding: 4rem 0; background: #fff; }
  #video .section-title { margin-bottom: 3rem; text-align: center; }
  #video .section-title h2 {
    font-size: 3rem; font-weight: 700; color: var(--green);
    position: relative; display: inline-block;
  }
  #video .section-title h2::after {
    content: ''; position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%);
    width: 90px; height: 5px; border-radius: 3px;
    background: linear-gradient(90deg, var(--green) 0%, var(--green-soft) 50%, var(--yellow-soft) 100%);
  }
  #video iframe { border-radius: 20px; box-shadow: var(--shadow); transition: all .3s ease; }
  #video iframe:hover { transform: translateY(-5px); box-shadow: 0 20px 40px rgba(0,0,0,.15); }
  /* ===== News Section ===== */
  .counts { padding: 4rem 0; background: #f8f9fa; }
  .counts .section-title { margin-bottom: 3rem; text-align: center; }
  .counts .section-title h2 {
    font-size: 3rem; font-weight: 700; color: var(--green);
    position: relative; display: inline-block;
  }
  .counts .section-title h2::after {
    content: ''; position: absolute; bottom: -15px; left: 50%; transform: translateX(-50%);
    width: 90px; height: 5px; border-radius: 3px;
    background: linear-gradient(90deg, var(--green) 0%, var(--green-soft) 50%, var(--yellow-soft) 100%);
  }
  .news-card {
    background: #fff; border-radius: 20px; box-shadow: var(--shadow);
    overflow: hidden; transition: all .3s ease; height: 100%; position: relative;
  }
  .news-card::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 5px;
    background: linear-gradient(90deg, var(--green-soft) 0%, var(--yellow-soft) 100%);
    transform: scaleX(0); transition: transform .3s ease; transform-origin: left;
  }
  .news-card:hover { transform: translateY(-10px); box-shadow: 0 25px 50px  #6fcf97; }
  .news-card:hover::before { transform: scaleX(1); }
  .news-card .card-img-top { height: 200px; object-fit: cover; transition: transform .5s ease; }
  .news-card:hover .card-img-top { transform: scale(1.05); }
  /* === Perubahan judul berita jadi hitam (tanpa ubah yang lain) === */
  .news-card .card-title { 
    font-size: 1.15rem; 
    font-weight: 700; 
    color: #000;            /* hitam */
    margin: 0 0 .75rem 0; 
    transition: color .3s ease; 
  }
  .news-card:hover .card-title { color: var(--green); } /* hijau saat hover */
  /* perbaikan kecil: tambah ';' yang hilang */
  .news-card .card-text { color: #000000ff; margin-bottom: 1rem; }
  .news-date { font-size: .95rem; color: var(--green); display: flex; align-items: center; gap: .5rem; margin-bottom: 1rem; }
  .news-date i { color: var(--green); }
  .news-card .card-footer { background: transparent; border-top: 1px solid #e9ecef; padding-top: 1rem; }
  .news-card .btn-link {
    color: var(--green); font-weight: 600; text-decoration: none;
    display: inline-flex; align-items: center; gap: .5rem; transition: all .3s ease;
  }
  .news-card .btn-link:hover { color: var(--green-soft); transform: translateX(5px); }
  /* Button See All */
  .button .btn-primary {
    background: linear-gradient(135deg, var(--green) 0%, var(--green-soft) 60%, var(--yellow-soft) 100%);
    color: #fff; border: none; border-radius: 50px; padding: .75rem 2rem; font-weight: 600;
    transition: all .3s ease; box-shadow: 0 5px 15px rgba(25,135,84,.25);
    display: inline-flex; align-items: center; gap: .5rem;
  }
  .button .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 8px 20px  #6fcf97; }
  /* UMKM Card Styles */
  .umkm-card {
    background: #fff; border-radius: 20px; box-shadow: var(--shadow);
    overflow: hidden; transition: all .3s ease; height: 100%; position: relative;
  }
  .umkm-card::before {
    content: ''; position: absolute; top: 0; left: 0; right: 0; height: 5px;
    background: linear-gradient(90deg, var(--green-soft) 0%, var(--yellow-soft) 100%);
    transform: scaleX(0); transition: transform .3s ease; transform-origin: left;
  }
  .umkm-card:hover { transform: translateY(-10px); box-shadow: 0 25px 50px  #6fcf97; }
  .umkm-card:hover::before { transform: scaleX(1); }
  .umkm-card .card-img-top { height: 200px; object-fit: cover; transition: transform .5s ease; }
  .umkm-card:hover .card-img-top { transform: scale(1.05); }
  .umkm-card .card-title { 
    font-size: 1.15rem; 
    font-weight: 700; 
    color: #000;            
    margin: 0 0 .75rem 0; 
    transition: color .3s ease; 
  }
  .umkm-card:hover .card-title { color: var(--green); }
  .umkm-card .card-text { color: #000000ff; margin-bottom: 1rem; }
  .umkm-price {
    font-size: 1.2rem;
    font-weight: 700;
    color: var(--green);
    margin-bottom: 1rem;
  }
  .umkm-card .card-footer { background: transparent; border-top: 1px solid #e9ecef; padding-top: 1rem; }
  .umkm-card .btn-link {
    color: var(--green); font-weight: 600; text-decoration: none;
    display: inline-flex; align-items: center; gap: .5rem; transition: all .3s ease;
  }
  .umkm-card .btn-link:hover { color: var(--green-soft); transform: translateX(5px); }
  /* Responsive */
  .video-responsive-wrapper {
    position: relative;
    width: 100%;
    padding-bottom: 56.25%;
    height: 0;
    overflow: hidden;
    border-radius: 20px;
    box-shadow: var(--shadow);
  }
  .video-responsive-wrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: 0;
  }
  .news-card .card, .umkm-card .card {
    border: none;
    border-radius: 20px;
  }
  @media (max-width: 768px) {
    .carousel-item { height: 52vh; min-height: 320px; }
    .carousel-content h2 { font-size: 1.75rem; }
    .carousel-content p { font-size: 0.95rem; margin-bottom: 1.25rem; }
    .counts .section-title h2, #video .section-title h2 { font-size: 2rem; }
    .services, .counts, #video { padding: 2.5rem 0; }
  }
</style>
<section id="hero">
  <div class="hero-container">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
      <div class="carousel-inner" role="listbox">
        @foreach ($sliders as $key => $slider)
        <div class="carousel-item{{ $key === 0 ? ' active' : '' }}" style="background-image: url({{ asset('storage/' . $slider->img_slider) }});">
          <div class="carousel-container">
            <div class="carousel-content container">
              <h2 class="animate__animated animate__fadeInDown">{{ $slider->judul }}</h2>
              <p class="animate__animated animate__fadeInUp">{{ $slider->deskripsi }}</p>
            </div>
          </div>
        </div>
        @endforeach
      </div>
      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>
      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>
    </div>
  </div>
</section><!-- End Hero -->
<!-- ======= Services Section ======= -->
<section id="services" class="services">
  <div class="container" data-aos="fade-up">
    <div class="row g-3">
      <div class="col-lg-3 col-md-6">
        <a href="{{ url('data-desa') }}" class="text-decoration-none d-block h-100">
          <div class="icon-box h-100">
            <div class="icon"><i class="bi bi-bar-chart-line-fill"></i></div>
            <h4 class="title mb-0">Statistik</h4>
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-md-6">
        <a href="{{ url('peta-desa') }}" class="text-decoration-none d-block h-100">
          <div class="icon-box h-100">
            <div class="icon"><i class="bi bi-globe-asia-australia"></i></div>
            <h4 class="title mb-0">Peta Desa</h4>
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-md-6">
        <a href="{{ url('umkm') }}" class="text-decoration-none d-block h-100">
          <div class="icon-box h-100">
            <div class="icon"><i class="bi bi-shop"></i></div>
            <h4 class="title mb-0">UMKM Desa</h4>
          </div>
        </a>
      </div>
      <div class="col-lg-3 col-md-6">
        <a href="{{ url('kontak') }}" class="text-decoration-none d-block h-100">
          <div class="icon-box h-100">
            <div class="icon"><i class="bi bi-telephone-forward"></i></div>
            <h4 class="title mb-0">Pengaduan</h4>
          </div>
        </a>
      </div>
    </div>
  </div>
</section>
<!-- ======= Video Section ======= -->
@if($videoProfil && $videoProfil->url_video)
<section id="video" class="services">
  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <h2>Video Profil</h2>
    </div>
    <div class="row">
      <div class="col-lg-10 mx-auto">
        <div class="video-responsive-wrapper">
          <iframe src="{{ $videoProfil->url_video }}" frameborder="0" allowfullscreen loading="lazy"></iframe>
        </div>
      </div>
    </div>
  </div>
</section>
@endif
<!-- ======= News Section ======= -->
<section class="counts section-bg">
  <div class="container">
    <div class="section-title">
      <h2>Berita Desa</h2>
    </div>
    <div class="row">
      @foreach ($beritas as $berita)
      <div class="col-lg-4 col-md-6 mb-3">
        <div class="count-box news-card">
          <div class="card h-100">
            <img src="{{ asset('storage/' . $berita->gambar) }}" class="card-img-top" alt="Gambar Berita">
            <div class="card-body">
              <h5 class="card-title">{{ $berita->judul }}</h5>
              <p class="card-text">{{ $berita->excerpt }}</p>
              <div class="news-date"><i class="bi bi-calendar-event"></i> {{ $berita->created_at->diffForHumans() }}</div>
            </div>
            <div class="card-footer">
              <a href="/berita/{{ $berita->slug }}" class="btn btn-link float-end">Selengkapnya <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      <div class="button text-center">
        <a class="btn btn-primary" href="/berita"><i class="bi bi-newspaper"></i> Lihat Semua</a>
      </div>
    </div>
  </div>
</section>

<!-- ======= UMKM Section ======= -->
<section class="counts section-bg">
  <div class="container">
    <div class="section-title">
      <h2>UMKM Desa</h2>
    </div>
    <div class="row">
      @foreach ($umkms as $umkm)
      <div class="col-lg-4 col-md-6 mb-3">
        <div class="count-box umkm-card">
          <div class="card h-100">
            <img src="{{ $umkm->foto ? asset('storage/' . $umkm->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($umkm->produk) . '&background=random' }}" 
                 class="card-img-top" 
                 alt="{{ $umkm->produk }}"
                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($umkm->produk) }}&background=random'">
            <div class="card-body">
              <h5 class="card-title">{{ $umkm->produk }}</h5>
              <p class="card-text">{{ $umkm->excerpt }}</p>
              <div class="umkm-price">
                <i class="bi bi-currency-exchange"></i> Rp {{ number_format($umkm->harga, 0, ',', '.') }}
              </div>
              <div class="news-date">
                <i class="bi bi-person"></i> {{ $umkm->pemilik }}
              </div>
            </div>
            <div class="card-footer">
              <a href="https://wa.me/+62{{ $umkm->no_hp }}" target="_blank" class="btn btn-success btn-sm me-2">
                <i class="bi bi-whatsapp"></i> WhatsApp
              </a>
              <a href="/umkm/{{ $umkm->slug }}" class="btn btn-link float-end">Detail <i class="bi bi-arrow-right"></i></a>
            </div>
          </div>
        </div>
      </div>
      @endforeach
      <div class="button text-center">
        <a class="btn btn-primary" href="/umkm"><i class="bi bi-shop"></i> Lihat Semua</a>
      </div>
    </div>
  </div>
</section>
@endsection
@push('scripts')
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', () => {
    AOS.init({ duration: 650, easing: 'ease-out-cubic', offset: 80, mirror: true });
  });
</script>
@endpush
@push('styles')
<link href="https://unpkg.com/aos@2.3.4/dist/aos.css" rel="stylesheet"/>
@endpush