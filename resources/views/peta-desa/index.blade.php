@extends('layouts.main')
@section('content')
<style>
  /* Hero Section - sama seperti sejarah dan wilayah */
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
    background: radial-gradient(circle,  rgba(247, 247, 150, 1) 0%, transparent 70%);
    animation: float 20s infinite linear;
  }
  
  @keyframes float {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  
  /* Content Section - sama seperti sejarah dan wilayah */
  .content-section {
    background: white;
    border-radius: 20px;
    padding: 3rem;
    box-shadow: 0 10px 30px  #6fcf97,  rgba(247, 247, 150, 1);
    margin-bottom: 3rem;
    position: relative;
  }
  
  .content-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(#6fcf97, #F7F796);
    border-radius: 20px 20px 0 0;
  }
  
  .content-title {
    font-size: 2.5rem;
    font-weight: 700;
    color:  #6fcf97;
    margin-bottom: 1rem;
    position: relative;
    display: inline-block;
  }
  
  .content-title::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 0;
    width: 60px;
    height: 4px;
    background: linear-gradient(45deg, #6fcf97, #F7F796);
    border-radius: 2px;
  }
  
  .content-body {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #495057;
  }
  
  /* Map Container - khusus untuk peta */
  .map-container {
    background: white;
    border-radius: 20px;
    overflow: hidden;
    box-shadow: 0 20px 40px  #6fcf97,  rgba(247, 247, 150, 1);
    position: relative;
    transition: all 0.4s ease;
    margin-bottom: 3rem;
  }
  
  .map-container::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, #6fcf97, #F7F796);
    transform: scaleX(0);
    transition: transform 0.4s ease;
  }
  
  .map-container:hover::before {
    transform: scaleX(1);
  }
  
  .map-container:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 50px  #6fcf97,  rgba(247, 247, 150, 1);
  }
  
  .map-wrapper {
    position: relative;
    padding-bottom: 56.25%; /* 16:9 aspect ratio */
    height: 0;
    overflow: hidden;
  }
  
  .map-wrapper iframe {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    border: none;
    transition: all 0.5s ease;
  }
  
  .map-container:hover .map-wrapper iframe {
    transform: scale(1.02);
  }
  
  .map-info {
    padding: 2rem;
    background: rgba(102, 126, 234, 0.05);
    border-top: 1px solid rgba(102, 126, 234, 0.1);
  }
  
  .map-info h3 {
    font-size: 1.5rem;
    font-weight: 700;
    color:  #6fcf97;
    margin-bottom: 1rem;
    position: relative;
    display: inline-block;
  }
  
  .map-info h3::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 50px;
    height: 3px;
    background: linear-gradient(45deg, #6fcf97, #F7F796);
    border-radius: 2px;
  }
  
  .map-info p {
    color: #555;
    line-height: 1.8;
    margin-bottom: 1rem;
  }
  
  .map-info a {
    color: #6fcf97;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    position: relative;
  }
  
  .map-info a::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    background:  #6fcf97;
    transition: width 0.3s ease;
  }
  
  .map-info a:hover {
    color: #6fcf97;
  }
  
  .map-info a:hover::after {
    width: 100%;
  }
  
  /* Responsive */
  @media (max-width: 992px) {
    .content-title {
      font-size: 2rem;
    }
    
    .content-section {
      padding: 2rem;
    }
    
    .map-info {
      padding: 1.5rem;
    }
  }
  
  @media (max-width: 768px) {
    .hero-section {
      padding: 3rem 0;
    }
    
    .content-section {
      padding: 1.5rem;
    }
    
    .content-title {
      font-size: 1.75rem;
    }
    
    .map-info h3 {
      font-size: 1.25rem;
    }
    
    .map-info p {
      font-size: 1rem;
    }
  }
  
  @media (max-width: 576px) {
    .hero-section {
      padding: 2rem 0;
    }
    
    .content-title {
      font-size: 1.5rem;
    }
    
    .content-section {
      padding: 1rem;
    }
    
    .map-info {
      padding: 1rem;
    }
    
    .map-info h3 {
      font-size: 1.1rem;
    }
    
    .map-info p {
      font-size: 0.9rem;
      line-height: 1.6;
    }
  }
</style>

<!-- Hero Section - sama seperti sejarah dan wilayah -->
<div class="hero-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <h1 class="display-4 fw-bold mb-4" data-aos="fade-right">
          <i class="ti ti-map me-3"></i>Peta Desa
        </h1>
        <p class="lead mb-0" data-aos="fade-right" data-aos-delay="100">
          Menampilkan peta wilayah desa kami secara interaktif. 
          Dapatkan informasi lengkap tentang lokasi dan aksesibilitas desa.
        </p>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <!-- Konten Peta Desa -->
  <div class="content-section" data-aos="fade-up">
    <h2 class="content-title">
      <i class="ti ti-map-2 me-3"></i>{{ $petaDesa->judul }}
    </h2>
    
    <div class="content-body">
      {!! $petaDesa->body !!}
    </div>
  </div>
  
  <!-- Map Container -->
  <div class="map-container" data-aos="fade-up" data-aos-delay="100">
    <div class="map-wrapper">
      <iframe 
        width="100%" 
        height="400" 
        frameborder="0" 
        scrolling="no" 
        marginheight="0" 
        marginwidth="0" 
        id="gmap_canvas" 
        src="https://maps.google.com/maps?width=520&amp;height=400&amp;hl=en&amp;q={{ urlencode($petaDesa->alamat) }}&amp;t=h&amp;z=13&amp;ie=UTF8&amp;iwloc=B&amp;output=embed">
      </iframe>
    </div>
    
    <div class="map-info">
      <h3><i class="ti ti-map-pin me-2"></i>Informasi Lokasi</h3>
      <p><strong>Alamat:</strong> {{ $petaDesa->alamat }}</p>
      <p><strong>Koordinat:</strong> {{ $petaDesa->latitude }}, {{ $petaDesa->longitude }}</p>
      <p><a href="https://maps.google.com/?q={{ urlencode($petaDesa->alamat) }}" target="_blank">
        <i class="ti ti-external-link me-1"></i>Buka di Google Maps
      </a></p>
    </div>
  </div>
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
@endpush