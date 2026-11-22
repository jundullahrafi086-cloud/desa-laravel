@extends('layouts.main')
@section('content')
<style>
  /* Hero Section */
  .hero-section {
    background: linear-gradient(135deg, #6fcf97,  #6fcf97);
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
    background: radial-gradient(circle, #f7f796 0%, transparent 70%);
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
    box-shadow: 0 20px 40px #6fcf97;
    margin: -3rem auto 3rem;
    position: relative;
    z-index: 1;
  }
  
  /* Breadcrumb */
  .breadcrumb-container {
    padding: 1.5rem 3rem;
    border-bottom: 1px solid #e9ecef;
  }
  
  .breadcrumb {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    margin: 0;
    padding: 0;
    list-style: none;
    background: transparent;
  }
  
  .breadcrumb-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }
  
  .breadcrumb-item a {
    color: #1b1c22ff;
    text-decoration: none;
    font-weight: 500;
    transition: color 0.3s ease;
  }
  
  .breadcrumb-item a:hover {
    color:  #6fcf97;
  }
  
  .breadcrumb-item.active {
    color: #6c757d;
  }
  
  .breadcrumb-item+.breadcrumb-item::before {
    content: "›";
    color: #dee2e6;
    font-size: 1.2rem;
    margin-right: 0.5rem;
  }
  
  /* Product Header */
  .product-header {
    padding: 3rem;
    border-bottom: 1px solid #e9ecef;
  }
  
  .product-title {
    font-size: 2.5rem;
    font-weight: 700;
    color:  #6fcf97;
    margin-bottom: 1.5rem;
    line-height: 1.2;
  }
  
  /* Product Content */
  .product-content {
    padding: 3rem;
  }
  
  /* Product Image */
  .product-image-container {
    position: relative;
    overflow: hidden;
    border-radius: 15px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
    margin-bottom: 2rem;
  }
  
  .product-image {
    width: 100%;
    height: 400px;
    object-fit: cover;
    transition: transform 0.5s ease;
  }
  
  .product-image-container:hover .product-image {
    transform: scale(1.05);
  }
  
  .product-badge {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: linear-gradient(135deg,  #6fcf97,  #f7f796);
    color: white;
    padding: 0.75rem 1.5rem;
    border-radius: 50px;
    font-weight: 600;
    box-shadow: 0 5px 15px rgba(102, 126, 234, 0.2);
    z-index: 1;
  }
  
  /* Product Info */
  .product-info {
    background: #f8f9fa;
    border-radius: 15px;
    padding: 2rem;
    margin-bottom: 2rem;
  }
  
  .info-row {
    display: flex;
    margin-bottom: 1.5rem;
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #e9ecef;
  }
  
  .info-row:last-child {
    margin-bottom: 0;
    padding-bottom: 0;
    border-bottom: none;
  }
  
  .info-label {
    flex: 0 0 120px;
    font-weight: 600;
    color:  #111613ff;
    display: flex;
    align-items: center;
    gap: 0.5rem;
  }
  
  .info-label i {
    color:  #1a1f1cff;
  }
  
  .info-value {
    flex: 1;
    color: #495057;
  }
  
  .price-value {
    font-size: 1.5rem;
    font-weight: 700;
    color:  #131a16ff;
  }
  
  .description-value {
    line-height: 1.8;
  }
  
  /* Action Button */
  .action-container {
    text-align: center;
    padding: 2rem 0;
  }
  
  .btn-whatsapp {
    background:  #6fcf97;
    color: white;
    border: none;
    border-radius: 50px;
    padding: 1rem 2rem;
    font-weight: 600;
    font-size: 1.1rem;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px  #6fcf97;
    display: inline-flex;
    align-items: center;
    gap: 0.75rem;
  }
  
  .btn-whatsapp:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px  #6fcf97;
    color: white;
  }
  
  /* Related Products */
  .related-section {
    padding: 3rem;
    border-top: 1px solid #e9ecef;
  }
  
  .section-title {
    font-size: 1.8rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 2rem;
    position: relative;
    padding-bottom: 1rem;
  }
  
  .section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 60px;
    height: 3px;
    background: linear-gradient(90deg,  #6fcf97,  #f7f796);
    border-radius: 2px;
  }
  
  .related-products {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
    gap: 1.5rem;
  }
  
  .related-product {
    background: white;
    border-radius: 15px;
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
    overflow: hidden;
    transition: all 0.3s ease;
  }
  
  .related-product:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.1);
  }
  
  .related-product img {
    width: 100%;
    height: 150px;
    object-fit: cover;
  }
  
  .related-product-content {
    padding: 1rem;
  }
  
  .related-product-title {
    font-weight: 600;
    color: #2c3e50;
    margin-bottom: 0.5rem;
    font-size: 1rem;
  }
  
  .related-product-price {
    color:  #6fcf97;
    font-weight: 600;
    font-size: 0.9rem;
  }
  
  /* Responsive */
  @media (max-width: 992px) {
    .product-content {
      flex-direction: column;
    }
    
    .product-image-container {
      margin-bottom: 2rem;
    }
  }
  
  @media (max-width: 768px) {
    .product-title {
      font-size: 2rem;
    }
    
    .product-header, .product-content, .related-section {
      padding: 2rem;
    }
    
    .info-label {
      flex: 0 0 100px;
    }
    
    .btn-whatsapp {
      padding: 0.75rem 1.5rem;
      font-size: 1rem;
    }
    
    .related-products {
      grid-template-columns: repeat(auto-fill, minmax(200px, 1fr));
    }
  }
