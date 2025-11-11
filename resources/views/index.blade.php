@extends('layouts.main')

@section('content')

<script src="https://cdn.tailwindcss.com"></script>
<style>
  @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

  :root {
    --primary-color: #28a745;
    --primary-dark: #218838;
    --secondary-color: #17a2b8;
    --accent-color: #007bff;
    --text-dark: #2c3e50;
    --text-light: #6c757d;
    --bg-light: #f8f9fa;
    --bg-white: #ffffff;
  }

  html,
  body {
    height: 99%;
    margin: 0;
    padding: 0;
  }

  body {
    font-family: 'Poppins', sans-serif;
    background-color: var(--bg-light);
    color: var(--text-dark);
  }

  /* Container with side spacing like Puskesmas Setiabudi */
  section .container {
    max-width: 1320px;
    padding-left: 2rem;
    padding-right: 2rem;
    margin-left: auto;
    margin-right: auto;
  }

  @media (max-width: 768px) {
    section .container {
      padding-left: 1rem;
      padding-right: 1rem;
    }
  }

  /* Section Titles */
  .section-title {
    text-align: center;
    margin-bottom: 3rem;
  }

  .section-title h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 0.5rem;
    position: relative;
    display: inline-block;
  }

  .section-title h2::after {
    content: '';
    position: absolute;
    bottom: -10px;
    left: 50%;
    transform: translateX(-50%);
    width: 80px;
    height: 4px;
    background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
    border-radius: 2px;
  }

  .section-title p {
    font-size: 1.1rem;
    color: var(--text-light);
    margin-top: 1rem;
  }

  /* Button Styles - Simple like Puskesmas Setiabudi */
  .btn-view-all {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: transparent;
    color: var(--primary-color);
    border: 2px solid var(--primary-color);
    padding: 0.65rem 1.75rem;
    font-weight: 600;
    font-size: 0.95rem;
    border-radius: 5px;
    text-decoration: none;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .btn-view-all:hover {
    background: var(--primary-color);
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.25);
  }

  .btn-view-all i {
    font-size: 1rem;
    transition: transform 0.3s ease;
  }

  .btn-view-all:hover i {
    transform: translateX(3px);
  }

  /* Berita Card Styles - Puskesmas Setiabudi Style */
  .berita-card {
    background: white;
    border-radius: 0;
    overflow: hidden;
    box-shadow: none;
    border: 1px solid #e0e0e0;
    height: 100%;
    display: flex;
    flex-direction: column;
  }

  .berita-image-wrapper {
    position: relative;
    height: 280px;
    overflow: hidden;
    border-radius: 0;
  }

  .berita-img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .berita-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(255, 255, 255, 0.95);
    color: #333;
    padding: 0.4rem 1rem;
    border-radius: 25px;
    font-size: 0.75rem;
    font-weight: 700;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    z-index: 3;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
  }

  .berita-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.7) 100%);
    z-index: 2;
    transition: background 0.3s ease;
  }

  .berita-card:hover .berita-overlay {
    background: linear-gradient(to bottom, transparent 0%, rgba(0, 0, 0, 0.8) 100%);
  }

  .berita-meta {
    display: flex;
    justify-content: space-between;
    padding: 1rem 1.5rem;
    background: #f8f9fa;
    border-bottom: 1px solid #e9ecef;
  }

  .meta-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    font-size: 0.8rem;
    color: #666;
  }

  .meta-item i {
    color: var(--primary-color);
    font-size: 0.9rem;
  }

  .berita-content {
    padding: 1.5rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
  }

  .berita-title {
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 1rem;
    line-height: 1.4;
  }

  .berita-title a {
    color: var(--text-dark);
    text-decoration: none;
    transition: color 0.3s ease;
  }

  .berita-title a:hover {
    color: var(--primary-color);
  }

  .berita-description {
    font-size: 0.9rem;
    color: var(--text-light);
    line-height: 1.6;
    margin-bottom: 1.5rem;
    flex-grow: 1;
  }

  .btn-baca {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--primary-color);
    font-weight: 700;
    font-size: 0.85rem;
    text-decoration: none;
    letter-spacing: 0.5px;
    transition: all 0.3s ease;
  }

  .btn-baca:hover {
    gap: 0.75rem;
    color: var(--primary-dark);
  }

  .btn-baca i {
    transition: transform 0.3s ease;
  }

  .btn-baca:hover i {
    transform: translateX(3px);
  }

  /* Sambutan Section */
  #sambutan {
    background: linear-gradient(135deg, #ffffff 0%, #f8f9fa 100%);
    padding: 5rem 0;
  }

  #sambutan .sambutan-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 10px 40px rgba(0, 0, 0, 0.08);
    overflow: hidden;
    padding: 0;
  }

  #sambutan .sambutan-image {
    position: relative;
    height: 100%;
    min-height: 450px;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    background: #f8f9fa;
  }

  #sambutan .sambutan-image img {
    width: 100%;
    height: 100%;
    object-fit: contain;
    border-radius: 8px;
  }

  #sambutan .sambutan-content {
    padding: 3rem;
  }

  #sambutan .sambutan-title {
    font-size: 2rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
  }

  #sambutan .sambutan-position {
    font-size: 1.1rem;
    color: var(--primary-color);
    font-weight: 600;
    margin-bottom: 1.5rem;
  }

  #sambutan .sambutan-text {
    font-size: 1rem;
    color: var(--text-light);
    line-height: 1.8;
    text-align: justify;
  }

  @media (max-width: 991px) {
    #sambutan .sambutan-image {
      min-height: 350px;
      padding: 1.5rem;
    }
    
    #sambutan .sambutan-content {
      padding: 2rem;
    }
  }

  @media (max-width: 767px) {
    #sambutan .sambutan-image {
      min-height: 300px;
      padding: 1rem;
    }
  }

  .skm-summary-box {
    background-color: #ffffff;
    /* White background */
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
    /* Soft shadow */
    padding: 2.5rem 2rem;
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 1.5rem;
    /* Space between elements */
  }

  .skm-score-circle {
    width: 120px;
    /* Diameter */
    height: 120px;
    border-radius: 50%;
    background: linear-gradient(135deg, #007bff 0%, #0056b3 100%);
    /* Blue gradient */
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 2.5rem;
    /* For score number */
    font-weight: 700;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    /* Shadow for the circle */
  }

  .skm-score-circle span {
    display: block;
    /* Ensure score number is on its own line */
  }

  .skm-progress-indicator {
    height: 8px;
    /* Thinner progress bar */
    border-radius: 4px;
    background-color: #e0e0e0;
    overflow: hidden;
    width: 100%;
  }

  .skm-progress-fill {
    height: 100%;
    border-radius: 4px;
    background: linear-gradient(90deg, #28a745 0%, #218838 100%);
    /* Green gradient for fill */
    transition: width 0.5s ease-out;
    width: var(--skm-progress-width, 0%);
    /* Variabel CSS untuk lebar */
  }

  /* Specific styles for SKM Detail Cards */
  .skm-detail-card {
    background-color: #ffffff;
    border-radius: 12px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    padding: 1.5rem;
    display: flex;
    flex-direction: column;
    gap: 1rem;
  }

  .skm-detail-card-header {
    display: flex;
    align-items: center;
    gap: 0.75rem;
    padding-bottom: 1rem;
    border-bottom: 1px solid #eee;
  }

  .skm-detail-card-header i {
    font-size: 1.8rem;
    color: #007bff;
    /* Blue icon */
  }

  .skm-detail-card-header h3 {
    font-size: 1.25rem;
    font-weight: 600;
    color: #343a40;
  }

  .skm-data-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
  }

  .skm-data-item span:first-child {
    font-size: 0.9rem;
    color: #6c757d;
  }

  .skm-data-item span:last-child {
    font-size: 0.95rem;
    font-weight: 500;
    color: #343a40;
  }

  .skm-icon-square {
    width: 45px;
    height: 45px;
    border-radius: 8px;
    background-color: #e6f2ff;
    /* Light blue background for icon square */
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .skm-icon-square i {
    font-size: 1.5rem;
    color: #007bff;
    /* Blue color for icons */
  }

  .skm-total-box {
    background-color: #f8f9fa;
    /* Light gray background */
    border-radius: 8px;
    padding: 1rem;
    text-align: center;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
  }

  .skm-total-box .number {
    font-size: 2.5rem;
    font-weight: 700;
    color: #343a40;
    margin-top: 0.5rem;
  }

  .skm-total-box .label {
    font-size: 0.8rem;
    color: #6c757d;
    margin-top: 0.25rem;
  }

  .skm-total-box .sub-label {
    font-size: 0.7rem;
    color: #adb5bd;
  }

  /* Button Isi Survey */
  .btn-isi-survey {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    background: #17a2b8;
    color: white;
    padding: 0.75rem 2rem;
    font-weight: 600;
    font-size: 0.95rem;
    border-radius: 5px;
    text-decoration: none;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
    box-shadow: 0 4px 12px rgba(23, 162, 184, 0.3);
  }

  .btn-isi-survey:hover {
    background: #138496;
    color: white;
    transform: translateY(-2px);
    box-shadow: 0 6px 16px rgba(23, 162, 184, 0.4);
  }

  .btn-isi-survey i {
    font-size: 1.1rem;
  }

  /* --- END SKM Section Styles --- */


  /* --- START HERO Section Styles --- */
  #hero {
    width: 100%;
    height: calc(90vh - 0px);
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
    padding: 0;
    margin-top: 0;
  }

  #hero .hero-container {
    width: 100%;
    height: 100%;
    position: absolute;
    top: 0;
    left: 0;
  }

  #heroCarousel.carousel {
    width: 100%;
    height: 100%;
  }

  #hero .carousel-inner {
    width: 100%;
    height: 100%;
  }

  #hero .carousel-item {
    width: 100%;
    height: 100%;
    position: relative;
  }

  #hero .carousel-item img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: center;
  }

  #hero .carousel-overlay {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: rgba(0, 0, 0, 0.3);
    z-index: 1;
  }

  /* Carousel Indicators */
  #hero-carousel-indicators {
    bottom: 20px;
    z-index: 2;
  }

  #hero-carousel-indicators li {
    background-color: rgba(255, 255, 255, 0.5);
    border: none;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    margin: 0 5px;
  }

  #hero-carousel-indicators li.active {
    background-color: #fff;
  }

  /* Carousel Controls */
  #heroCarousel .carousel-control-prev,
  #heroCarousel .carousel-control-next {
    width: 5%;
    z-index: 2;
  }

  #heroCarousel .carousel-control-prev-icon,
  #heroCarousel .carousel-control-next-icon {
    font-size: 30px;
  }

  /* Carousel Caption Custom - Bottom */
  .carousel-caption-custom {
    position: absolute;
    bottom: 80px;
    left: 50%;
    transform: translateX(-50%);
    z-index: 3;
    text-align: center;
    width: 90%;
    max-width: 800px;
  }

  .carousel-caption-custom h2 {
    color: white;
    font-size: 2.5rem;
    font-weight: 700;
    text-align: center;
    margin: 0;
    line-height: 1.3;
    text-shadow: 2px 2px 8px rgba(0, 0, 0, 0.7);
  }

  /* Responsive Adjustments for Hero */
  @media (max-width: 991px) {
    #hero {
      height: calc(60vh - 0px);
    }

    .carousel-caption-custom {
      bottom: 60px;
    }

    .carousel-caption-custom h2 {
      font-size: 2rem;
    }
  }

  @media (max-width: 767px) {
    #hero {
      height: calc(50vh - 0px);
    }

    #heroCarousel .carousel-control-prev,
    #heroCarousel .carousel-control-next {
      width: 10%;
    }

    .carousel-caption-custom {
      bottom: 50px;
    }

    .carousel-caption-custom h2 {
      font-size: 1.5rem;
    }
  }

  /* --- END HERO Section Styles --- */

  /* Styles for section titles */
  .section-title {
    background-color: #f9fafb;
    /* Set section title background to match body */
    padding-top: 2rem;
    /* Add some padding if needed for visual separation */
    padding-bottom: 1rem;
    margin-bottom: 2rem;
    /* Space below the title */
  }

  .section-title h2 {
    text-align: center;
    font-size: 2rem;
    /* Example font size, adjust as needed */
    font-weight: 700;
    color: #333;
    position: relative;
    display: inline-block;
    /* To allow padding/margin for pseudo-elements if desired */
    width: 100%;
    /* Ensure it takes full width for centering */
  }
