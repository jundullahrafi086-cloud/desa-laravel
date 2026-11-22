@extends('layouts.main')
@section('content')
<style>
  /* Hero Section */
  .hero-section {
    background: linear-gradient(135deg,  #6fcf97 0%, #6fcf97 100%);
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
    background: radial-gradient(circle,rgba(247, 247, 150, 1) 0%, transparent 70%);
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
    box-shadow: 0 20px 40px  #6fcf97 ;
    margin: -3rem auto 3rem;
    position: relative;
    z-index: 1;
    padding: 2rem 0;
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
    color: #6fcf97; /* Judul jadi hijau */
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
    color:  #6fcf97;
    margin-top: 1rem;
  }
  
  /* Pengumuman Container */
  .pengumuman-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(min(100%, 330px), 1fr));
    gap: 2rem;
    padding: 0 3rem 3rem;
  }
  
  /* Card Styles */
  .pengumuman-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 15px 35px  #a9b8afff ;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
  }
  
  .pengumuman-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, #6fcf97);
    transform: scaleX(0);
    transition: transform 0.3s ease;
  }
  
  .pengumuman-card:hover::before {
    transform: scaleX(1);
  }
  
  .pengumuman-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 50px #6fcf97;
  }
  
  /* Card Content */
  .card-content {
    padding: 1.5rem;
    flex: 1;
    display: flex;
    flex-direction: column;
  }
  
  .card-header {
    display: flex;
    align-items: center;
    gap: 1rem;
    margin-bottom: 1rem;
  }
  
  .card-icon {
    width: 50px;
    height: 50px;
    border-radius: 15px;
    background: linear-gradient(135deg, #6fcf97, rgba(247, 247, 150, 1));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.3rem;
    box-shadow: 0 10px 25px #6fcf97;
    transition: all 0.3s ease;
  }
  
  .pengumuman-card:hover .card-icon {
    transform: scale(1.1) rotate(5deg);
  }
  
  .card-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0;
    transition: color 0.3s ease;
  }
  
  .pengumuman-card:hover .card-title {
    color: #6fcf97;
  }
  
  .card-meta {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #6c757d;
    font-size: 0.9rem;
    margin-bottom: 1rem;
  }
  
  .card-meta i {
    color:  #6fcf97;
  }
  
  .card-text {
    font-size: 1rem;
    line-height: 1.6;
    color: #495057;
    flex: 1;
  }
  
  .card-text p {
    margin: 0;
  }
  
  /* Card Footer */
  .card-footer {
    margin-top: 1rem;
    padding-top: 1rem;
    border-top: 1px solid  #6fcf97;
  }
  
  .read-more {
    color: #6fcf97;
    font-weight: 600;
    text-decoration: none;
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    transition: all 0.3s ease;
  }
  
  .read-more:hover {
    color: #6fcf97;
    gap: 0.8rem;
  }
  
  /* Empty State */
  .empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: #f8f9fa;
    border-radius: 20px;
    color:   #6c757d;
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
  
  .empty-state p {
    margin-bottom: 1.5rem;
  }
  
  /* Pagination */
  .pagination-container {
    padding: 0 3rem 3rem;
    display: flex;
    justify-content: center;
  }
  
  .pagination {
    display: flex;
    gap: 0.5rem;
  }
  
  .page-item .page-link {
    color:  #6fcf97;
    border: 1px solid  #6fcf97;
    border-radius: 10px;
    padding: 0.75rem 1rem;
    font-weight: 600;
    transition: all 0.3s ease;
  }
  
  .page-item.active .page-link {
    background: linear-gradient(135deg,  #6fcf97, rgba(247, 247, 150, 1));
    border-color: transparent;
    color: white;
  }
  
  .page-item .page-link:hover {
    background-color: rgba(111, 207, 151, 0.1);
    border-color: #6fcf97;
    color:  #6fcf97;
  }
  
  /* Pengumuman Count Info */
  .pengumuman-count-info {
    text-align: center;
    margin-bottom: 1.5rem;
    color: #6c757d;
    padding: 0 3rem;
  }
  
  /* Responsive */
  @media (max-width: 768px) {
    .pengumuman-container {
      grid-template-columns: 1fr;
      gap: 1.5rem;
      padding: 0 2rem 2rem;
    }
    
    .section-title h2 {
      font-size: 2rem;
    }
    
    .card-icon {
      width: 40px;
      height: 40px;
      font-size: 1.1rem;
    }
    
    .card-title {
      font-size: 1.3rem;
    }
    
    .pagination-container {
      padding: 0 2rem 2rem;
    }
    
    .pengumuman-count-info {
      padding: 0 2rem;
    }
  }
</style>

<!-- Hero Section -->
<div class="hero-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <h1 class="display-4 fw-bold mb-4" data-aos="fade-right">
          <i class="ti ti-bell-ringing me-3"></i>Pengumuman Desa
        </h1>
        <p class="lead mb-0" data-aos="fade-right" data-aos-delay="100">
          Informasi terbaru dan penting dari desa. Tetap update dengan berbagai pengumuman, 
          kegiatan, dan informasi layanan masyarakat yang disampaikan oleh pemerintah desa.
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Main Content -->
<div class="main-container" data-aos="fade-up">
  <div class="section-title">
    <h2><i class="ti ti-news me-3"></i>Pengumuman Terbaru</h2>
    <p class="section-subtitle">Informasi Penting dari Desa</p>
  </div>
  
  @if($pengumumans->count() > 0)
    <!-- Pengumuman Count Info -->
    <div class="pengumuman-count-info" data-aos="fade-up" data-aos-delay="100">
      <p>Menampilkan {{ $pengumumans->count() }} dari {{ $pengumumans->total() }} pengumuman</p>
    </div>
    
    <div class="pengumuman-container">
      @foreach ($pengumumans as $pengumuman)
        <div class="pengumuman-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
          <div class="card-content">
            <div class="card-header">
              <div class="card-icon">
                <i class="ti ti-bell"></i>
              </div>
              <h3 class="card-title">{{ $pengumuman->judul }}</h3>
            </div>
            
            <div class="card-meta">
              <i class="ti ti-calendar me-1"></i>
              <span>{{ $pengumuman->created_at?->format('d F Y') ?? 'Tanggal tidak tersedia' }}</span>
              <i class="ti ti-clock me-1 ms-3"></i>
              <span>{{ $pengumuman->created_at?->diffForHumans() ?? 'Baru saja' }}</span>
            </div>
            
            <div class="card-text">
              <p>{!! $pengumuman->excerpt !!}</p>
            </div>
            
            <div class="card-footer">
              <a href="{{ route('pengumuman.show', $pengumuman->slug) }}" class="read-more">
                Baca Selengkapnya <i class="ti ti-arrow-right"></i>
              </a>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    
    <div class="pagination-container">
      {{ $pengumumans->links() }}
    </div>
  @else
    <div class="empty-state" data-aos="fade-up">
      <i class="ti ti-bell-off"></i>
      <h4>Belum ada Pengumuman</h4>
      <p>Belum ada pengumuman yang dipublikasikan. Silakan periksa kembali beberapa saat lagi.</p>
      <a href="{{ route('home') }}" class="btn btn-primary">
        <i class="ti ti-home me-2"></i>Kembali ke Beranda
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
  const cards = document.querySelectorAll('.pengumuman-card');
  cards.forEach(card => {
    card.addEventListener('mouseenter', function() {
      this.style.transform = 'translateY(-10px)';
    });
    
    card.addEventListener('mouseleave', function() {
      this.style.transform = 'translateY(0)';
    });
  });
  
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
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/iconfont/tabler-icons.min.css">
@endpush