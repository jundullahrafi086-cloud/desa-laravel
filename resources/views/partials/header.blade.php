<!-- ======= Header + Sidebar (Android sidebar mode) ======= -->
<style>
  /* Header Styles dengan Warna Baru */
  #header {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
    position: fixed;
    top: 0; left: 0; right: 0;
    z-index: 1000;
    transition: all 0.3s ease;
    padding: 15px 0;
    height: auto;
    -webkit-backface-visibility: hidden;
    backface-visibility: hidden;
  }
  #header.header-scrolled {
    padding: 10px 0;
    box-shadow: 0 5px 25px rgba(0, 0, 0, 0.15);
  }
  /* Logo Styles */
  .logo { transition: all 0.3s ease; }
  .logo a {
    display: flex; align-items: center;
    text-decoration: none; transition: all 0.3s ease;
  }
  .logo img {
    height: 70px; object-fit: contain; transition: all 0.3s ease;
  }
  .logo h1 {
    margin: 0; font-size: 1.5rem; font-weight: 700; color: white;
    text-shadow: 0 2px 5px rgba(0,0,0,0.2); transition: all 0.3s ease;
  }
  .logo:hover h1 { transform: translateY(-2px); }
  /* Navbar Styles untuk Desktop */
  .navbar { padding: 0; margin: 0; }
  .navbar ul {
    margin: 0; padding: 0; list-style: none;
    display: flex; align-items: center;
  }
  .navbar li { position: relative; margin: 0 10px; }
  .navbar a {
    display: flex; align-items: center;
    padding: 10px 15px; font-size: 15px; font-weight: 600;
    color: rgba(255,255,255,0.9); text-decoration: none;
    border-radius: 30px; transition: all 0.3s ease;
    position: relative; overflow: hidden; -webkit-tap-highlight-color: transparent;
  }
  .navbar a::before {
    content:''; position:absolute; top:0; left:0; width:0; height:100%;
    background: rgba(255,255,255,0.2); transition: width 0.3s ease; z-index:-1;
  }
  .navbar a:hover::before, .navbar a.active::before { width: 100%; }
  .navbar a:hover, .navbar a.active { color: white; transform: translateY(-2px); }
  /* Dropdown Styles untuk Desktop */
  .navbar .dropdown ul {
    position: absolute; top: 100%; left: 0; background: white; min-width: 220px;
    box-shadow: 0 10px 30px rgba(0,0,0,0.1); border-radius: 10px; padding: 10px 0;
    opacity: 0; visibility: hidden; transform: translateY(10px);
    transition: all 0.3s ease; z-index: 1000; display: block;
  }
  .navbar .dropdown:hover > ul { opacity: 1; visibility: visible; transform: translateY(0); }
  .navbar .dropdown ul li { margin: 0; padding: 0 10px; }
  .navbar .dropdown ul a {
    padding: 10px 15px; font-size: 14px; color: #333; border-radius: 5px; position: relative;
  }
  .navbar .dropdown ul a::before { display: none; }
  .navbar .dropdown ul a:hover { background: rgba(17,153,142,0.1); color: #11998e; transform: translateX(5px); }
  /* Chevron Icon */
  .navbar .dropdown i { margin-left: 5px; font-size: 12px; transition: transform 0.3s ease; }
  .navbar .dropdown:hover i { transform: rotate(180deg); }
  /* Login Button */
  .navbar li:last-child a {
    background: rgba(255,255,255,0.2); border: 1px solid rgba(255,255,255,0.3);
    padding: 8px 20px; border-radius: 30px; margin-left: 10px;
  }
  .navbar li:last-child a:hover { background: white; color: #11998e; }
  /* Mobile Toggle (ikon hamburger di header) */
  .mobile-nav-toggle {
    display: none; color: white; font-size: 28px; cursor: pointer; line-height: 0;
    transition: 0.3s; -webkit-tap-highlight-color: transparent; z-index: 1001; position: relative;
  }
  /* Sidebar Styles untuk Mobile - Hidden by default */
  .sidebar-overlay {
    display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%;
    background: rgba(0,0,0,0.5); z-index: 999; opacity: 0; transition: opacity 0.3s ease; pointer-events: none;
  }
  .sidebar-overlay.active { display: block; opacity: 1; pointer-events: auto; }
  .sidebar {
    display: none; position: fixed; top: 0; left: -300px; width: 280px; height: 100%;
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    z-index: 1000; padding: 20px 0; overflow-y: auto; transition: left 0.3s ease;
    box-shadow: 5px 0 15px rgba(0,0,0,0.1);
  }
  .sidebar.active { left: 0; }
  .sidebar-header { padding: 0 20px 20px; border-bottom: 1px solid rgba(255,255,255,0.1); margin-bottom: 20px; }
  .sidebar-logo { display: flex; align-items: center; margin-bottom: 15px; }
  .sidebar-logo img {
    height: 50px; object-fit: contain; margin-right: 10px;
  }
  .sidebar-logo h1 { margin: 0; font-size: 1.2rem; font-weight: 700; color: white; }
  .sidebar-close { position: absolute; top: 15px; right: 15px; color: white; font-size: 24px; cursor: pointer; -webkit-tap-highlight-color: transparent; }
  .sidebar-nav { padding: 0; margin: 0; list-style: none; }
  .sidebar-nav li { margin: 0; position: relative; }
  .sidebar-nav a {
    display: flex; align-items: center; padding: 15px 20px; color: white; text-decoration: none;
    font-size: 16px; font-weight: 500; transition: all 0.3s ease; border-left: 3px solid transparent;
  }
  .sidebar-nav a:hover, .sidebar-nav a.active { background: rgba(255,255,255,0.1); border-left-color: white; }
  .sidebar-nav .dropdown > a { justify-content: space-between; }
  .sidebar-nav .dropdown i { transition: transform 0.3s ease; }
  .sidebar-nav .dropdown.active i { transform: rotate(180deg); }
  .sidebar-nav .dropdown ul {
    display: none; padding: 0; margin: 0; list-style: none; background: rgba(0,0,0,0.1);
  }
  .sidebar-nav .dropdown.active ul { display: block; }
  .sidebar-nav .dropdown ul li { margin: 0; }
  .sidebar-nav .dropdown ul a { padding: 12px 20px 12px 40px; font-size: 14px; border-left: none; }
  .sidebar-nav .dropdown ul a:hover { background: rgba(255,255,255,0.05); }

  /* Responsive Styles - Laptop / Small Desktop */
  @media (max-width: 1200px) and (min-width: 993px) {
    .navbar li { margin: 0 3px; }
    .navbar a { padding: 8px 10px; font-size: 13.5px; }
    .logo img { height: 52px; }
    .logo h1 { font-size: 1.15rem; }
  }

  /* Responsive Styles - Tablet */
  @media (max-width: 992px) {
    #header { padding: 12px 0; }
    .container { padding: 0 15px; }
    .navbar ul { display: none; }
    .mobile-nav-toggle { display: block; }
    .sidebar { display: block; }

    .logo img { height: 48px; }
    .logo h1 { font-size: 1.15rem; }
  }

  /* Responsive Styles - Mobile Phone */
  @media (max-width: 768px) {
    /* Header tetap tampil di mobile dengan ukuran lebih kecil */
    #header {
      padding: 8px 0;
    }

    /* Sesuaikan ukuran logo di mobile */
    .logo img {
      height: 40px;
    }
    .logo h1 {
      font-size: 1rem;
    }

    /* Sesuaikan sidebar untuk mobile */
    .sidebar {
      width: 280px;
      left: -280px;
      box-shadow: 2px 0 10px rgba(0,0,0,0.1);
    }
    .sidebar.active { left: 0; }
    .sidebar-logo img { height: 40px; }
    .sidebar-logo h1 { font-size: 1rem; }
    .mobile-nav-toggle { font-size: 26px; }
  }

  /* Responsive Styles - Small Mobile */
  @media (max-width: 576px) {
    .sidebar { width: 260px; left: -260px; }
    .sidebar-logo img { height: 38px; }
    .sidebar-logo h1 { font-size: 0.95rem; }
    .logo h1 {
      font-size: 0.95rem;
      max-width: 190px;
      white-space: nowrap;
      overflow: hidden;
      text-overflow: ellipsis;
    }
  }

  /* Responsive Styles - Very Small Mobile */
  @media (max-width: 360px) {
    .sidebar { width: 240px; left: -240px; }
  }

  /* Desktop Styles - Hide sidebar completely */
  @media (min-width: 993px) {
    .sidebar-overlay, .sidebar {
      display: none !important; visibility: hidden !important; opacity: 0 !important;
    }
  }

  /* Perbaikan untuk konten yang terhalang header */
  body {
    padding-top: 90px; /* Padding untuk desktop */
  }

  @media (max-width: 768px) {
    body {
      padding-top: 70px; /* Padding untuk mobile */
    }
  }

  /* Pastikan konten utama memiliki z-index yang lebih rendah dari header */
  .main-content {
    position: relative;
    z-index: 1;
  }
</style>
<!-- Header untuk Desktop / Non-Android -->
<header id="header" class="d-flex align-items-center">
  <div class="container d-flex align-items-center justify-content-between">
    <div class="logo me-auto d-flex align-items-center">
      <a href="/" class="d-flex align-items-center text-decoration-none">
        @if(isset($logo) && $logo->logo)
          <img src="{{ asset('storage/' . $logo->logo) }}" alt="Logo Desa" class="me-2">
        @endif
        <h1 class="mb-0 fs-4 fw-bold text-white">{{ $nm_desa ?? 'Desa Kertamukti' }}</h1>
      </a>
    </div>
    <nav id="navbar" class="navbar">
      <ul>
        <li><a class="nav-link scrollto {{ request()->is('/') ? 'active' : '' }}" href="/">Beranda</a></li>
        <li class="dropdown">
          <a href="#" class="{{ request()->is('wilayah*','sejarah*','visi-misi*','perangkat-desa*','peta-desa*','data-desa*') ? 'active' : '' }}"><span>Profil Desa</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="/wilayah">Wilayah</a></li>
            <li><a href="/sejarah">Sejarah</a></li>
            <li><a href="/visi-misi">Visi & Misi</a></li>
            <li><a href="/perangkat-desa">Perangkat Desa</a></li>
            <li><a href="/peta-desa">Peta Desa</a></li>
            <li><a href="/data-desa">Data Desa</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="{{ request()->is('pengumuman*','berita*','gallery*','lkd*','apbdesa*') ? 'active' : '' }}"><span>Informasi</span> <i class="bi bi-chevron-down"></i></a>
          <ul>
            <li><a href="/pengumuman">Pengumuman</a></li>
            <li><a href="/berita">Berita</a></li>
            <li><a href="/gallery">Gallery</a></li>
            <li><a href="/lkd">LKD</a></li>
            <li><a href="/apbdesa">IPPD / APBDes</a></li>
          </ul>
        </li>
        <li><a class="nav-link scrollto {{ request()->is('umkm*') ? 'active' : '' }}" href="/umkm">UMKM</a></li>
        <li><a class="nav-link scrollto {{ request()->is('layanan*') ? 'active' : '' }}" href="/layanan">Layanan</a></li>
        <li><a class="nav-link scrollto {{ request()->is('kontak*') ? 'active' : '' }}" href="/kontak">Kontak Kami</a></li>
        @auth
          <li><a href="/dashboard" class="nav-link scrollto">Dashboard</a></li>
        @else
          <li><a href="/login" class="nav-link scrollto">Masuk</a></li>
        @endauth
      </ul>
      <i class="bi bi-list mobile-nav-toggle"></i>
    </nav>
  </div>
</header>
<!-- Sidebar untuk Mobile / Android -->
<div class="sidebar-overlay"></div>
<div class="sidebar">
  <div class="sidebar-header">
    <div class="sidebar-logo">
      @if(isset($logo) && $logo->logo)
        <img src="{{ asset('storage/' . $logo->logo) }}" alt="Logo Desa">
      @endif
      <h1>{{ $nm_desa ?? 'Desa Kertamukti' }}</h1>
    </div>
    <i class="bi bi-x-lg sidebar-close" role="button" aria-label="Tutup menu"></i>
  </div>
  <ul class="sidebar-nav">
    <li><a href="/" class="{{ request()->is('/') ? 'active' : '' }}">Beranda</a></li>
    <li class="dropdown">
      <a href="#" class="{{ request()->is('wilayah*','sejarah*','visi-misi*','perangkat-desa*','peta-desa*','data-desa*') ? 'active' : '' }}"><span>Profil Desa</span> <i class="bi bi-chevron-down"></i></a>
      <ul>
        <li><a href="/wilayah">Wilayah</a></li>
        <li><a href="/sejarah">Sejarah</a></li>
        <li><a href="/visi-misi">Visi & Misi</a></li>
        <li><a href="/perangkat-desa">Perangkat Desa</a></li>
        <li><a href="/peta-desa">Peta Desa</a></li>
        <li><a href="/data-desa">Data Desa</a></li>
      </ul>
    </li>
    <li class="dropdown">
      <a href="#" class="{{ request()->is('pengumuman*','berita*','gallery*','lkd*','apbdesa*') ? 'active' : '' }}"><span>Informasi</span> <i class="bi bi-chevron-down"></i></a>
      <ul>
        <li><a href="/pengumuman">Pengumuman</a></li>
        <li><a href="/berita">Berita</a></li>
        <li><a href="/gallery">Gallery</a></li>
        <li><a href="/lkd">LKD</a></li>
        <li><a href="/apbdesa">IPPD / APBDes</a></li>
      </ul>
    </li>
    <li><a href="/umkm" class="{{ request()->is('umkm*') ? 'active' : '' }}">UMKM</a></li>
    <li><a href="/layanan" class="{{ request()->is('layanan*') ? 'active' : '' }}">Layanan</a></li>
    <li><a href="/kontak" class="{{ request()->is('kontak*') ? 'active' : '' }}">Kontak Kami</a></li>
    @auth
      <li><a href="/dashboard">Dashboard Admin</a></li>
    @else
      <li><a href="/login">Masuk</a></li>
    @endauth
  </ul>
</div>
<!-- Main Content -->

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const body = document.body;
    const header = document.getElementById('header');

    // Deteksi perangkat mobile
    const isMobile = window.innerWidth <= 992;

    // Atur padding body sesuai tinggi header
    function updateBodyPadding() {
      const headerHeight = header?.offsetHeight || 0;
      if (window.innerWidth <= 768) {
        body.style.paddingTop = (headerHeight + 10) + 'px'; // Tambahkan sedikit ruang ekstra di mobile
      } else {
        body.style.paddingTop = (headerHeight + 20) + 'px'; // Tambahkan sedikit ruang ekstra di desktop
      }
    }

    // Panggil fungsi saat halaman dimuat
    updateBodyPadding();

    // Update padding saat window di-resize
    window.addEventListener('resize', updateBodyPadding);

    // Efek scroll header
    window.addEventListener('scroll', function() {
      if (window.scrollY > 50) {
        header.classList.add('header-scrolled');
      } else {
        header.classList.remove('header-scrolled');
      }
      // Update padding body saat header berubah ukuran
      setTimeout(updateBodyPadding, 100);
    });

    // Elemen sidebar & kontrol
    const sidebar = document.querySelector('.sidebar');
    const sidebarOverlay = document.querySelector('.sidebar-overlay');
    const sidebarClose = document.querySelector('.sidebar-close');
    const mobileNavToggle = document.querySelector('.mobile-nav-toggle'); // ikon di header

    function openSidebar() {
      sidebar.classList.add('active');
      sidebarOverlay.classList.add('active');
      document.body.style.overflow = 'hidden';
    }

    function closeSidebar() {
      sidebar.classList.remove('active');
      sidebarOverlay.classList.remove('active');
      document.body.style.overflow = '';
    }

    function toggleSidebar(e) {
      e && e.preventDefault && e.preventDefault();
      sidebar.classList.contains('active') ? closeSidebar() : openSidebar();
    }

    // Inisialisasi trigger untuk mobile
    if (mobileNavToggle) {
  mobileNavToggle.addEventListener('click', toggleSidebar);
}

    // Tutup sidebar dari tombol X & overlay
    if (sidebarClose) sidebarClose.addEventListener('click', closeSidebar);
    if (sidebarOverlay) sidebarOverlay.addEventListener('click', closeSidebar);

    // Dropdown toggle di sidebar
    const dropdowns = document.querySelectorAll('.sidebar-nav .dropdown');
    dropdowns.forEach(dropdown => {
      const link = dropdown.querySelector(':scope > a');
      if (!link) return;
      link.addEventListener('click', function(e) {
        e.preventDefault();
        dropdown.classList.toggle('active');
      });
    });

    // Tutup sidebar saat klik link biasa (bukan toggler dropdown)
    const navLinks = document.querySelectorAll('.sidebar-nav a');
    navLinks.forEach(link => {
      link.addEventListener('click', function() {
        const parent = link.parentElement;
        if (parent && parent.classList.contains('dropdown') && parent.querySelector('ul')) return;
        closeSidebar();
      });
    });

    // Resize/orientation
    window.addEventListener('resize', function() {
      updateBodyPadding();
      if (window.innerWidth > 992 && sidebar.classList.contains('active')) {
        closeSidebar();
      }
    });

    window.addEventListener('orientationchange', function() {
      setTimeout(function() {
        updateBodyPadding();
        if (sidebar.classList.contains('active')) closeSidebar();
      }, 200);
    });

    // Perbaikan scroll mobile (passive listener)
    if (isMobile) {
      document.addEventListener('touchmove', function() {}, { passive: true });
    }
  });
</script>
