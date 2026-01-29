@extends('layouts.main')
@section('content')
<style>
  /* Hero Section */
  .hero-section {
    background: linear-gradient(135deg, #6fcf97 0%, #6fcf97 100%);
    color: white;
    padding: 4rem 0;
    margin-bottom: 3rem;
    border-radius: 0 0 50px 0;
    position: relative;
    overflow: hidden;
  }
  .hero-section::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 150%;
    height: 150%;
    background: radial-gradient(circle, rgba(247, 247, 150, 1) 0%, transparent 70%);
    animation: float 20s infinite linear;
  }
  @keyframes float {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  /* Main Container */
  .main-container {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
    margin: -3rem auto 3rem;
    position: relative;
    z-index: 1;
  }

  /* Section Title */
  .section-title {
    text-align: center;
    padding: 3rem 0 2rem;
    position: relative;
  }
  .section-title h2 {
    font-size: 3rem;
    font-weight: 700;
    color: #6fcf97;
    margin: 0;
    position: relative;
    display: inline-block;
  }
  .section-title h2::after {
    content: '';
    position: absolute;
    bottom: -15px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, #6fcf97, #F7F796);
    border-radius: 2px;
  }
  .section-subtitle {
    font-size: 1.2rem;
    color: #6c757d;
    margin-top: 1rem;
  }

  /* Visi Misi Grid */
  .visi-misi-container {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(500px, 1fr));
    gap: 3rem;
    padding: 3rem;
  }

  /* Card Styles */
  .vision-mission-card {
    background: white;
    border-radius: 20px;
    padding: 3rem;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
    transition: transform .3s ease, box-shadow .3s ease;
    position: relative;
    /* FIX: biarkan kartu setinggi konten, jangan potong isi */
    /* overflow: hidden;  -- removed */
    /* height: 100%;      -- removed */
    min-height: 220px; /* tampil tetap proporsional saat konten pendek */
    display: flex;
    flex-direction: column;
  }
  .vision-mission-card::before {
    content: '';
    position: absolute;
    top: 0; left: 0; right: 0;
    height: 5px;
    background: linear-gradient(90deg, #6fcf97, #F7F796);
    transform: scaleX(0);
    transition: transform 0.3s ease;
  }
  .vision-mission-card:hover::before { transform: scaleX(1); }
  .vision-mission-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 50px rgba(111, 207, 151, 0.35); /* lebih soft */
  }

  /* Card Header */
  .card-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 2rem;
  }
  .card-icon {
    width: 60px; height: 60px; border-radius: 20px;
    background: linear-gradient(135deg, #6fcf97, #F7F796);
    display: flex; align-items: center; justify-content: center;
    color: white; font-size: 1.5rem;
    box-shadow: 0 10px 25px rgba(111, 207, 151, 0.5);
    transition: transform .3s ease;
  }
  .vision-mission-card:hover .card-icon { transform: scale(1.1) rotate(5deg); }
  .card-title {
    font-size: 1.8rem; font-weight: 700; color: #6fcf97; margin: 0;
    transition: color .3s ease;
  }

  /* Card Content (tidak dibatasi tinggi) */
  .card-content { flex: 1 1 auto; }
  .card-text {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #413e3e;
    margin-bottom: 2rem;
    /* FIX: amankan konten dinamis dari DB */
    overflow: visible;
    word-wrap: break-word;
    overflow-wrap: anywhere;
  }
  /* Konten kaya dari editor */
  .card-text img { max-width: 100%; height: auto; display: block; border-radius: 10px; }
  .card-text table { width: 100%; border-collapse: collapse; margin: 1rem 0; }
  .card-text table td, .card-text table th { border: 1px solid #e9ecef; padding: .5rem .75rem; vertical-align: top; }
  .card-text ul, .card-text ol { padding-left: 1.25rem; margin: .5rem 0 1rem; }
  .card-text h1, .card-text h2, .card-text h3 { line-height: 1.3; margin-top: 1rem; }
  .card-text pre, .card-text code { white-space: pre-wrap; word-wrap: break-word; }

  /* Card Footer */
  .card-footer {
    display: flex; align-items: center; gap: 1rem;
    padding-top: 1.5rem;
    border-top: 1px solid #e9ecef; /* lebih netral agar tak kontras */
  }
  .card-meta {
    display: flex; align-items: center; gap: .5rem;
    color: #333030; font-size: .9rem;
  }
  .card-meta i { color: #696363; }

  /* Badge */
  .card-badge {
    background: linear-gradient(45deg, #6fcf97, rgba(247, 247, 150, 1));
    color: #212529;
    padding: .4rem 1rem; border-radius: 20px;
    font-size: .8rem; font-weight: 700;
    box-shadow: 0 5px 15px rgba(111, 207, 151, 0.35);
    margin-left: auto; /* dorong ke kanan */
  }

  /* Empty State */
  .empty-state {
    text-align: center; padding: 4rem 2rem;
    background: #f8f9fa;
    border-radius: 20px; color: #6c757d;
    border: 1px dashed #e9ecef;
  }
  .empty-state i { font-size: 3rem; color: #6fcf97; margin-bottom: 1rem; }
  .empty-state h4 { color: #212529; margin-bottom: 1rem; }

  /* Responsive */
  @media (max-width: 768px) {
    .visi-misi-container { grid-template-columns: 1fr; gap: 2rem; padding: 2rem; }
    .section-title h2 { font-size: 2rem; }
    .vision-mission-card { padding: 2rem; }
    .card-icon { width: 50px; height: 50px; font-size: 1.2rem; }
    .card-title { font-size: 1.5rem; }
  }
  /* --- FIX KARTU --- */
.vision-mission-card{
  height:auto;            /* biar ikut tinggi konten */
  overflow:hidden;        /* cegah konten “tembus” keluar */
  isolation:isolate;      /* bikin stacking context sendiri */
  z-index:0;
}

/* Hindari efek transform dobel dari JS + CSS */
.vision-mission-card { transition: transform .3s ease, box-shadow .3s ease; }
.vision-mission-card:hover { transform: translateY(-6px); }  /* kecilkan sedikit */

/* --- FIX KONTEN DINAMIS DARI DB --- */
.card-content{ flex:1 1 auto; min-width:0; } /* penting di grid supaya nggak melebar */
.card-text{
  max-width:100%;
  white-space:normal;
  word-break:break-word;
  overflow-wrap:anywhere;
}

/* Pastikan semua elemen di dalam konten tak melewati lebar kartu */
.card-text *{ max-width:100%; }
.card-text img{ display:block; height:auto; border-radius:10px; }
.card-text table{ width:100%; border-collapse:collapse; table-layout:fixed; }
.card-text th, .card-text td{ word-break:break-word; }

/* List rapi dan tidak “nyelonong” */
.card-text ol, .card-text ul{
  list-style-position:outside;
  padding-left:1.25rem;
  margin: .25rem 0 1rem;
}

/* --- GRID SAFETY (supaya kolom tak saling tumpang tindih) --- */
.visi-misi-container{
  grid-template-columns: repeat(auto-fit, minmax(420px, 1fr)); /* 500px bisa tabrakan di layar sempit */
  align-items:start;
  gap:2.5rem;
}
@media (max-width: 768px){
  .visi-misi-container{ grid-template-columns:1fr; }
}

  
</style>

<!-- Hero Section -->
<div class="hero-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <h1 class="display-4 fw-bold mb-4" data-aos="fade-right">
          <i class="ti ti-bulb me-3"></i>Visi & Misi Desa
        </h1>
        <p class="lead mb-0" data-aos="fade-right" data-aos-delay="100">
          Mengetahui visi dan misi yang menjadi pedoman dalam pembangunan desa. 
          Panduan strategis untuk mewujudkan desa yang lebih baik untuk masa depan.
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Main Content -->
<div class="main-container" data-aos="fade-up">
  <div class="section-title">
    <h2><i class="ti ti-target me-3"></i>Visi & Misi Desa</h2>
    <p class="section-subtitle">Pedoman Pembangunan Desa</p>
  </div>
  
  @if($visiMisi)
    <div class="visi-misi-container">
      <!-- Vision Card -->
      <div class="vision-mission-card" data-aos="fade-up" data-aos-delay="100">
        <div class="card-header">
          <div class="card-icon">
            <i class="ti ti-eye"></i>
          </div>
          <h3 class="card-title">Visi</h3>
        </div>
        
        <div class="card-content">
          <div class="card-text">
            {!! $visiMisi->visi !!}
          </div>
        </div>
        
        <div class="card-footer">
          <div class="card-meta">
            <i class="ti ti-calendar me-1"></i>
            <span>Diperbarui {{ $visiMisi->created_at->format('d F Y') }}</span>
          </div>
          <div class="card-badge">
            TUJUAN
          </div>
        </div>
      </div>
      
      <!-- Mission Card -->
      <div class="vision-mission-card" data-aos="fade-up" data-aos-delay="200">
        <div class="card-header">
          <div class="card-icon">
            <i class="ti ti-flag"></i>
          </div>
          <h3 class="card-title">Misi</h3>
        </div>
        
        <div class="card-content">
          <div class="card-text">
            {!! $visiMisi->misi !!}
          </div>
        </div>
        
        <div class="card-footer">
          <div class="card-meta">
            <i class="ti ti-refresh me-1"></i>
            <span>Diperbarui {{ $visiMisi->updated_at->format('d F Y') }}</span>
          </div>
          <div class="card-badge">
            AKSI
          </div>
        </div>
      </div>
    </div>
  @else
    <div class="empty-state" data-aos="fade-up">
      <i class="ti ti-target-off"></i>
      <h4>Belum ada data Visi & Misi</h4>
      <p>Visi dan misi desa belum ditetapkan. Silakan tambahkan data visi dan misi untuk menjadi pedoman pembangunan.</p>
      <a href="{{ route('visi-misi.create') }}" class="btn btn-primary">
        <i class="ti ti-plus me-2"></i>Tambah Visi & Misi
      </a>
    </div>
  @endif
</div>
@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
  // Initialize AOS
  AOS.init({
    duration: 800,
    easing: 'ease-in-out',
    once: true
  });

  // Add hover effects to cards
  const cards = document.querySelectorAll('.vision-mission-card');
  

  // Add rotation effect to icons on hover
  const icons = document.querySelectorAll('.card-icon');
  icons.forEach(icon => {
    icon.addEventListener('mouseenter', function() {
      this.style.transform = 'scale(1.1) rotate(5deg)';
    });
    
    icon.addEventListener('mouseleave', function() {
      this.style.transform = 'scale(1) rotate(0deg)';
    });
  });
});
</script>
@endpush

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"/>
@endpush