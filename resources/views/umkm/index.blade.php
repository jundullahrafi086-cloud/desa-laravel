@extends('layouts.main')
@section('content')
<style>
  /* Hero Section */
  .hero-section {
    background: linear-gradient(135deg,  #6fcf97,  #6fcf97);
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
    background: radial-gradient(circle,  #f7f796 0%, transparent 70%);
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
    box-shadow: 0 20px 40px  #f7f796;
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
    background: linear-gradient(90deg, #6fcf97,  #f7f796);
    border-radius: 2px;
  }
  
  .section-subtitle {
    font-size: 1.2rem;
    color: #6c757d;
    margin-top: 1rem;
  }
  
  /* UMKM Container */
  .umkm-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 2rem;
    padding: 0 3rem 3rem;
  }
  
  /* Card Styles */
  .umkm-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    position: relative;
    overflow: hidden;
    height: 100%;
    display: flex;
    flex-direction: column;
  }
  
  .umkm-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg,  #6fcf97,  #f7f796);
    transform: scaleX(0);
    transition: transform 0.3s ease;
  }
  
  .umkm-card:hover::before {
    transform: scaleX(1);
  }
  
  .umkm-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 25px 50px  #6fcf97;
  }
  
  /* Image Container */
  .img-container {
    height: 220px;
    overflow: hidden;
    position: relative;
  }
  
  .img-container img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
  }
  
  .umkm-card:hover .img-container img {
    transform: scale(1.05);
  }
  
  /* Badge Overlay */
  .badge-overlay {
    position: absolute;
    top: 1rem;
    right: 1rem;
    background: linear-gradient(135deg,  #6fcf97);
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 50px;
    font-weight: 600;
    font-size: 0.85rem;
    box-shadow: 0 5px 15px  #6fcf97;
    z-index: 1;
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
    background: linear-gradient(135deg, #6fcf97,  #f7f796);
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 1.3rem;
    box-shadow: 0 10px 25px  #6fcf97;
    transition: all 0.3s ease;
  }
  
  .umkm-card:hover .card-icon {
    transform: scale(1.1) rotate(5deg);
  }
  
  .card-title {
    font-size: 1.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin: 0;
    transition: color 0.3s ease;
    line-height: 1.3;
  }
  
  .umkm-card:hover .card-title {
    color:   #6fcf97;
  }
  
  .card-price {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color:  #15201aff;
    font-size: 1.2rem;
    font-weight: 700;
    margin-bottom: 1rem;
  }
  
  .card-price i {
    font-size: 1rem;
  }
  
  .card-text {
    font-size: 1rem;
    line-height: 1.6;
    color:  #6fcf97;
    flex: 1;
    margin-bottom: 1rem;
  }
  
  .card-text p {
    margin: 0;
  }
  
  /* Card Footer */
  .card-footer {
    margin-top: auto;
    padding-top: 1rem;
    border-top: 1px solid  #6fcf97;
  }
  
  .action-buttons {
    display: flex;
    flex-direction: column;
    gap: 0.75rem;
  }
  
  .btn-whatsapp {
    background:  #6fcf97;
    color: white;
    border: none;
    border-radius: 50px;
    padding: 0.75rem 1rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px  #6fcf97;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
  }
  
  .btn-whatsapp:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px  #6fcf97;
    color: white;
  }
  
  .btn-detail {
    background: linear-gradient(135deg,  #f0f074ff);
    color: white;
    border: none;
    border-radius: 50px;
    padding: 0.75rem 1rem;
    font-weight: 600;
    transition: all 0.3s ease;
    box-shadow: 0 5px 15px  #6fcf97;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 0.5rem;
  }
  
  .btn-detail:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px  #6fcf97;
    color: white;
  }
  
  /* Empty State */
  .empty-state {
    text-align: center;
    padding: 4rem 2rem;
    background:  #6fcf97;
    border-radius: 20px;
    color:  #6fcf97;
    margin: 0 3rem 3rem;
  }
  
  .empty-state i {
    font-size: 4rem;
    color:  #6fcf97;
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
    background: linear-gradient(135deg,  #6fcf97,  #f7f796);
    border-color: transparent;
    color: white;
  }
  
  .page-item .page-link:hover {
    background-color:  #6fcf97;
    border-color:  #6fcf97;
    color:  #6fcf97;
  }
  
  /* Responsive */
  @media (max-width: 768px) {
    .umkm-container {
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
  }
  /* Search Bar */
.search-bar {
  padding: 0 3rem 2rem;
}
.search-form {
  display: grid;
  grid-template-columns: 1fr auto;
  gap: .75rem;
}
.search-input-wrap{
  position: relative;
}
.search-input-wrap i{
  position: absolute; left: 14px; top: 50%; transform: translateY(-50%);
  font-size: 1.2rem; color: #6fcf97;
}
.search-input{
  width: 100%;
  border: 1px solid #e9ecef;
  border-radius: 12px;
  padding: .9rem .9rem .9rem 2.5rem;
  font-size: 1rem;
  outline: none;
  transition: border-color .2s ease, box-shadow .2s ease;
}
.search-input:focus{
  border-color: #6fcf97;
  box-shadow: 0 0 0 .2rem rgba(111,207,151,.15);
}
.search-btn, .reset-btn{
  border: none;
  border-radius: 12px;
  padding: .9rem 1.1rem;
  font-weight: 700;
  display: inline-flex; align-items: center; gap: .5rem;
  transition: transform .2s ease, box-shadow .2s ease;
}
.search-btn{
  background: linear-gradient(135deg, #6fcf97, #f7f796);
  color: #fff;
  box-shadow: 0 6px 16px rgba(111,207,151,.35);
}
.search-btn:hover{ transform: translateY(-2px); }
.reset-btn{
  background: #f8f9fa; color: #495057; border:1px solid #e9ecef;
}
@media (max-width:768px){
  .search-bar{ padding: 0 2rem 1.5rem; }
  .search-form{ grid-template-columns: 1fr; }
}
/* Pastikan isi kartu tidak meluber/nyelonong */
.card-content { min-width: 0; }
.card-title, .card-text, .card-price, .action-buttons { overflow-wrap: anywhere; word-break: break-word; }

</style>

<!-- Hero Section -->
<div class="hero-section">
  <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-8">
        <h1 class="display-4 fw-bold mb-4" data-aos="fade-right">
          <i class="ti ti-shopping-cart me-3"></i>UMKM Desa
        </h1>
        <p class="lead mb-0" data-aos="fade-right" data-aos-delay="100">
          Dukung produk lokal dan karya warga desa. Temukan berbagai produk UMKM 
          berkualitas dari desa kami yang siap memenuhi kebutuhan Anda.
        </p>
      </div>
      
    </div>
  </div>
</div>

<!-- Main Content -->
<div class="main-container" data-aos="fade-up">
  <div class="section-title">
    <h2><i class="ti ti-store me-3"></i>Produk UMKM Desa</h2>
    <p class="section-subtitle">Karya Warga, Kualitas Terjamin</p>
  </div>
  <div class="search-bar">
  <form id="umkm-search-form" class="search-form" method="GET" action="{{ url()->current() }}" autocomplete="off">
    <div class="search-input-wrap">
      <i class="ti ti-search"></i>
      <input
        id="umkm-search-input"
        type="text"
        name="q"
        value="{{ request('q') }}"
        class="search-input"
        placeholder="Cari produk, pemilik, kategori, atau deskripsi…">
    </div>

    {{-- tombol tetap ada untuk aksesibilitas, tapi disembunyikan --}}
    <button type="submit" class="search-btn" style="display:none">Cari</button>

    @if(request('q'))
      <a href="{{ url()->current() }}" class="reset-btn" id="umkm-search-clear">
        <i class="ti ti-x"></i> Reset
      </a>
    @endif
  </form>
</div>


  
  @if($umkms->count() > 0)
    <div class="umkm-container">
      @foreach ($umkms as $umkm)
        <div class="umkm-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
          <div class="img-container">
            <img
  src="{{ $umkm->foto ? asset('storage/' . $umkm->foto) : 'https://ui-avatars.com/api/?name=' . urlencode($umkm->produk) . '&background=random' }}"
  alt="{{ $umkm->produk }}"
  loading="lazy" decoding="async"
  onerror="this.src='https://ui-avatars.com/api/?name={{ urlencode($umkm->produk) }}&background=random'">

            <div class="badge-overlay">
              <i class="ti ti-tag me-1"></i> Produk Lokal
            </div>
          </div>
          
          <div class="card-content">
            <div class="card-header">
              <div class="card-icon">
                <i class="ti ti-shopping-bag"></i>
              </div>
              <h3 class="card-title">{{ $umkm->produk }}</h3>
            </div>
            
            <div class="card-price">
              <i class="ti ti-currency"></i>
              <span>Rp {{ number_format($umkm->harga, 0, ',', '.') }}</span>
            </div>
            
            <div class="card-footer">
              <div class="action-buttons">
                <a href="https://wa.me/+62{{ $umkm->no_hp }}" target="_blank" class="btn-whatsapp">
                  <i class="ti ti-brand-whatsapp"></i> Hubungi Penjual
                </a>
                <a href="/umkm/{{ $umkm->slug }}" class="btn-detail">
                  <i class="ti ti-eye"></i> Detail Produk
                </a>
              </div>
            </div>
          </div>
        </div>
      @endforeach
    </div>
    
    <div class="pagination-container">
  {{ $umkms->appends(request()->query())->links() }}
</div>

  @else
    <div class="empty-state" data-aos="fade-up">
      <i class="ti ti-shopping-cart-off"></i>
      <h4>Belum ada Produk UMKM</h4>
      <p>Belum ada produk UMKM yang dipublikasikan. Silakan periksa kembali beberapa saat lagi.</p>
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
  AOS.init({ duration: 800, easing: 'ease-in-out', once: true });

  const form  = document.getElementById('umkm-search-form');
  const input = document.getElementById('umkm-search-input');
  const clearBtn = document.getElementById('umkm-search-clear');

  if (!form || !input) return;

  let timer = null;
  const DELAY = 300;
  let composing = false;
  let lastSent = null;

  // Submit helper: requestSubmit -> submit
  function doSubmit() {
    // cegah submit berulang dengan nilai yang sama
    const val = (input.value || '').trim();
    if (val === lastSent) return;
    lastSent = val;

    if (typeof form.requestSubmit === 'function') {
      form.requestSubmit();
    } else {
      form.submit();
    }
  }

  // IME guard
  input.addEventListener('compositionstart', () => composing = true);
  input.addEventListener('compositionend', () => { composing = false; queueSubmit(); });

  // real-time trigger
  input.addEventListener('input', queueSubmit);
  input.addEventListener('change', queueSubmit); // jaga2 autofil/clipboard

  function queueSubmit() {
    if (composing) return;
    if (timer) clearTimeout(timer);
    timer = setTimeout(doSubmit, DELAY);
  }

  // Reset
  if (clearBtn) {
    clearBtn.addEventListener('click', function(e) {
      e.preventDefault();
      lastSent = '';          // reset guard
      input.value = '';
      window.location.href = form.getAttribute('action');
    });
  }
});
</script>
@endpush


@push('styles')
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet"/>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons@latest/iconfont/tabler-icons.min.css">
@endpush