@extends('layouts.main')

@section('content')

<!-- ======= Breadcrumbs ======= -->
<section id="breadcrumbs" class="breadcrumbs">
  <div class="container">
    <div class="d-flex justify-content-between align-items-center">
      <h2>Alur Pelayanan</h2>
      <ol>
        <li><a href="/">Beranda</a></li>
        <li>Alur Pelayanan</li>
      </ol>
    </div>
  </div>
</section><!-- End Breadcrumbs -->

<!-- ======= Alur Pelayanan Section ======= -->
<section id="alur-pelayanan" class="alur-pelayanan section-bg">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>Alur Pelayanan Puskesmas</h2>
      <p>Ikuti langkah-langkah pelayanan berikut untuk mendapatkan pelayanan kesehatan yang optimal</p>
    </div>

    @if($alurPelayanans->count() > 0)
      <div class="timeline">
        @foreach($alurPelayanans as $index => $alur)
          <div class="timeline-item {{ $index % 2 == 0 ? 'left' : 'right' }}" data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
            <div class="timeline-badge">
              @if($alur->icon)
                <img src="{{ asset('storage/' . $alur->icon) }}" alt="{{ $alur->judul }}">
              @else
                <i class="bi bi-check-circle-fill"></i>
              @endif
            </div>
            <div class="timeline-panel">
              <div class="timeline-heading">
                <div class="step-number">Langkah {{ $alur->urutan }}</div>
                <h4 class="timeline-title">{{ $alur->judul }}</h4>
              </div>
              <div class="timeline-body">
                <p>{{ $alur->deskripsi }}</p>
              </div>
            </div>
          </div>
        @endforeach
      </div>
    @else
      <div class="alert alert-info text-center" role="alert">
        <i class="bi bi-info-circle me-2"></i>
        Belum ada data alur pelayanan yang tersedia.
      </div>
    @endif

  </div>
</section><!-- End Alur Pelayanan Section -->

<style>
  .alur-pelayanan {
    padding: 60px 0;
    background-color: #f8f9fa;
  }

  .timeline {
    position: relative;
    padding: 20px 0;
  }

  .timeline::before {
    content: '';
    position: absolute;
    top: 0;
    left: 50%;
    width: 4px;
    height: 100%;
    background: linear-gradient(to bottom, #0d6efd, #0dcaf0);
    transform: translateX(-50%);
  }

  .timeline-item {
    position: relative;
    margin-bottom: 50px;
    width: 50%;
    padding: 20px;
  }

  .timeline-item.left {
    left: 0;
    text-align: right;
    padding-right: 50px;
  }

  .timeline-item.right {
    left: 50%;
    text-align: left;
    padding-left: 50px;
  }

  .timeline-badge {
    position: absolute;
    top: 20px;
    width: 60px;
    height: 60px;
    border-radius: 50%;
    background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    z-index: 10;
    box-shadow: 0 4px 12px rgba(13, 110, 253, 0.3);
  }

  .timeline-item.left .timeline-badge {
    right: -30px;
  }

  .timeline-item.right .timeline-badge {
    left: -30px;
  }

  .timeline-badge i {
    font-size: 30px;
    color: white;
  }

  .timeline-badge img {
    width: 40px;
    height: 40px;
    object-fit: contain;
    filter: brightness(0) invert(1);
  }

  .timeline-panel {
    background: white;
    padding: 25px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    position: relative;
  }

  .timeline-item.left .timeline-panel::after {
    content: '';
    position: absolute;
    top: 30px;
    right: -15px;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 10px 0 10px 15px;
    border-color: transparent transparent transparent white;
  }

  .timeline-item.right .timeline-panel::after {
    content: '';
    position: absolute;
    top: 30px;
    left: -15px;
    width: 0;
    height: 0;
    border-style: solid;
    border-width: 10px 15px 10px 0;
    border-color: transparent white transparent transparent;
  }

  .step-number {
    display: inline-block;
    padding: 5px 15px;
    background: linear-gradient(135deg, #0d6efd 0%, #0dcaf0 100%);
    color: white;
    border-radius: 20px;
    font-size: 14px;
    font-weight: 600;
    margin-bottom: 10px;
  }

  .timeline-title {
    color: #0d6efd;
    font-size: 22px;
    font-weight: 700;
    margin-bottom: 15px;
  }

  .timeline-body p {
    color: #666;
    line-height: 1.8;
    margin: 0;
  }

  /* Mobile Responsive */
  @media (max-width: 768px) {
    .timeline::before {
      left: 30px;
    }

    .timeline-item {
      width: 100%;
      left: 0 !important;
      text-align: left !important;
      padding-left: 80px !important;
      padding-right: 20px !important;
    }

    .timeline-item.left .timeline-badge,
    .timeline-item.right .timeline-badge {
      left: 0;
      right: auto;
    }

    .timeline-item.left .timeline-panel::after {
      display: none;
    }

    .timeline-item.right .timeline-panel::after {
      left: -15px;
    }
  }
</style>

@endsection
