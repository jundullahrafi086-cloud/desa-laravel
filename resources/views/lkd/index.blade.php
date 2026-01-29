@extends('layouts.main')
@section('title','Lembaga Kemasyarakatan Desa (LKD)')
@section('content')
@php
  // Helper function untuk menampilkan foto (sesuai pola sebelumnya)
  function getPhotoUrl($path, $placeholder = 'https://via.placeholder.com/400x300?text=Cover+LKD') {
    return $path ? asset('storage/' . $path) : $placeholder;
  }
@endphp
<style>
  /* Hero Section - DIUBAH MENJADI HIJAU SEPERTI HALAMAN PENGUMUMAN */
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
  
  /* Main Container - DITAMBAHKAN */
  .main-container {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 40px rgba(111, 207, 151, 0.2);
    margin: -3rem auto 3rem;
    position: relative;
    z-index: 1;
    padding: 2rem 0;
  }
  
  /* Section Title - DITAMBAHKAN */
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
    background: linear-gradient(90deg, #6fcf97, rgba(247, 247, 150, 1));
    border-radius: 2px;
  }
  
  .section-subtitle {
    font-size: 1.2rem;
    color: #6fcf97;
    margin-top: 1rem;
  }
  
  /* Card Styles - DIUBAH MENGGUNAKAN STYLE DARI HALAMAN PENGUMUMAN */
  .lkd-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(169, 184, 255, 0.2);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
    border: none;
  }
  
  .lkd-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, #6fcf97, rgba(247, 247, 150, 1));
    transform: scaleX(0);
    transition: transform 0.3s ease;
  }
  
  .lkd-card:hover::before {
    transform: scaleX(1);
  }
  
  .lkd-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 50px rgba(111, 207, 151, 0.3);
  }
  
  .lkd-card .card-img-top {
    height: 220px;
    object-fit: cover;
    transition: transform 0.5s ease;
  }
  
  .lkd-card:hover .card-img-top {
    transform: scale(1.05);
  }
  
  .lkd-card .card-body {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
  }
  
  .lkd-card .card-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #6fcf97;
    margin-bottom: 0.75rem;
    transition: color 0.3s ease;
  }
  
  .lkd-card:hover .card-title {
    color: #5ab885;
  }
  
  .lkd-card .card-text {
    color: #495057;
    font-size: 1rem;
    line-height: 1.6;
    margin-bottom: 1rem;
    flex: 1;
  }
  
  .lkd-card .btn-primary {
    background: linear-gradient(135deg, #6fcf97, rgba(247, 247, 150, 1));
    border: none;
    border-radius: 25px;
    padding: 0.5rem 1.5rem;
    font-weight: 600;
    transition: all 0.3s ease;
    color: white;
  }
  
  .lkd-card .btn-primary:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 20px rgba(111, 207, 151, 0.3);
    background: linear-gradient(135deg, #5ab885, rgba(247, 247, 150, 1));
  }
  
  /* Badge Styles - DIUBAH WARNA NYA */
  .lkd-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(255, 255, 255, 0.9);
    backdrop-filter: blur(10px);
    color: #6fcf97;
    padding: 0.5rem 1rem;
    border-radius: 20px;
    font-size: 0.8rem;
    font-weight: 600;
    z-index: 2;
    box-shadow: 0 4px 15px rgba(111, 207, 151, 0.2);
  }
  
  .lkd-badge i {
    color: #6fcf97;
  }
  
  /* Empty State - DIUBAH WARNA NYA */
  .empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: rgba(111, 207, 151, 0.1);
    border-radius: 20px;
    color: #6fcf97;
    margin: 0 3rem 3rem;
  }
  
  .empty-state i {
    font-size: 4rem;
    color: #6fcf97;
    margin-bottom: 1rem;
  }
  
  .empty-state h4 {
    color: #6fcf97;
    margin-bottom: 1rem;
  }
  
  /* Pagination Styles - DIUBAH WARNA NYA */
  .pagination {
    margin-top: 3rem;
  }
  
  .page-link {
    border: 1px solid #6fcf97;
    color: #6fcf97;
    margin: 0 3px;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    transition: all 0.3s ease;
  }
  
  .page-item.active .page-link {
    background: linear-gradient(135deg, #6fcf97, rgba(247, 247, 150, 1));
    border-color: transparent;
    color: white;
  }
  
  .page-link:hover {
    background-color: rgba(111, 207, 151, 0.1);
    border-color: #6fcf97;
    color: #5ab885;
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(111, 207, 151, 0.3);
  }
  
  /* Stats Section - DIUBAH WARNA NYA */
  .stats-section {
    background: rgba(111, 207, 151, 0.1);
    padding: 3rem 0;
    margin-bottom: 3rem;
    border-radius: 20px;
  }
  
  .stat-card {
    background: white;
    padding: 2rem;
    border-radius: 15px;
    text-align: center;
    box-shadow: 0 5px 20px rgba(111, 207, 151, 0.1);
    transition: all 0.3s ease;
  }
  
  .stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(111, 207, 151, 0.2);
  }
  
  .stat-card i {
    font-size: 3rem;
    color: #6fcf97;
    margin-bottom: 1rem;
  }
  
  .stat-card h3 {
    font-size: 2rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.5rem;
  }
  
  /* Back to Top Button - DIUBAH WARNA NYA */
  #backToTop {
    background: linear-gradient(135deg, #6fcf97, rgba(247, 247, 150, 1));
    border: none;
    border-radius: 50%;
    width: 50px;
    height: 50px;
    display: flex;
    align-items: center;
    justify-content: center;
    box-shadow: 0 10px 25px rgba(111, 207, 151, 0.3);
  }
  
  #backToTop:hover {
    background: linear-gradient(135deg, #5ab885, rgba(247, 247, 150, 1));
    transform: translateY(-3px);
  }
  
  /* Responsive - DITAMBAHKAN */
  @media (max-width: 768px) {
    .section-title h2 {
      font-size: 2rem;
    }
    
    .lkd-card .card-title {
      font-size: 1.3rem;
    }
    
    .stats-section {
      padding: 2rem 0;
    }
    
    .stat-card {
      padding: 1.5rem;
      margin-bottom: 1rem;
    }
  }