</style>

<!-- Hero Section -->
<div class="hero-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <h1 class="display-4 fw-bold mb-4" data-aos="fade-right">
          <i class="ti ti-shopping-bag me-3"></i>Detail Produk UMKM
        </h1>
        <p class="lead mb-0" data-aos="fade-right" data-aos-delay="100">
          Informasi lengkap tentang produk UMKM desa. Dapatkan produk berkualitas 
          langsung dari penjual dengan harga terjangkau.
        </p>
      </div>
    </div>
  </div>
</div>

<!-- Main Content -->
<div class="main-container" data-aos="fade-up">
  <!-- Breadcrumb -->
  <div class="breadcrumb-container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <li class="breadcrumb-item">
          <a href="{{ route('home') }}">
            <i class="ti ti-home me-1"></i> Beranda
          </a>
        </li>
        <li class="breadcrumb-item">
          <a href="/umkm">
            <i class="ti ti-shopping-cart me-1"></i> UMKM
          </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          {{ $umkm->produk }}
        </li>
      </ol>
    </nav>
  </div>
  
  <!-- Product Header -->
  <div class="product-header">
    <h1 class="product-title">{{ $umkm->produk }}</h1>
  </div>
  
  <!-- Product Content -->
  <div class="product-content">
    <div class="row">
      <!-- Product Image -->
      <div class="col-lg-5" data-aos="fade-right">
        <div class="product-image-container">
          <img src="{{ $umkm->foto ? asset('storage/' . $umkm->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($umkm->produk) . '&background=random' }}" 
               alt="{{ $umkm->produk }}"
               class="product-image"
               onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($umkm->produk) }}&background=random'">
          <div class="product-badge">
            <i class="ti ti-star me-1"></i> Produk Unggulan
          </div>
        </div>
      </div>
      
      <!-- Product Info -->
      <div class="col-lg-7" data-aos="fade-left">
        <div class="product-info">
          <div class="info-row">
            <div class="info-label">
              <i class="ti ti-currency"></i>
              <span>Harga</span>
            </div>
            <div class="info-value">
              <span class="price-value">Rp {{ number_format($umkm->harga, 0, ',', '.') }}</span>
            </div>
          </div>
          
          <div class="info-row">
            <div class="info-label">
              <i class="ti ti-align-left"></i>
              <span>Deskripsi</span>
            </div>
            <div class="info-value description-value">
              {!! $umkm->deskripsi !!}
            </div>
          </div>
        </div>
        
        <!-- Action Button -->
        <div class="action-container">
          <a href="https://wa.me/+62{{ $umkm->no_hp }}" target="_blank" class="btn-whatsapp">
            <i class="ti ti-brand-whatsapp"></i>
            <span>Hubungi Penjual via WhatsApp</span>
          </a>
        </div>
      </div>
    </div>
  </div>
  
  <!-- Related Products Section -->
  @if(isset($related) && $related->count() > 0)
    <div class="related-section">
      <h3 class="section-title">
        <i class="ti ti-shopping-bag me-2"></i> Produk Terkait
      </h3>
      
      <div class="related-products">
        @foreach($related as $item)
          <a href="/umkm/{{ $item->slug }}" class="related-product text-decoration-none" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
            <img src="{{ $item->foto ? asset('storage/' . $item->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($item->produk) . '&background=random' }}" 
                 alt="{{ $item->produk }}"
                 onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($item->produk) }}&background=random'">
            <div class="related-product-content">
              <h5 class="related-product-title">{{ $item->produk }}</h5>
              <div class="related-product-price">Rp {{ number_format($item->harga, 0, ',', '.') }}</div>
            </div>
          </a>
        @endforeach
      </div>
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
});
</script>
@endpush

@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/iconfont/tabler-icons.min.css">
@endpush