</style>


<section id="hero">
  <div class="hero-container">
    <div id="heroCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">
      <ol class="carousel-indicators" id="hero-carousel-indicators"></ol>
      <div class="carousel-inner" role="listbox">
        @foreach ($sliders as $key => $slider)
        <div class="{{ $key === 0 ? 'carousel-item active' : 'carousel-item' }}">
          <img src="{{ asset('storage/' . $slider->img_slider) }}" class="d-block w-100" alt="Slider {{ $key + 1 }}" loading="{{ $key === 0 ? 'eager' : 'lazy' }}">
          <div class="carousel-overlay"></div>
          <div class="carousel-caption-custom">
            <h2>Selamat Datang di Web Resmi<br>{{ $nm_puskesmas ?? 'Puskesmas' }}</h2>
          </div>
        </div>
        @endforeach
      </div>
      <a class="carousel-control-prev" href="#heroCarousel" role="button" data-bs-slide="prev">
        <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
      </a>
      <a class="carousel-control-next" href="#heroCarousel" role="button" data-bs-slide="next">
        <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
      </a>
    </div>
  </div>
</section>

{{-- ======= Sambutan Kepala Puskesmas Section ======= --}}
@if($sambutan)
<section id="sambutan">
  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <h2>Sambutan Kepala Puskesmas</h2>
      <p>Pesan dari pimpinan Puskesmas</p>
    </div>
    <div class="sambutan-card">
      <div class="row g-0">
        <div class="col-lg-4" data-aos="fade-right">
          <div class="sambutan-image">
            @if($sambutan->foto)
              <img src="{{ asset('storage/' . $sambutan->foto) }}" alt="{{ $sambutan->nama }}" loading="lazy">
            @else
              <img src="{{ asset('assets/img/default-avatar.png') }}" alt="{{ $sambutan->nama }}" loading="lazy">
            @endif
          </div>
        </div>
        <div class="col-lg-8" data-aos="fade-left">
          <div class="sambutan-content">
            <h3 class="sambutan-title">{{ $sambutan->nama }}</h3>
            <p class="sambutan-position">{{ $sambutan->jabatan }}</p>
            <div class="sambutan-text">
              {!! nl2br(e($sambutan->isi_sambutan)) !!}
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endif