</style>
<!-- Hero Section -->
<div class="hero-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <h1 class="display-4 fw-bold mb-4" data-aos="fade-right">
          <i class="ti ti-building me-3"></i>Lembaga Kemasyarakatan Desa
        </h1>
        <p class="lead mb-0" data-aos="fade-right" data-aos-delay="100">
          Mengenal lebih dekat berbagai lembaga kemasyarakatan yang aktif di desa kami. 
          Dari BPD hingga PKK, semua bekerja sama untuk membangun desa yang lebih baik.
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Stats Section -->
<div class="stats-section" data-aos="fade-up">
  <div class="container">
    <div class="row g-4">
      <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
        <div class="stat-card">
          <i class="ti ti-building"></i>
          <h3>{{ $items->total() }}</h3>
          <p>Total LKD</p>
        </div>
      </div>
      <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
        <div class="stat-card">
          <i class="ti ti-users"></i>
          <h3>{{ App\Models\LkdMember::count() }}</h3>
          <p>Total Anggota</p>
        </div>
      </div>
      <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
        <div class="stat-card">
          <i class="ti ti-check"></i>
          <h3>{{ App\Models\Lkd::where('published', true)->count() }}</h3>
          <p>LKD Aktif</p>
        </div>
      </div>
      <div class="col-md-3" data-aos="fade-up" data-aos-delay="400">
        <div class="stat-card">
          <i class="ti ti-calendar"></i>
          <h3>{{ \Carbon\Carbon::now()->format('Y') }}</h3>
          <p>Tahun Aktif</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Main Content -->
<div class="main-container" data-aos="fade-up">
  <div class="section-title">
    <h2><i class="ti ti-building me-3"></i>Daftar LKD Aktif</h2>
    <p class="section-subtitle">Lembaga Kemasyarakatan Desa</p>
  </div>
  
  <div class="container" id="lkd-list">
    <div class="row g-4">
      @forelse($items as $lkd)
        <div class="col-md-6 col-lg-4" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
          <div class="lkd-card">
            <!-- Badge Status -->
            <span class="lkd-badge">
              <i class="ti ti-circle-filled me-1"></i>{{ $lkd->published ? 'Aktif' : 'Draft' }}
            </span>
            
            <!-- Cover Image -->
            @if($lkd->cover_path)
              <img src="{{ getPhotoUrl($lkd->cover_path, 'https://via.placeholder.com/400x300?text=Cover+LKD') }}" 
                   class="card-img-top" 
                   alt="{{ $lkd->judul }}">
            @else
              <div class="card-img-top bg-light d-flex align-items-center justify-content-center">
                <i class="ti ti-photo-off" style="font-size: 3rem; color: #dee2e6;"></i>
              </div>
            @endif
            
            <!-- Card Body -->
            <div class="card-body">
              <h5 class="card-title">{{ $lkd->judul }}</h5>
              <p class="card-text">
                {{ \Illuminate\Support\Str::limit(strip_tags($lkd->deskripsi), 120) }}
              </p>
              
              <!-- Meta Info -->
              <div class="d-flex justify-content-between align-items-center mb-3">
                <span class="text-muted small">
                  <i class="ti ti-users me-1"></i>
                  {{ $lkd->members()->count() }} Anggota
                </span>
                <span class="text-muted small">
                  <i class="ti ti-calendar me-1"></i>
                  {{ optional($lkd->updated_at)->format('d M Y') }}
                </span>
              </div>
              
              <!-- Action Button -->
              <a href="{{ route('lkd.show',$lkd) }}" class="btn btn-primary w-100">
                <i class="ti ti-eye me-2"></i>Lihat Detail
              </a>
            </div>
          </div>
        </div>
      @empty
        <div class="col-12">
          <div class="empty-state" data-aos="fade-up">
            <i class="ti ti-building-community"></i>
            <h4>Belum ada data LKD</h4>
            <p>Data lembaga kemasyarakatan desa belum tersedia.</p>
            <a href="{{ route('home') }}" class="btn btn-primary">
              <i class="ti ti-home me-2"></i>Kembali ke Beranda
            </a>
          </div>
        </div>
      @endforelse
    </div>
    
    <!-- Pagination -->
    @if($items->hasPages())
      <div class="d-flex justify-content-center" data-aos="fade-up" data-aos-delay="200">
        {{ $items->links() }}
      </div>
    @endif
  </div>
</div>

<!-- Back to Top Button -->
<button id="backToTop" class="btn btn-primary btn-lg position-fixed bottom-0 end-0 m-3" style="display: none;">
  <i class="ti ti-arrow-up"></i>
</button>
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
  
  // Back to top button
  const backToTopButton = document.getElementById('backToTop');
  
  window.addEventListener('scroll', function() {
    if (window.pageYOffset > 300) {
      backToTopButton.style.display = 'block';
    } else {
      backToTopButton.style.display = 'none';
    }
  });
  
  backToTopButton.addEventListener('click', function() {
    window.scrollTo({
      top: 0,
      behavior: 'smooth'
    });
  });
  
  // Add hover effect to cards
  const cards = document.querySelectorAll('.lkd-card');
  cards.forEach(card => {
    card.addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-10px)';
    });
    
    card.addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(0)';
    });
  });
});
</script>
@endpush
@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/iconfont/tabler-icons.min.css">
@endpush