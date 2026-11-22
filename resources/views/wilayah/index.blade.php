@extends('layouts.main')
@section('content')
<style>
  /* Hero Section - sama seperti sejarah */
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
    height: 200%;
    background: radial-gradient(circle, rgba(247, 247, 150, 1)
 0%, transparent 70%);
    animation: float 20s infinite linear;
  }
  
  @keyframes float {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }
  
  /* Content Section - sama seperti sejarah */
  .content-section {
    background: white;
    border-radius: 20px;
    padding: 3rem;
    box-shadow: 0 10px 30px rgba(17, 153, 142, 0.15);
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
    background: linear-gradient(90deg, #6fcf97, #fce38a);
    border-radius: 20px 20px 0 0;
  }
  
  .content-title {
    font-size: 2.5rem;
    font-weight: 700;
    color: #6fcf97;
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
    background: linear-gradient(45deg, #6fcf97, #fce38a);
    border-radius: 2px;
  }
  
  .content-body {
    font-size: 1.1rem;
    line-height: 1.8;
    color: #6fcf97;
  }
  
  /* Content styling - sama seperti sejarah */
  .content-body h1, .content-body h2, .content-body h3, .content-body h4, .content-body h5, .content-body h6 {
    color: #6fcf97;
    margin-top: 0;
    margin-bottom: 20px;
    font-weight: 700;
    line-height: 1.4;
  }
  
  .content-body h1 {
    font-size: 2.5rem;
  }
  
  .content-body h2 {
    font-size: 2rem;
    position: relative;
    padding-left: 15px;
  }
  
  .content-body h2::before {
    content: '';
    position: absolute;
    left: 0;
    top: 50%;
    transform: translateY(-50%);
    width: 5px;
    height: 70%;
    background: linear-gradient(to bottom, #6fcf97, #fce38a);
    border-radius: 3px;
  }
  
  .content-body h3 {
    font-size: 1.75rem;
    color: #6fcf97;
  }
  
  .content-body h4 {
    font-size: 1.5rem;
    color: #6fcf97;
  }
  
  .content-body p {
    color: #555;
    line-height: 1.8;
    margin-bottom: 20px;
    font-size: 1.1rem;
  }
  
  .content-body ul, .content-body ol {
    margin-bottom: 25px;
    padding-left: 25px;
  }
  .content-body ul {
    list-style: none;
  }
  
  .content-body li {
    margin-bottom: 10px;
    position: relative;
    line-height: 1.6;
    color: #555;
  }
  
  .content-body ul li::before {
    content: '';
    position: absolute;
    left: -20px;
    top: 10px;
    width: 8px;
    height: 8px;
    background: linear-gradient(135deg, #6fcf97, #fce38a);
    border-radius: 50%;
  }
  
  .content-body a {
    color: #6fcf97;
    text-decoration: none;
    font-weight: 600;
    transition: all 0.3s ease;
    position: relative;
  }
  
  .content-body a::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    width: 0;
    height: 2px;
    background: #6fcf97;
    transition: width 0.3s ease;
  }
  
  .content-body a:hover {
    color: #fce38a;
  }
  
  .content-body a:hover::after {
    width: 100%;
  }
  
  .content-body img {
    max-width: 100%;
    height: auto;
    border-radius: 10px;
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    margin: 25px 0;
    transition: all 0.4s ease;
  }
  
  .content-body img:hover {
    transform: scale(1.02);
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
  }
  
  .content-body blockquote {
    background: rgba(252, 227, 138, 0.1);
    border-left: 4px solid #fce38a;
    padding: 20px;
    margin: 25px 0;
    border-radius: 0 10px 10px 0;
    font-style: italic;
    color: #555;
  }
  
  .content-body table {
    width: 100%;
    border-collapse: collapse;
    margin: 25px 0;
    border-radius: 10px;
    overflow: hidden;
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
  }
  
  .content-body table th {
    background: linear-gradient(135deg, #6fcf97, #fce38a);
    color: white;
    font-weight: 600;
    text-align: left;
    padding: 15px;
  }
  
  .content-body table td {
    padding: 15px;
    border-bottom: 1px solid #eee;
  }
  
  .content-body table tr:last-child td {
    border-bottom: none;
  }
  
  .content-body table tr:nth-child(even) {
    background-color: rgba(252, 227, 138, 0.15);
  }
  
  .content-body table tr:hover {
    background-color: rgba(252, 227, 138, 0.25);
  }
  
  /* Responsive */
  @media (max-width: 992px) {
    .content-title {
      font-size: 2rem;
    }
    
    .content-section {
      padding: 2rem;
    }
  }
  
  @media (max-width: 768px) {
    .hero-section {
      padding: 3rem 0;
    }
    
    .content-section {
      padding: 1.5rem;
    }
    
    .content-body h1 {
      font-size: 2rem;
    }
    
    .content-body h2 {
      font-size: 1.75rem;
    }
    
    .content-body h3 {
      font-size: 1.5rem;
    }
    
    .content-body p {
      font-size: 1rem;
    }
  }
  
  @media (max-width: 576px) {
    .hero-section {
      padding: 2rem 0;
    }
    
    .content-title {
      font-size: 1.75rem;
    }
    
    .content-section {
      padding: 1rem;
    }
    
    .content-body h1 {
      font-size: 1.75rem;
    }
    
    .content-body h2 {
      font-size: 1.5rem;
    }
    
    .content-body h3 {
      font-size: 1.25rem;
    }
    
    .content-body p {
      font-size: 0.95rem;
      line-height: 1.6;
    }
    
    .content-body table {
      font-size: 0.9rem;
      display: block;
      overflow-x: auto;
      white-space: nowrap;
    }
    
    .content-body table th, .content-body table td {
      padding: 10px;
    }
  } 
</style>

<!-- Hero Section - sama seperti sejarah -->
<div class="hero-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <h1 class="display-4 fw-bold mb-4" data-aos="fade-right">
          <i class="ti ti-map-pin me-3"></i>Wilayah Desa
        </h1>
        <p class="lead mb-0" data-aos="fade-right" data-aos-delay="100">
          Menampilkan informasi lengkap tentang wilayah desa kami. 
          Dari batas administratif hingga potensi wilayah yang dapat dikembangkan.
        </p>
      </div>
    </div>
  </div>
</div>

<div class="container">
  <!-- Konten Wilayah -->
  <div class="content-section" data-aos="fade-up">
    <h2 class="content-title">
      <i class="ti ti-map-2 me-3"></i>{{ $wilayah->judul }}
    </h2>
    
    <div class="content-body">
      {!! $wilayah->body !!}
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