{{-- ======= Berita Section ======= --}}
<section id="berita" class="services py-5" style="background: white;">
  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <h2>Berita</h2>
      <p>Informasi terkini seputar kegiatan dan layanan Puskesmas</p>
    </div>
    <div class="row">
      @foreach ($beritas as $berita)
      <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
        <div class="berita-card">
          <div class="berita-image-wrapper">
            <img src="{{ asset('storage/' . $berita->gambar) }}" alt="{{ $berita->judul }}" class="berita-img" loading="lazy">
            <span class="berita-badge">{{ $berita->kategori->nama_kategori ?? 'Umum' }}</span>
            <div class="berita-overlay"></div>
          </div>
          <div class="berita-meta">
            <div class="meta-item">
              <i class="bi bi-calendar3"></i>
              <span>{{ $berita->created_at->format('d M Y H:i:s') }}</span>
            </div>
            <div class="meta-item">
              <i class="bi bi-chat-dots"></i>
              <span>{{ $berita->comments_count ?? 0 }} Comments</span>
            </div>
          </div>
          <div class="berita-content">
            <h5 class="berita-title">
              <a href="/berita/{{ $berita->slug }}">
                {{ $berita->judul }}
              </a>
            </h5>
            <p class="berita-description">{{ Str::limit(strip_tags($berita->excerpt), 120) }}</p>
            <a href="/berita/{{ $berita->slug }}" class="btn-baca">
              BACA SELENGKAPNYA <i class="bi bi-chevron-right"></i>
            </a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="text-center mt-5">
      <a class="btn-view-all" href="/berita">
        Lihat Selengkapnya <i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </div>
