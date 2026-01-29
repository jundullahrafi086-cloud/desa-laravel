<!-- ======= Footer ======= -->
<style>
  /* === Copyright: putih; hover -> hijau + underline === */
#footer .copyright{
  color: #fff;                   /* teks default putih */
}

#footer .copyright a{
  color: #fff;                   /* link default putih */
  text-decoration: none;         /* tanpa underline saat normal */
  transition: color .2s ease, text-decoration-color .2s ease;
}

#footer .copyright a:hover,
#footer .copyright a:focus-visible{
  color: #38ef7d;                /* hijau saat hover/focus */
  text-decoration: underline;    /* underline saat hover/focus */
  text-underline-offset: 3px;    /* biar rapi */
  text-decoration-thickness: 2px;
}

/* (opsional) saat aktif/klik, tetap hijau */
#footer .copyright a:active{
  color: #2dd96a;
}

  /* Footer Styles - Same Green as Header */
  #footer {
    position: relative;
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    color: white;
    padding: 0;
    margin-top: 3rem;
    font-family: 'Open Sans', sans-serif;
    overflow: hidden;
    box-shadow: 0 -10px 30px rgba(0, 0, 0, 0.1);
  }

  #footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    opacity: 0.15;
    z-index: 0;
  }

  .footer-top {
    background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
    padding: 80px 0 60px;
    position: relative;
    overflow: hidden;
    z-index: 1;
  }

  .footer-top::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -50%;
    width: 200%;
    height: 200%;
    background: radial-gradient(circle, rgba(56, 239, 126, 0.93) 0%, transparent 70%);
    animation: float 25s infinite linear;
    z-index: 0;
  }

  .footer-top::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, transparent, rgba(51, 255, 0, 0.69), transparent);
    animation: shine 3s infinite linear;
  }

  @keyframes float {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
  }

  @keyframes shine {
    0% { transform: translateX(-100%); }
    100% { transform: translateX(100%); }
  }

  .footer-top .container {
    position: relative;
    z-index: 2;
  }

  .footer-info {
    margin-bottom: 30px;
    position: relative;
    padding-right: 30px;
  }

  .footer-info::after {
    content: '';
    position: absolute;
    top: 10%;
    right: 0;
    bottom: 10%;
    width: 2px;
    background: linear-gradient(to bottom, transparent, rgba(49, 211, 8, 0.97), transparent);
  }

  .footer-info img {
    max-width: 160px;
    margin-bottom: 25px;
    border-radius: 15px;
    background: white;
    padding: 12px;
    box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
    transition: all 0.5s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    border: 3px solid rgba(255, 255, 255, 0.2);
    position: relative;
    z-index: 1;
  }

  .footer-info img::before {
    content: '';
    position: absolute;
    top: -5px;
    left: -5px;
    right: -5px;
    bottom: -5px;
    background: linear-gradient(45deg, #11998e 0%, #38ef7d 50%, #2dd06e 100%);
    background-size: 400% 400%;
    border-radius: 18px;
    z-index: -1;
    opacity: 0;
    transition: opacity 0.5s ease;
    animation: gradient 15s ease infinite;
  }

  .footer-info img:hover::before {
    opacity: 0.7;
  }

  @keyframes gradient {
    0% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
    100% { background-position: 0% 50%; }
  }

  .footer-info img:hover {
    transform: translateY(-10px) scale(1.05) rotate(2deg);
    box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
  }

  .footer-info h3 {
    font-size: 32px;
    font-weight: 800;
    margin-bottom: 25px;
    color: white;
    text-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    position: relative;
    display: inline-block;
    letter-spacing: 1px;
  }

  .footer-info h3::after {
    content: '';
    position: absolute;
    bottom: -12px;
    left: 0;
    width: 100px;
    height: 5px;
    background: #38ef7d;
    border-radius: 3px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
  }

  .footer-info p {
    font-size: 16px;
    line-height: 1.8;
    color: rgba(255, 255, 255, 0.95);
    margin-bottom: 15px;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
  }

  .footer-info strong {
    color: #38ef7d;
    font-weight: 700;
    display: inline-block;
    margin-right: 5px;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
  }

  .footer-links {
    position: relative;
    padding-left: 20px;
  }

  .footer-links h4 {
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 25px;
    color: white;
    position: relative;
    padding-bottom: 15px;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    text-shadow: 0 2px 8px rgba(0, 0, 0, 0.3);
  }

  .footer-links h4::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 70px;
    height: 4px;
    background: #38ef7d;
    border-radius: 2px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.2);
  }

  /* Perfect UL and LI structure */
  .footer-links ul {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    flex-direction: column;
    gap: 15px;
  }

  .footer-links ul li {
    position: relative;
    margin: 0;
    padding: 0;
    border-radius: 10px;
    overflow: hidden;
    transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
    background: rgba(255, 255, 255, 0.05);
    backdrop-filter: blur(5px);
  }

  .footer-links ul li::before {
    content: '';
    position: absolute;
    left: 0;
    top: 0;
    bottom: 0;
    width: 0;
    background: linear-gradient(to bottom, #38ef7d, #11998e);
    transition: width 0.4s ease;
    border-radius: 10px 0 0 10px;
  }

  .footer-links ul li:hover::before {
    width: 5px;
  }

  .footer-links ul li i {
    display: none;
  }

  .footer-links ul li a {
    color: rgba(255, 255, 255, 0.9);
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 15px;
    font-weight: 500;
    display: flex;
    align-items: center;
    padding: 12px 15px 12px 20px;
    position: relative;
    z-index: 1;
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.2);
  }

  .footer-links ul li a::before {
    content: '\f054';
    font-family: 'Font Awesome 5 Free';
    font-weight: 900;
    margin-right: 12px;
    font-size: 13px;
    transition: all 0.3s ease;
    color: #38ef7d;
  }

  .footer-links ul li:hover {
    transform: translateX(8px);
    background: rgba(255, 255, 255, 0.15);
    box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
  }

  .footer-links ul li:hover a::before {
    transform: translateX(5px);
    color: white;
  }

  .footer-links ul li a:hover {
    color: white;
  }

  .copyright {
    padding: 30px 0;
    text-align: center;
    font-size: 16px;
    background: rgba(0, 0, 0, 0.25);
    border-top: 1px solid rgba(255, 255, 255, 0.15);
    position: relative;
    z-index: 2;
    backdrop-filter: blur(10px);
    text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
  }

  .copyright strong {
    font-weight: 700;
    color: #38ef7d;
    position: relative;
    display: inline-block;
  }

  .copyright strong::after {
    content: '';
    position: absolute;
    bottom: -2px;
    left: 0;
    right: 0;
    height: 2px;
    background: rgba(56, 239, 125, 0.5);
    border-radius: 1px;
  }

  /* Responsive Perfection */
  @media (max-width: 992px) {
    .footer-info {
      margin-bottom: 50px;
      padding-right: 0;
    }

    .footer-info::after {
      display: none;
    }

    .footer-links {
      padding-left: 0;
      margin-bottom: 30px;
    }
  }

  @media (max-width: 768px) {
    .footer-top {
      padding: 60px 0 40px;
    }

    .footer-info img {
      max-width: 130px;
      margin-bottom: 20px;
    }

    .footer-info h3 {
      font-size: 26px;
      margin-bottom: 20px;
    }

    .footer-info h3::after {
      width: 80px;
    }

    .footer-info p {
      font-size: 15px;
    }

    .footer-links h4 {
      font-size: 20px;
      margin-bottom: 20px;
    }

    .footer-links h4::after {
      width: 60px;
    }

    .footer-links ul {
      gap: 12px;
    }
  }

  @media (max-width: 576px) {
    .footer-top {
      padding: 50px 0 30px;
    }

    .footer-info h3 {
      font-size: 24px;
    }

    .footer-links h4 {
      font-size: 18px;
      margin-bottom: 15px;
    }

    .footer-links h4::after {
      width: 50px;
    }

    .footer-links ul {
      gap: 10px;
    }

    .footer-links ul li a {
      padding: 10px 12px 10px 15px;
      font-size: 14px;
    }

    .copyright {
      font-size: 14px;
      padding: 25px 0;
    }
  }
</style>

<!-- Add Font Awesome for icons -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

<footer id="footer">

  <div class="container">
    <div class="copyright">
      &copy; Copyright <strong><span>2025</span></strong>. || Repost By :  <a href="/">PKL Universitas Cipasung 2025</a>
    </div>
  </div>
</footer>
<!-- End Footer -->
