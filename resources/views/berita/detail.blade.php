@extends('layouts.main')

@section('content')
@php
  $judul   = $berita->judul ?? 'Tanpa Judul';
  $slug    = $berita->slug ?? \Illuminate\Support\Str::slug($judul);
  $author  = data_get($berita,'user.name','Administrator');
  $date    = optional($berita->created_at)->format('d F Y') ?? '';
  $ago     = optional($berita->created_at)->diffForHumans() ?? '';
  $views   = $berita->views ?? 0;
  $img     = $berita->gambar ? asset('storage/'.$berita->gambar) : 'https://ui-avatars.com/api/?name='.urlencode($judul).'&background=random';
  $katSlug = data_get($berita,'kategori.slug','#');
  $katName = data_get($berita,'kategori.kategori','Uncategorized');
@endphp

<style>
  :root{
    --brand:#6fcf97; 
    --brand-dark:#5ab885; 
    --accent:rgba(247,247,150,1);
    --ink:#2c3e50; 
    --muted:#6c757d; 
    --bg:#fff;
    --light-bg:#f8f9fa;
    --shadow-sm:0 8px 18px rgba(0,0,0,.06); 
    --shadow-md:0 16px 32px rgba(0,0,0,.08);
    --shadow-lg:0 20px 40px rgba(0,0,0,.12);
    --r:16px;
    --transition: all 0.3s cubic-bezier(0.175, 0.885, 0.32, 1.275);
  }

  /* ===== HERO: Judul halaman + deskripsi (Detail Berita) ===== */
  .hero{
    background: linear-gradient(135deg, #6fcf97 0%, #6fcf97 100%);
    color: white;
    padding: 4rem 0;
    margin-bottom: 3rem;
    border-radius: 0 0 50px 0;
    position: relative;
    overflow: hidden;
  }
  .hero::before{
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 150%;
    height: 150%;
    background: radial-gradient(circle,  rgba(247, 247, 150, 1) 0%, transparent 70%);
    animation: float 20s infinite linear;
  }
  @keyframes spin{to{transform:rotate(360deg)}}
  .hero-title{
    margin:.25rem 0 .5rem; 
    font-weight:800; 
    line-height:1.2;
    font-size:clamp(1.5rem,1.1rem + 1.6vw,2.25rem);
    position: relative;
    display: inline-block;
  }
  .hero-title::after {
    content: '';
    position: absolute;
    bottom: -8px;
    left: 0;
    width: 80px;
    height: 3px;
    background: linear-gradient(90deg, var(--accent), transparent);
    border-radius: 2px;
  }
  .hero-desc{
    margin:0; 
    opacity:.95; 
    max-width:760px;
    font-size: 1.1rem;
    line-height: 1.6;
  }

  /* ===== SHEET/CONTENT ===== */
  .sheet{
    background:var(--bg); 
    border-radius:var(--r); 
    box-shadow:var(--shadow-md); 
    overflow:hidden;
    transition: var(--transition);
    border: 1px solid rgba(111, 207, 151, 0.1);
  }
  .sheet:hover {
    box-shadow: var(--shadow-lg);
    transform: translateY(-5px);
  }
  .article-head{
    padding:1.5rem 1.25rem 1rem;
    background: linear-gradient(to bottom, rgba(111, 207, 151, 0.05), transparent);
    border-bottom: 1px solid rgba(111, 207, 151, 0.1);
  }
  .title{
    color:var(--ink); 
    font-weight:800; 
    line-height:1.25; 
    margin:.25rem 0 .75rem;
    font-size:clamp(1.35rem,1.1rem + 1.2vw,2rem);
    position: relative;
    padding-bottom: 0.75rem;
  }
  .title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 80px;
    height: 3px;
    background: linear-gradient(90deg, var(--brand), var(--accent));
    border-radius: 2px;
  }
  .meta{
    display:flex; 
    flex-wrap:wrap; 
    gap:.8rem 1.25rem; 
    color:var(--muted); 
    font-size:.95rem;
    padding: 0.75rem 0;
    border-top: 1px dashed rgba(0,0,0,0.08);
  }
  .meta span {
    display: flex;
    align-items: center;
    padding: 0.35rem 0.75rem;
    background: var(--light-bg);
    border-radius: 30px;
    transition: var(--transition);
  }
  .meta span:hover {
    background: rgba(111, 207, 151, 0.1);
    transform: translateY(-2px);
  }
  .meta i{color:var(--brand); margin-right:.35rem}

  /* ===== BREADCRUMB (di atas judul berita) ===== */
  .crumb{
    display:flex; 
    gap:.5rem; 
    align-items:center; 
    flex-wrap:wrap;
    margin:0 0 .35rem 0; 
    color:#6b7a75; 
    font-weight:600; 
    font-size:.95rem;
    padding: 0.5rem 0.75rem;
    background: rgba(255,255,255,0.1);
    border-radius: 10px;
    backdrop-filter: blur(5px);
  }
  .crumb a{
    color: #005f15ff ;
    text-decoration:none; 
    display:inline-flex; 
    align-items:center; 
    gap:.4rem;
    transition: var(--transition);
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
  }
  .crumb a:hover{
    
    color: #6fcf97 ;
    background: rgba(255,255,255,0.15);
    transform: translateY(-2px);
  }
  .crumb .sep{opacity:.6}

  /* ===== Konten ===== */
  .content{padding:1.25rem}
  .hero-img{
    border-radius:12px; 
    overflow:hidden; 
    box-shadow:var(--shadow-md); 
    margin-bottom:1.25rem;
    transition: var(--transition);
    position: relative;
  }
  .hero-img::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 5px;
    background: linear-gradient(90deg, var(--brand), var(--accent));
    border-radius: 12px 12px 0 0;
  }
  .hero-img:hover {
    transform: translateY(-5px);
    box-shadow: var(--shadow-lg);
  }
  .hero-img img{
    width:100%; 
    height:420px; 
    object-fit:cover;
    transition: var(--transition);
  }
  .hero-img:hover img {
    transform: scale(1.03);
  }
  .body-text{
    color:#495057; 
    line-height:1.85; 
    font-size:1.05rem;
    text-align: justify;
  }
  .body-text p {
    margin-bottom: 1.25rem;
  }
  .body-text img{
    max-width:100%; 
    height:auto; 
    border-radius:12px; 
    margin:1.35rem 0; 
    box-shadow:var(--shadow-md);
    transition: var(--transition);
  }
  .body-text img:hover {
    transform: scale(1.02);
    box-shadow: var(--shadow-lg);
  }
  .tag{
    display:inline-flex; 
    align-items:center; 
    gap:.4rem;
    background:linear-gradient(135deg,var(--brand),var(--accent));
    color:#fff; 
    padding:.45rem .9rem; 
    border-radius:999px; 
    font-weight:700; 
    font-size:.9rem;
    transition: var(--transition);
    box-shadow: 0 4px 12px rgba(111, 207, 151, 0.25);
  }
  .tag:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 16px rgba(111, 207, 151, 0.35);
  }

  /* ===== Komentar ===== */
  .section-title{
    font-weight:800; 
    color:var(--ink); 
    font-size:1.2rem; 
    margin:0 0 .75rem; 
    position:relative;
    padding-bottom: 0.75rem;
  }
  .section-title::after{
    content:""; 
    position:absolute; 
    left:0; 
    bottom:-6px; 
    width:56px; 
    height:3px;
    background:linear-gradient(90deg,var(--brand),var(--accent)); 
    border-radius:2px
  }
  .comment{
    display:flex; 
    gap:.9rem; 
    background:var(--light-bg); 
    border-radius:14px; 
    padding:1rem; 
    box-shadow:var(--shadow-sm); 
    margin-bottom:.9rem;
    transition: var(--transition);
    border-left: 3px solid transparent;
  }
  .comment:hover {
    border-left-color: var(--brand);
    transform: translateX(5px);
    box-shadow: var(--shadow-md);
  }
  .avatar{
    border-radius:50%; 
    width:56px; 
    height:56px; 
    object-fit:cover; 
    box-shadow:0 4px 12px rgba(0,0,0,.08);
    transition: var(--transition);
  }
  .avatar:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 16px rgba(0,0,0,.12);
  }
  .c-name{
    font-weight:700; 
    color:var(--ink); 
    margin:0;
    font-size: 1.05rem;
  }
  .c-time{
    font-size:.86rem; 
    color:var(--muted);
    margin-top: 0.25rem;
  }
  .c-body{
    margin:.35rem 0 0; 
    color:#4a5568;
    line-height: 1.6;
  }
  .reply-toggle{
    color:var(--brand); 
    font-weight:700; 
    text-decoration:none;
    display: inline-flex;
    align-items: center;
    gap: 0.35rem;
    padding: 0.25rem 0.5rem;
    border-radius: 6px;
    transition: var(--transition);
  }
  .reply-toggle:hover {
    background: rgba(111, 207, 151, 0.1);
    transform: translateY(-2px);
  }
  .reply-wrap{
    display:none; 
    margin-top:.65rem; 
    background:var(--bg); 
    border-radius:12px; 
    padding:.8rem; 
    box-shadow:var(--shadow-md);
    border: 1px solid rgba(111, 207, 151, 0.1);
    animation: fadeIn 0.3s ease-in-out;
  }
  @keyframes fadeIn {
    from { opacity: 0; transform: translateY(-10px); }
    to { opacity: 1; transform: translateY(0); }
  }

  /* ===== Sidebar ===== */
  .side-card{
    background:var(--bg); 
    border-radius:var(--r); 
    box-shadow:var(--shadow-md); 
    padding:1.1rem;
    transition: var(--transition);
    border: 1px solid rgba(111, 207, 151, 0.1);
  }
  .side-card:hover {
    box-shadow: var(--shadow-lg);
    transform: translateY(-5px);
  }
  .side-title{
    font-size:1.05rem; 
    font-weight:800; 
    color:var(--ink); 
    margin:0 0 .9rem; 
    position:relative;
    padding-bottom: 0.75rem;
  }
  .side-title::after{
    content:""; 
    position:absolute; 
    left:0; 
    bottom:-6px; 
    width:40px; 
    height:3px;
    background:linear-gradient(90deg,var(--brand),var(--accent)); 
    border-radius:2px
  }
  .pop-item{
    display:flex; 
    gap:.75rem; 
    align-items:flex-start; 
    padding:.6rem 0; 
    border-bottom:1px dashed #edf0f2;
    transition: var(--transition);
    border-radius: 8px;
    padding: 0.5rem;
  }
  .pop-item:hover {
    background: rgba(111, 207, 151, 0.05);
    transform: translateX(5px);
  }
  .pop-item:last-child{border-bottom:0}
  .pop-thumb{
    width:86px; 
    height:68px; 
    border-radius:10px; 
    overflow:hidden; 
    box-shadow:var(--shadow-sm); 
    flex-shrink:0;
    transition: var(--transition);
  }
  .pop-thumb:hover {
    transform: scale(1.05);
    box-shadow: var(--shadow-md);
  }
  .pop-thumb img{
    width:100%; 
    height:100%; 
    object-fit:cover;
    transition: var(--transition);
  }
  .pop-item:hover .pop-thumb img {
    transform: scale(1.1);
  }
  .pop-title{
    font-weight:700; 
    color:var(--ink); 
    margin:0;
    line-height: 1.4;
    transition: var(--transition);
  }
  .pop-link{
    text-decoration:none; 
    color:inherit;
  }
  .pop-item:hover .pop-title {
    color: var(--brand);
  }
  .cat-list{
    display:grid; 
    grid-template-columns:1fr; 
    gap:.35rem
  }
  .cat-link{
    display:flex; 
    align-items:center; 
    gap:.5rem; 
    text-decoration:none; 
    color:var(--ink);
    padding:.45rem .65rem; 
    border-radius:10px; 
    transition: var(--transition); 
    background:var(--light-bg);
    border-left: 3px solid transparent;
  }
  .cat-link:hover{
    transform:translateX(5px); 
    background:rgba(111, 207, 151, 0.1);
    border-left-color: var(--brand);
  }

  .btn-brand{
    background:linear-gradient(135deg,var(--brand),var(--accent));
    border:none; 
    color:#fff; 
    font-weight:700; 
    border-radius:12px;
    padding: 0.6rem 1.25rem;
    transition: var(--transition);
    box-shadow: 0 4px 12px rgba(111, 207, 151, 0.25);
  }
  .btn-brand:hover{
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(111, 207, 151, 0.35);
  }

  .form-control {
    border-radius: 12px;
    border: 1px solid #e9ecef;
    padding: 0.75rem 1rem;
    transition: var(--transition);
  }
  .form-control:focus {
    border-color: var(--brand);
    box-shadow: 0 0 0 0.25rem rgba(111, 207, 151, 0.1);
  }

  /* Responsif */
  @media (max-width:992px){ 
    .hero-img img{height:360px} 
    .side-card {
      margin-bottom: 1.5rem;
    }
  }
  @media (max-width:576px){
    .hero{
      border-radius:0 0 28px 0;
      margin-top: -60px;
      padding-top: 4rem;
    }
    .hero-img img{height:240px}
    .crumb a{color:#eafaf1}
    .title {
      font-size: 1.5rem;
    }
    .meta {
      flex-direction: column;
      gap: 0.5rem;
    }
    .meta span {
      width: 100%;
    }
  }
</style>

{{-- ===== HERO: Judul halaman & deskripsi ===== --}}
<section class="hero" role="banner" data-aos="fade-down">
  <div class="container">
    <div class="row align-items-center g-3">
      <div class="col-lg-8">
        <h1 class="hero-title"><i class="bi bi-article me-2"></i>Detail Berita</h1>
        <p class="hero-desc">Informasi lengkap mengenai kabar terbaru desa—ikuti perkembangan dan prestasi warga kami di halaman ini.</p>
      </div>
      <div class="col-lg-4 text-lg-end mt-3 mt-lg-0" aria-hidden="true">
        <img src="{{ asset('images/article-hero.svg') }}" class="img-fluid" alt="" loading="lazy" decoding="async">
      </div>
    </div>
  </div>
</section>

<section class="py-4">
  <div class="container">
    <div class="row g-4">
      <div class="col-lg-8">
        <article class="sheet" data-aos="fade-up">
          <header class="article-head">
            {{-- ===== BREADCRUMB tepat di atas JUDUL BERITA ===== --}}
            <nav aria-label="breadcrumb">
              <div class="crumb">
                <a href="{{ route('home') }}"><i class="bi bi-house-door-fill"></i> Beranda</a>
                <span class="sep">›</span>
                <a href="{{ url('/berita') }}"><i class="bi bi-newspaper"></i> Berita</a>
                <span class="sep">›</span>
                <span>{{ \Illuminate\Support\Str::limit($judul, 60) }}</span>
              </div>
            </nav>

            {{-- ===== JUDUL BERITA ===== --}}
            <h1 class="title">{{ $judul }}</h1>

            {{-- meta artikel --}}
            <div class="meta" aria-label="meta artikel">
              <span><i class="bi bi-calendar-event"></i>{{ $date }}</span>
              <span><i class="bi bi-stopwatch-fill"></i>{{ $ago }}</span>
              <span><i class="bi bi-person-circle"></i>{{ $author }}</span>
              <span><i class="bi bi-fire"></i>Dibaca <strong>{{ $views }}</strong> kali</span>
            </div>
          </header>

          <div class="content">
            <figure class="hero-img" data-aos="zoom-in" data-aos-delay="100">
              <img src="{{ $img }}" alt="{{ $judul }}" loading="lazy" decoding="async"
                   onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ urlencode($judul) }}&background=random';">
            </figure>

            <div class="body-text">
              {!! $berita->body !!}
            </div>

            <div class="mt-3 text-center">
              <a href="{{ $katSlug === '#' ? '#' : url('/kategori/'.$katSlug) }}" class="tag">
                <i class="bi bi-tags-fill"></i> {{ $katName }}
              </a>
            </div>
          </div>
        </article>

        {{-- ===== KOMENTAR ===== --}}
        <section class="sheet mt-3" data-aos="fade-up" data-aos-delay="200">
          <div class="p-3 p-md-4">
            <h3 class="section-title"><i class="bi bi-chat-dots me-2"></i> Komentar</h3>

            @forelse ($berita->comments as $comment)
              @php
                $emailHash = md5(strtolower(trim($comment->email ?? '')));
                $avatarUrl = "https://www.gravatar.com/avatar/{$emailHash}?s=72&d=identicon";
              @endphp

              <div class="comment" data-aos="fade-up" data-aos-delay="{{ 100 + $loop->index * 50 }}">
                <img class="avatar" src="{{ $avatarUrl }}" alt="" loading="lazy" decoding="async">
                <div class="flex-grow-1">
                  <div class="d-flex justify-content-between align-items-start">
                    <div>
                      <p class="c-name">{{ $comment->nama ?? 'Pengunjung' }}</p>
                      <div class="c-time">{{ optional($comment->created_at)->diffForHumans() ?? '' }}</div>
                    </div>
                    <a href="javascript:void(0)" class="reply-toggle" data-reply="{{ $comment->id }}">
                      <i class="bi bi-reply-fill"></i> Balas
                    </a>
                  </div>
                  <p class="c-body">{{ $comment->body }}</p>

                  {{-- Balasan --}}
                  @foreach ($comment->replies as $reply)
                    @php
                      $replyEmail = $reply->replyEmail ?? $reply->email ?? '';
                      $replyNama  = $reply->replyNama ?? $reply->nama ?? 'Pengunjung';
                      $replyBody  = $reply->replyBody ?? $reply->body ?? '';
                      $replyHash  = md5(strtolower(trim($replyEmail)));
                      $replyAvatar = "https://www.gravatar.com/avatar/{$replyHash}?s=60&d=identicon";
                    @endphp
                    <div class="comment" style="margin-top:.75rem" data-aos="fade-up" data-aos-delay="{{ 150 + $loop->index * 50 }}">
                      <img class="avatar" src="{{ $replyAvatar }}" alt="" width="52" height="52" loading="lazy" decoding="async" style="width:52px;height:52px;">
                      <div class="flex-grow-1">
                        <p class="c-name mb-0">{{ $replyNama }}</p>
                        <div class="c-time">{{ optional($reply->created_at)->diffForHumans() ?? '' }}</div>
                        <p class="c-body">{{ $replyBody }}</p>
                      </div>
                    </div>
                  @endforeach

                  {{-- Form balasan --}}
                  <div id="replyForm{{ $comment->id }}" class="reply-wrap">
                    <form action="{{ url('/berita/'.$slug.'/reply') }}" method="POST">
                      @csrf
                      <input type="hidden" name="comment_id" value="{{ $comment->id }}">
                      <input type="hidden" name="parent_id"  value="{{ $comment->id }}">
                      <div class="row g-2">
                        <div class="col-md-4">
                          <input type="text" name="replyNama" class="form-control" placeholder="Nama">
                        </div>
                        <div class="col-md-4">
                          <input type="email" name="replyEmail" class="form-control" placeholder="Email">
                        </div>
                        <div class="col-12">
                          <textarea name="replyBody" rows="3" class="form-control" placeholder="Balasan komentar"></textarea>
                        </div>
                        <div class="col-12 mt-1">
                          <button class="btn btn-brand btn-sm" type="submit"><i class="bi bi-send me-1"></i>Kirim Balasan</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            @empty
              <div class="text-center py-4" data-aos="fade-up">
                <i class="bi bi-chat-square-text" style="font-size: 3rem; color: #dee2e6;"></i>
                <p class="text-muted mt-2 mb-0">Belum ada komentar.</p>
              </div>
            @endforelse

            <hr class="my-4">

            <h4 class="section-title" style="margin-top:.75rem"><i class="bi bi-pencil-square me-2"></i> Tinggalkan Komentar</h4>
            <form method="POST" action="{{ url('/berita/'.$slug) }}">
              @csrf
              <div class="mb-3">
                <label for="nama" class="form-label fw-semibold">Nama</label>
                <input type="text" id="nama" name="nama" class="form-control @error('nama') is-invalid @enderror" placeholder="Masukkan nama Anda">
                @error('nama')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" id="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Masukkan email Anda">
                @error('email')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <div class="mb-3">
                <label for="body" class="form-label fw-semibold">Komentar</label>
                <textarea id="body" name="body" rows="6" class="form-control @error('body') is-invalid @enderror" placeholder="Tulis komentar Anda"></textarea>
                @error('body')<div class="invalid-feedback">{{ $message }}</div>@enderror
              </div>
              <button type="submit" class="btn btn-brand"><i class="bi bi-send me-2"></i>Kirim Komentar</button>
            </form>
          </div>
        </section>
      </div>

      <aside class="col-lg-4">
        <div class="side-card" data-aos="fade-left" data-aos-delay="300">
          <h5 class="side-title"><i class="bi bi-graph-up-arrow me-1"></i> Berita Populer</h5>
          @forelse($beritaPopuler as $pop)
            @php
              $pJudul = $pop->judul ?? 'Tanpa Judul';
              $pImg   = $pop->gambar ? asset('storage/'.$pop->gambar) : 'https://ui-avatars.com/api/?name='.urlencode($pJudul).'&background=random';
            @endphp
            <div class="pop-item" data-aos="fade-up" data-aos-delay="{{ 350 + $loop->index * 50 }}">
              <div class="pop-thumb">
                <img src="{{ $pImg }}" alt="{{ $pJudul }}" loading="lazy" decoding="async"
                     onerror="this.onerror=null;this.src='https://ui-avatars.com/api/?name={{ urlencode($pJudul) }}&background=random';">
              </div>
              <div class="flex-grow-1">
                <a class="pop-link" href="{{ url('/berita/'.$pop->slug) }}"><p class="pop-title">{{ $pJudul }}</p></a>
              </div>
            </div>
          @empty
            <p class="text-muted mb-0">Belum ada data.</p>
          @endforelse
        </div>

        <div class="side-card mt-3" data-aos="fade-left" data-aos-delay="400">
          <h5 class="side-title"><i class="bi bi-collection me-1"></i> Kategori</h5>
          @if(isset($kategories) && $kategories->count())
            <div class="cat-list">
              @foreach($kategories as $kategori)
                <a class="cat-link" href="{{ url('/kategori/'.$kategori->slug) }}" data-aos="fade-up" data-aos-delay="{{ 450 + $loop->index * 50 }}">
                  <i class="bi bi-hash" style="color:var(--brand)"></i> {{ $kategori->kategori }}
                </a>
              @endforeach
            </div>
          @else
            <p class="text-muted mb-0">Belum ada kategori.</p>
          @endif
        </div>
      </aside>
    </div>
  </div>
</section>

<script>
  // Toggle form balasan komentar (tanpa inline onclick)
  document.addEventListener('DOMContentLoaded', function(){
    document.querySelectorAll('[data-reply]').forEach(function(btn){
      btn.addEventListener('click', function(){
        const id = this.getAttribute('data-reply');
        const el = document.getElementById('replyForm' + id);
        if(!el) return;
        const shown = getComputedStyle(el).display !== 'none';
        el.style.display = shown ? 'none' : 'block';
      });
    });
  });
</script>

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
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
@endsection