</section>
      </div>
    </div>
  </div>
</section>

{{-- ======= Layanan Kesehatan Section ======= --}}
<section id="layanan">
  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <h2>Layanan</h2>
      <p>Berbagai layanan kesehatan yang tersedia di Puskesmas</p>
    </div>
    <div class="row justify-content-center">
      @foreach ($layanans as $layanan)
      <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
        <div class="layanan-card-wrapper">
          <!-- Image Section with Icon -->
          <div class="layanan-image-section {{ (!$layanan->gambar || !file_exists(public_path('storage/' . $layanan->gambar))) ? 'no-image' : '' }}" 
               @if($layanan->gambar && file_exists(public_path('storage/' . $layanan->gambar))) 
               style="background-image: url('{{ asset('storage/' . $layanan->gambar) }}'); background-size: cover; background-position: center;"
               @endif>
            <!-- Tidak ada overlay jika ada gambar, biarkan gambar terlihat penuh -->
            
            <div class="layanan-badge">
              Layanan {{ $loop->iteration }}
            </div>
            
            @if(!$layanan->gambar || !file_exists(public_path('storage/' . $layanan->gambar)))
            <div class="layanan-icon-large">
              <i class="bi bi-heart-pulse"></i>
            </div>
            @endif
          </div>
          
          <!-- Content Section -->
          <div class="layanan-content">
            <h3 class="layanan-title-main">{{ $layanan->nama_layanan }}</h3>
            
            <p class="layanan-description-text">
              {!! Str::limit(strip_tags($layanan->deskripsi), 150) !!}
            </p>
            
            <div class="layanan-meta-info">
              @if($layanan->biaya)
              <div class="layanan-price">
                <i class="bi bi-cash-coin"></i>
                <span>{{ $layanan->biaya }}</span>
              </div>
              @else
              <div></div>
              @endif
              
              <span class="layanan-status-badge {{ $layanan->status == 'Tersedia' ? 'status-tersedia' : 'status-tidak-tersedia' }}">
                {{ $layanan->status }}
              </span>
            </div>
            
            <a href="/layanan" class="btn-read-more">
              Read More <i class="bi bi-arrow-right"></i>
            </a>
          </div>
        </div>
      </div>
      @endforeach
    </div>
    <div class="text-center mt-5">
      <a class="btn-view-all" href="/layanan">
        Lihat Semua Layanan <i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </div>
</section>

