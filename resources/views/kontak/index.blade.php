@extends('layouts.main')

@section('content')
<style>
  /* ===== Styling Info Box dengan Warna Hijau #6fcf97 ===== */
  .contact .info-box {
    background: #6fcf97; /* hijau lembut */
    color: #fff;
    padding: 20px;
    border-radius: 12px;
    box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
    transition: transform .2s ease, box-shadow .2s ease;
  }

  .contact .info-box:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
  }

  .contact .info-box i {
    font-size: 2rem;
    color: #fff;
    margin-bottom: 10px;
    display: block;
  }

  .contact .info-box h3 {
    font-size: 1.3rem;
    margin-bottom: 10px;
    font-weight: bold;
    color: #fff;
  }

  .contact .info-box p {
    margin: 0;
    font-size: 1rem;
    color: #fff;
  }
</style>

<!-- ======= Contact Us Section ======= -->
<section id="contact" class="contact">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>Kontak Kami</h2>
    </div>

    <div class="row g-4">
      <div class="col-lg-6 d-flex" data-aos="fade-up">
        <div class="info-box w-100">
          <i class="bx bx-map"></i>
          <h3>Lokasi Desa</h3>
          <p class="mb-3">{{ $kontak->lokasi }}</p>
          <div class="card-body p-0">
            <iframe width="100%" height="360" style="border-radius: 10px;" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" id="gmap_canvas" src="https://maps.google.com/maps?width=520&amp;height=402&amp;hl=en&amp;q={{ urlencode($kontak->lokasi) }}&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe>
          </div>
        </div>
      </div>

      <div class="col-lg-6 d-flex flex-column gap-4" data-aos="fade-up">
        <div class="info-box flex-fill d-flex flex-column justify-content-center py-4">
          <div class="mx-auto text-center">
            <i class="bx bx-envelope"></i>
            <h3>Email Kami</h3>
            <p>{{ $kontak->email }}</p>
          </div>
        </div>

        <div class="info-box flex-fill d-flex flex-column justify-content-center py-4">
          <div class="mx-auto text-center">
            <i class="bx bx-phone-call"></i>
            <h3>Nomor HP / WhatsApp Kami</h3>
            <p>+62 {{ ltrim($kontak->no_hp, '0') }}</p>
          </div>
        </div>
      </div>

    </div>
  </div>
</section><!-- End Contact Us Section -->
@endsection
