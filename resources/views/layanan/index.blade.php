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
    background: radial-gradient(circle, rgba(247, 247, 150, 1)  0%, transparent 70%);
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
    box-shadow: 0 20px 40px #6fcf97 ;
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
    color: #6fcf97 ;
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
    background: linear-gradient(90deg, #6fcf97 ,rgba(247, 247, 150, 1) );
    border-radius: 2px;
  }
  
  .section-subtitle {
    font-size: 1.2rem;
    color: #6c757d;
    margin-top: 1rem;
  }
  
  /* Layanan Container */
  .layanan-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(350px, 1fr));
    gap: 2rem;
    padding: 0 3rem 3rem;
  }
  
  /* Service Card */
  .service-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 15px 35px  #fcfcfcff;
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
  }
  
  .service-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg,  #6fcf97);
    transform: scaleX(0);
    transition: transform 0.3s ease;
  }
  
  .service-card:hover::before {
    transform: scaleX(1);
     box-shadow: 0 25px 50px   #6fcf97;
  }
  
  .service-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 50px   #6fcf97;
  }
  
  /* Accordion Styles - Using Bootstrap */
  .accordion {
    width: 100%;
  }
  
  .accordion-item {
    background: transparent;
    border: none;
    margin-bottom: 1rem;
    border-radius: 15px;
    overflow: hidden;
    box-shadow: 0 5px 15px  #6fcf97;
    transition: all 0.3s ease;
  }
  
  .accordion-item:hover {
    box-shadow: 0 10px 25px  #6fcf97 ,rgba(247, 247, 150, 1);
  }
  
  .accordion-header {
    padding: 0;
    background: transparent;
  }
  
  .accordion-button {
    background: white;
    color:  #6fcf97;
    font-weight: 700;
    font-size: 1.1rem;
    padding: 1.25rem 1.5rem;
    border: none;
    border-radius: 15px !important;
    box-shadow: none !important;
    display: flex;
    align-items: center;
    gap: 1rem;
    transition: all 0.3s ease;
  }
  
  .accordion-button:not(.collapsed) {
    background: linear-gradient(135deg,  #6fcf97 ,rgba(247, 247, 150, 1));
    color: white;
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2) !important;
  }
  
  .accordion-button:focus {
    box-shadow: none !important;
    outline: none !important;
  }
  
  .accordion-button::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23667eea'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    background-size: 1rem;
    width: 1rem;
    height: 1rem;
    transition: transform 0.3s ease;
  }
  
  .accordion-button:not(.collapsed)::after {
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23ffffff'%3e%3cpath fill-rule='evenodd' d='M7.646 4.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1-.708.708L8 5.707l-5.646 5.647a.5.5 0 1 1-.708-.708l6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
    transform: rotate(180deg);
  }
  
  .accordion-button:hover {
    background-color: rgba(102, 126, 234, 0.05);
  }
  
  .accordion-button:not(.collapsed):hover {
    background: linear-gradient(135deg  #6fcf97 ,rgba(247, 247, 150, 1));
  }
  
  .service-icon {
    width: 40px;
    height: 40px;
    border-radius: 12px;
    background: linear-gradient(135deg,  #6fcf97 ,rgba(247, 247, 150, 1));
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.2rem;
    box-shadow: 0 5px 15px  #6fcf97;
    transition: all 0.3s ease;
    flex-shrink: 0;
  }
  
  .accordion-button:not(.collapsed) .service-icon {
    background: rgba(255, 255, 255, 0.2);
  }
  
  .accordion-body {
    padding: 1.5rem;
    font-size: 1rem;
    line-height: 1.8;
    color: #495057;
  }
  
  .accordion-body p {
    margin-bottom: 1rem;
  }
  
  .accordion-body p:last-child {
    margin-bottom: 0;
  }
  
  .accordion-body ul, .accordion-body ol {
    padding-left: 1.5rem;
    margin: 1rem 0;
  }
  
  .accordion-body li {
    margin-bottom: 0.5rem;
  }
  
  /* Service Footer */
  .service-footer {
    padding: 1rem 1.5rem;
    border-top: 1px solid #f1f3f5;
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  
  .service-meta {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color:  #151a17ff;
    font-size: 0.85rem;
  }
  
  .service-meta i {
    color:  #6fcf97;
  }
  
  .service-link {
    color:  #0b0f0dff ;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9rem;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }
  
  .service-link:hover {
    color:   #6fcf97;
    gap: 0.8rem;
  }
  
  /* Empty State */
  .empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background: #f8f9fa;
    border-radius: 20px;
    color:  #212925ff;
    margin: 0 3rem 3rem;
  }
  
  .empty-state i {
    font-size: 4rem;
    color:  #101412ff;
    margin-bottom: 1rem;
  }
  
  .empty-state h4 {
    color:  #080a09ff;
    margin-bottom: 1rem;
  }
  
  .empty-state p {
    margin-bottom: 1.5rem;
  }
  
  /* Responsive */
  @media (max-width: 768px) {
    .layanan-container {
      grid-template-columns: 1fr;
      gap: 1.5rem;
      padding: 0 2rem 2rem;
    }
    
    .section-title h2 {
      font-size: 2rem;
    }
    
    .accordion-button {
      font-size: 1rem;
      padding: 1rem 1.25rem;
    }
    
    .service-icon {
      width: 36px;
      height: 36px;
      font-size: 1.1rem;
    }
    
    .accordion-body {
      padding: 1.25rem;
    }
  }
</style>

<!-- Hero Section -->
<div class="hero-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <h1 class="display-4 fw-bold mb-4" data-aos="fade-right">
          <i class="ti ti-service me-3"></i>Layanan Desa
        </h1>
        <p class="lead mb-0" data-aos="fade-right" data-aos-delay="100">
          Informasi lengkap tentang berbagai layanan yang tersedia di desa. 
          Temukan persyaratan dan prosedur untuk setiap layanan yang Anda butuhkan.
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Main Content -->
<div class="main-container" data-aos="fade-up">
  <div class="section-title">
    <h2><i class="ti ti-list-details me-3"></i>Daftar Layanan</h2>
    <p class="section-subtitle">Persyaratan dan Prosedur Layanan Desa</p>
  </div>
  
  @if($layanans->count() > 0)
    <div class="layanan-container">
      @foreach ($layanans as $layanan)
        <div class="service-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
          <div class="accordion" id="accordionExample{{ $layanan->id }}">
            <div class="accordion-item">
              <h2 class="accordion-header">
                <button class="accordion-button" type="button" data-bs-toggle="collapse" 
                        data-bs-target="#collapse{{ $layanan->id }}" aria-expanded="true" 
                        aria-controls="collapse{{ $layanan->id }}">
                  <div class="service-icon">
                    <i class="ti ti-file-text"></i>
                  </div>
                  {{ $layanan->layanan }}
                </button>
              </h2>
              <div id="collapse{{ $layanan->id }}" class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}" 
                   data-bs-parent="#accordionExample{{ $layanan->id }}">
                <div class="accordion-body">
                  {!! $layanan->persyaratan !!}
                </div>
                <div class="service-footer">
                  <div class="service-meta">
                    <i class="ti ti-calendar me-1"></i>
                    <span>Diperbarui {{ $layanan->updated_at?->format('d F Y') ?? 'Tanggal tidak tersedia' }}</span>
                  </div>
                  <a href="/layanan/{{ $layanan->slug }}" class="service-link">
                    <span>Detail</span>
                    <i class="ti ti-arrow-right"></i>
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
  @else
    <div class="empty-state" data-aos="fade-up">
      <i class="ti ti-service-off"></i>
      <h4>Belum ada Layanan</h4>
      <p>Belum ada informasi layanan yang tersedia. Silakan periksa kembali beberapa saat lagi.</p>
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
  const cards = document.querySelectorAll('.service-card');
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
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/iconfont/tabler-icons.min.css">
@endpush>