<style>
  /* Layanan Section - Like Puskesmas Setiabudi */
  #layanan {
    background: white;
    padding: 5rem 0;
  }

  .layanan-card-wrapper {
    position: relative;
    overflow: hidden;
    border-radius: 0;
    box-shadow: none;
    height: 100%;
    display: flex;
    flex-direction: column;
    background: white;
    border: 1px solid #e0e0e0;
  }

  .layanan-image-section {
    position: relative;
    height: 280px;
    overflow: hidden;
  }

  .layanan-image-section.no-image {
    background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
  }

  .layanan-image-section.no-image::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100"><line x1="0" y1="0" x2="100" y2="100" stroke="rgba(255,255,255,0.1)" stroke-width="1"/><line x1="100" y1="0" x2="0" y2="100" stroke="rgba(255,255,255,0.1)" stroke-width="1"/></svg>');
    background-size: 50px 50px;
    opacity: 0.3;
  }

  .layanan-badge {
    position: absolute;
    top: 15px;
    right: 15px;
    background: rgba(255, 255, 255, 0.95);
    color: var(--primary-dark);
    padding: 0.4rem 1rem;
    border-radius: 0;
    font-size: 0.85rem;
    font-weight: 600;
    z-index: 2;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
  }

  .layanan-icon-large {
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 120px;
    height: 120px;
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 1;
  }

  .layanan-icon-large i {
    font-size: 80px;
    color: white;
    filter: drop-shadow(0 4px 8px rgba(0, 0, 0, 0.2));
  }

  .layanan-content {
    padding: 2rem;
    flex-grow: 1;
    display: flex;
    flex-direction: column;
  }

  .layanan-title-main {
    font-size: 1.3rem;
    font-weight: 700;
    color: var(--text-dark);
    margin-bottom: 1rem;
    line-height: 1.4;
    min-height: 60px;
  }

  .layanan-description-text {
    font-size: 0.95rem;
    color: var(--text-light);
    line-height: 1.7;
    margin-bottom: 1.5rem;
    flex-grow: 1;
    text-align: justify;
  }

  .layanan-meta-info {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 1.5rem;
    padding-top: 1rem;
    border-top: 1px solid #e9ecef;
  }

  .layanan-price {
    display: flex;
    align-items: center;
    font-size: 0.9rem;
    color: var(--text-dark);
    font-weight: 600;
  }

  .layanan-price i {
    margin-right: 0.5rem;
    color: var(--primary-color);
  }

  .layanan-status-badge {
    padding: 0.4rem 1rem;
    border-radius: 0;
    font-weight: 600;
    font-size: 0.8rem;
  }

  .status-tersedia {
    background: #d4edda;
    color: #155724;
  }

  .status-tidak-tersedia {
    background: #f8d7da;
    color: #721c24;
  }

  .btn-read-more {
    display: inline-flex;
    align-items: center;
    gap: 0.5rem;
    color: var(--text-dark);
    font-weight: 600;
    font-size: 0.9rem;
    text-decoration: none;
    text-transform: uppercase;
    letter-spacing: 0.5px;
  }

  .btn-read-more i {
    transition: transform 0.3s ease;
  }
</style>

{{-- ======= Galeri Section ======= --}}
<section id="galeri" class="services py-5" style="background: white;">
  <div class="container" data-aos="fade-up">
    <div class="section-title">
      <h2>Galeri</h2>
      <p>Dokumentasi kegiatan dan fasilitas Puskesmas</p>
    </div>
    
    <div class="galeri-carousel-wrapper position-relative">
      {{-- Desktop Carousel: 3 items per slide --}}
      <div id="galeriCarouselDesktop" class="carousel slide d-none d-md-block" data-bs-ride="carousel">
        <div class="carousel-inner">
          @php
            $desktopChunks = $galleries->chunk(3);
          @endphp
          
          @foreach ($desktopChunks as $chunkIndex => $chunk)
          <div class="carousel-item {{ $chunkIndex === 0 ? 'active' : '' }}">
            <div class="row g-4">
              @foreach ($chunk as $gallery)
              <div class="col-md-4">
                <div class="gallery-card">
                  <div class="gallery-image">
                    <img src="{{ asset('storage/' . $gallery->gambar) }}" alt="{{ $gallery->judul }}" class="d-block w-100" loading="lazy">
                    <div class="gallery-overlay">
                      <div class="overlay-content">
                        <h5>{{ $gallery->judul }}</h5>
                        @if($gallery->deskripsi)
                        <p>{{ Str::limit($gallery->deskripsi, 80) }}</p>
                        @endif
                        <a href="{{ route('galeri.show', $gallery->id) }}" class="btn-view">
                          <i class="bi bi-eye"></i> Lihat Detail
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              @endforeach
            </div>
          </div>
          @endforeach
        </div>
        
        {{-- Desktop Controls --}}
        <button class="carousel-control-prev" type="button" data-bs-target="#galeriCarouselDesktop" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#galeriCarouselDesktop" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
      
      {{-- Mobile Carousel: 1 item per slide --}}
      <div id="galeriCarouselMobile" class="carousel slide d-block d-md-none" data-bs-ride="carousel">
        <div class="carousel-inner">
          @foreach ($galleries as $mobileIndex => $gallery)
          <div class="carousel-item {{ $mobileIndex === 0 ? 'active' : '' }}">
            <div class="row justify-content-center">
              <div class="col-12">
                <div class="gallery-card">
                  <div class="gallery-image">
                    <img src="{{ asset('storage/' . $gallery->gambar) }}" alt="{{ $gallery->judul }}" class="d-block w-100" loading="lazy">
                    <div class="gallery-overlay">
                      <div class="overlay-content">
                        <h5>{{ $gallery->judul }}</h5>
                        @if($gallery->deskripsi)
                        <p>{{ Str::limit($gallery->deskripsi, 80) }}</p>
                        @endif
                        <a href="{{ route('galeri.show', $gallery->id) }}" class="btn-view">
                          <i class="bi bi-eye"></i> Lihat Detail
                        </a>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          @endforeach
        </div>
        
        {{-- Mobile Controls --}}
        <button class="carousel-control-prev" type="button" data-bs-target="#galeriCarouselMobile" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#galeriCarouselMobile" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>
    
    <div class="text-center mt-5">
      <a class="btn-view-all" href="/gallery">
        Lihat Semua Galeri <i class="bi bi-arrow-right"></i>
      </a>
    </div>
  </div>
</section>

<style>
  /* Gallery Section with Carousel - 3 items per slide */
  #galeri {
    background: white;
    padding: 5rem 0;
  }

  .galeri-carousel-wrapper {
    position: relative;
    padding: 0;
    margin: 0 80px;
  }

  #galeri .gallery-card {
    position: relative;
    overflow: hidden;
    border-radius: 15px;
    box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
    height: 100%;
  }

  #galeri .gallery-card:hover {
    box-shadow: 0 10px 35px rgba(0, 0, 0, 0.15);
  }

  #galeri .gallery-image {
    position: relative;
    overflow: hidden;
    height: 280px;
  }

  #galeri .gallery-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.5s ease;
  }

  #galeri .gallery-card:hover .gallery-image img {
    transform: scale(1.1);
  }

  #galeri .gallery-overlay {
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background: linear-gradient(180deg, transparent 0%, rgba(0, 0, 0, 0.85) 100%);
    display: flex;
    align-items: flex-end;
    padding: 1.5rem;
    opacity: 0;
    transition: opacity 0.3s ease;
  }

  #galeri .gallery-card:hover .gallery-overlay {
    opacity: 1;
  }

  #galeri .overlay-content {
    width: 100%;
  }

  #galeri .overlay-content h5 {
    color: white;
    font-size: 1.1rem;
    font-weight: 600;
    margin-bottom: 0.5rem;
  }

  #galeri .overlay-content p {
    color: rgba(255, 255, 255, 0.9);
    font-size: 0.85rem;
    margin-bottom: 1rem;
    line-height: 1.4;
  }

  #galeri .btn-view {
    background: var(--primary-color);
    color: white;
    padding: 0.5rem 1.25rem;
    border-radius: 5px;
    text-decoration: none;
    font-weight: 600;
    font-size: 0.85rem;
    display: inline-flex;
    align-items: center;
    gap: 0.4rem;
    transition: all 0.3s ease;
  }

  #galeri .btn-view:hover {
    background: var(--primary-dark);
    transform: translateY(-2px);
  }

  /* Carousel Controls - Outside positioning */
  .galeri-carousel-wrapper .carousel-control-prev,
  .galeri-carousel-wrapper .carousel-control-next {
    width: 55px;
    height: 55px;
    background: var(--primary-color);
    border-radius: 50%;
    top: 50%;
    transform: translateY(-50%);
    opacity: 1;
    transition: all 0.3s ease;
    z-index: 10;
    box-shadow: 0 4px 12px rgba(40, 167, 69, 0.3);
  }

  .galeri-carousel-wrapper .carousel-control-prev {
    left: -80px;
  }

  .galeri-carousel-wrapper .carousel-control-next {
    right: -80px;
  }

  .galeri-carousel-wrapper .carousel-control-prev:hover,
  .galeri-carousel-wrapper .carousel-control-next:hover {
    background: var(--primary-dark);
    transform: translateY(-50%) scale(1.1);
  }

  .galeri-carousel-wrapper .carousel-control-prev-icon,
  .galeri-carousel-wrapper .carousel-control-next-icon {
    width: 24px;
    height: 24px;
  }

  /* Responsive */
  @media (max-width: 991px) {
    .galeri-carousel-wrapper {
      margin: 0 70px;
    }
    
    .galeri-carousel-wrapper .carousel-control-prev {
      left: -70px;
    }

    .galeri-carousel-wrapper .carousel-control-next {
      right: -70px;
    }
  }

  @media (max-width: 767px) {
    .galeri-carousel-wrapper {
      margin: 0 60px;
    }

    #galeri .gallery-image {
      height: 220px;
    }

    .galeri-carousel-wrapper .carousel-control-prev,
    .galeri-carousel-wrapper .carousel-control-next {
      width: 45px;
      height: 45px;
    }
    
    .galeri-carousel-wrapper .carousel-control-prev {
      left: -60px;
    }

    .galeri-carousel-wrapper .carousel-control-next {
      right: -60px;
    }

    #galeri .overlay-content h5 {
      font-size: 1rem;
    }

    #galeri .overlay-content p {
      font-size: 0.8rem;
    }
  }
</style>

{{-- SKM Section --}}
<section id="skm" class="px-4 pt-12 pb-8 bg-gray-50">
  <div class="container mx-auto max-w-7xl">
    <div class="section-title">
      <h2>SURVEI KEPUASAN MASYARAKAT</h2>
    </div>

    @if ($skm)
    {{-- Grid Layout 2x2 --}}
    <div class="row g-4">
      {{-- Baris 1: SKM Summary Box dan Data Responden --}}
      <div class="col-lg-6">
        {{-- SKM Summary Box --}}
        <div class="skm-summary-box h-100">
          <h2 class="text-xl md:text-2xl font-semibold text-gray-700 mb-4 text-center w-full">{{ $skm['unit_kerja'] ?? 'Unit Kerja' }}</h2>
          <div class="skm-score-circle">
            <span>{{ number_format($skm['total_skor'], 2) }}</span>
          </div>
          <div class="text-center mt-4">
            <h3 class="text-2xl font-semibold text-gray-800 mb-1">{{ strtoupper($skm['keterangan']) }}</h3>
            <p class="text-lg text-gray-600">Grade: <span class="font-medium">{{ $skm['grade'] }}</span></p>
          </div>
          <div class="skm-progress-indicator mt-4">
            <div class="skm-progress-fill"
              style="--skm-progress-width: {{ number_format($skm['total_skor'], 2) }}%;"></div>
          </div>
          <p class="text-sm text-gray-500 mt-3 mb-4">Nilai Indeks Kepuasan Masyarakat</p>
          <div class="text-center">
            <span class="font-semibold text-gray-700 d-block mb-1">Periode Survei</span>
            <span class="text-gray-600">{{ $skm['periode_survey'] ?? 'N/A' }}</span>
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        {{-- Data Responden Card --}}
        <div class="skm-detail-card h-100">
          <div class="skm-detail-card-header mb-4">
            <div class="skm-icon-square">
              <i class="bi bi-people-fill"></i>
            </div>
            <h3 class="mt-2">Data Responden</h3>
          </div>
          <div class="skm-total-box mb-4">
            <p class="label">Total Responden</p>
            <p class="number">{{ $skm['total_responden'] }}</p>
            <p class="sub-label">Orang</p>
          </div>
          <div class="mt-4">
            <h4 class="text-lg font-semibold text-gray-700 mb-3">Jenis Kelamin</h4>
            @php
            $total_jk = ($skm['jk_pria'] ?? 0) + ($skm['jk_wanita'] ?? 0);
            @endphp
            <div class="space-y-3">
              <div class="skm-data-item">
                <span>Laki-laki</span>
                @php
                $persen_pria = $total_jk > 0 ? (($skm['jk_pria'] ?? 0) / $total_jk) * 100 : 0;
                @endphp
                <span>{{ $skm['jk_pria'] ?? 0 }} ({{ number_format($persen_pria, 1) }}%)</span>
              </div>
              <div class="skm-progress-indicator mt-1">
                <div class="skm-progress-fill"
                  style="--skm-progress-width: {{ number_format($persen_pria, 1) }}%;"></div>
              </div>
              <div class="skm-data-item mt-3">
                <span>Perempuan</span>
                @php
                $persen_wanita = $total_jk > 0 ? (($skm['jk_wanita'] ?? 0) / $total_jk) * 100 : 0;
                @endphp
                <span>{{ $skm['jk_wanita'] ?? 0 }} ({{ number_format($persen_wanita, 1) }}%)</span>
              </div>
              <div class="skm-progress-indicator mt-1">
                <div class="skm-progress-fill"
                  style="--skm-progress-width: {{ number_format($persen_wanita, 1) }}%;"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      {{-- Baris 2: Tingkat Pendidikan dan Pekerjaan --}}
      <div class="col-lg-6">
        {{-- Tingkat Pendidikan Card --}}
        <div class="skm-detail-card h-100">
          <div class="skm-detail-card-header mb-4">
            <div class="skm-icon-square">
              <i class="bi bi-mortarboard-fill"></i>
            </div>
            <h3 class="mt-2">Tingkat Pendidikan Responden</h3>
          </div>
          <div class="space-y-4 pt-4">
            @php
            $total_pendidikan = array_sum(array_column($skm['pendidikan'] ?? [], 'value'));
            @endphp
            @forelse ($skm['pendidikan'] ?? [] as $item)
            <div class="mb-3">
              <div class="skm-data-item">
                <span>{{ $item['name'] }}</span>
                @php
                $persen_pendidikan = $total_pendidikan > 0 ? ($item['value'] / $total_pendidikan) * 100 : 0;
                @endphp
                <span>{{ $item['value'] }} Orang ({{ number_format($persen_pendidikan, 1) }}%)</span>
              </div>
              <div class="skm-progress-indicator mt-1">
                <div class="skm-progress-fill"
                  style="--skm-progress-width: {{ number_format($persen_pendidikan, 1) }}%;"></div>
              </div>
            </div>
            @empty
            <p class="text-gray-500 text-center py-4">Data pendidikan tidak tersedia.</p>
            @endforelse
          </div>
        </div>
      </div>

      <div class="col-lg-6">
        {{-- Pekerjaan Responden Card --}}
        <div class="skm-detail-card h-100">
          <div class="skm-detail-card-header mb-4">
            <div class="skm-icon-square">
              <i class="bi bi-briefcase-fill"></i>
            </div>
            <h3 class="mt-2">Pekerjaan Responden</h3>
          </div>
          <div class="space-y-4 pt-4">
            @php
            $total_pekerjaan = array_sum(array_column($skm['pekerjaan'] ?? [], 'value'));
            @endphp
            @forelse ($skm['pekerjaan'] ?? [] as $item)
            <div class="mb-3">
              <div class="skm-data-item">
                <span>{{ $item['name'] }}</span>
                @php
                $persen_pekerjaan = $total_pekerjaan > 0 ? ($item['value'] / $total_pekerjaan) * 100 : 0;
                @endphp
                <span>{{ $item['value'] }} Orang ({{ number_format($persen_pekerjaan, 1) }}%)</span>
              </div>
              <div class="skm-progress-indicator mt-1">
                <div class="skm-progress-fill"
                  style="--skm-progress-width: {{ number_format($persen_pekerjaan, 1) }}%;"></div>
              </div>
            </div>
            @empty
            <p class="text-gray-500 text-center py-4">Data pekerjaan tidak tersedia.</p>
            @endforelse
          </div>
        </div>
      </div>
    </div>

    {{-- Tombol Isi Survey - Di bawah semua card --}}
    @php
      $skmConfig = \App\Models\SkmConfig::first();
    @endphp
    @if($skmConfig && $skmConfig->login_url)
    <div class="text-center mt-5">
      <a href="{{ $skmConfig->login_url }}" target="_blank" class="btn-isi-survey">
        <i class="bi bi-clipboard-check"></i> Isi Survey
      </a>
    </div>
    @endif

    @else
    <p class="text-red-500 text-center text-lg mt-8 py-6">Data SKM tidak tersedia untuk ditampilkan.</p>
    @endif
  </div>
</section>

{{-- FullCalendar CSS --}}
<link href="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.css" rel="stylesheet">

{{-- FullCalendar JS --}}
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/locales/id.global.min.js"></script>

{{-- FullCalendar Initialization --}}
<script>
  document.addEventListener('DOMContentLoaded', function() {
    var calendarEl = document.getElementById('calendar');
    
    if (calendarEl) {
      var calendar = new FullCalendar.Calendar(calendarEl, {
        initialView: 'dayGridMonth',
        locale: 'id',
        headerToolbar: {
          left: 'prev',
          center: 'title',
          right: 'next'
        },
        buttonText: {
          prev: '‹',
          next: '›'
        },
        buttonIcons: false,
        fixedWeekCount: false,
        showNonCurrentDates: true,
        events: '/agenda/events',
        eventClick: function(info) {
          info.jsEvent.preventDefault();
          
          // Populate modal with event data
          document.getElementById('eventTitle').textContent = info.event.title;
          document.getElementById('eventDate').textContent = info.event.extendedProps.tanggal || 'Tidak tersedia';
          document.getElementById('eventLocation').textContent = info.event.extendedProps.lokasi || 'Tidak tersedia';
          document.getElementById('eventDescription').textContent = info.event.extendedProps.deskripsi || 'Tidak ada deskripsi';
          
          // Show modal
          var eventModal = new bootstrap.Modal(document.getElementById('eventModal'));
          eventModal.show();
        },
        eventContent: function(arg) {
          return {
            html: '<div style="padding: 2px 4px; font-size: 0.75rem; font-weight: 500;">' + arg.event.title + '</div>'
          };
        }
      });
      
      calendar.render();
    }
  });
</script>

@endsection