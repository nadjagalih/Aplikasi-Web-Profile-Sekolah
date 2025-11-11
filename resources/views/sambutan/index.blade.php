@extends('layouts.main')

@section('content')

</section><!-- End Breadcrumbs -->
    <!-- ======= Sambutan Section ======= -->
    <section id="sambutan-detail" class="sambutan-detail section-bg">
      <div class="container" data-aos="fade-up">

        @if($sambutan)
          <div class="row">
            <div class="col-lg-4 mb-4" data-aos="fade-right">
              <div class="sambutan-photo-wrapper">
                @if($sambutan->foto)
                  <div class="photo-container">
                    <img src="{{ asset('storage/' . $sambutan->foto) }}" 
                         alt="{{ $sambutan->nama }}" 
                         class="img-fluid">
                  </div>
                @else
                  <div class="photo-container">
                    <img src="{{ asset('assets/img/default-avatar.png') }}" 
                         alt="{{ $sambutan->nama }}" 
                         class="img-fluid">
                  </div>
                @endif
                <div class="info-box">
                  <h4 class="fw-bold mb-2">{{ $sambutan->nama }}</h4>
                  <p class="text-muted mb-0">{{ $sambutan->jabatan }}</p>
                </div>
              </div>
            </div>

            <div class="col-lg-8" data-aos="fade-left">
              <div class="sambutan-content">
                <h3 class="mb-4 pb-3">
                  <i class="bi bi-chat-quote me-2"></i>Sambutan Kepala Puskesmas
                </h3>
                <div class="sambutan-text">
                  {!! nl2br(e($sambutan->isi_sambutan)) !!}
                </div>
              </div>
            </div>
          </div>
        @else
          <div class="alert alert-info text-center" role="alert">
            <i class="bi bi-info-circle me-2"></i>
            Belum ada sambutan yang aktif saat ini.
          </div>
        @endif

  </div>
</section><!-- End Sambutan Section -->

<style>
    .sambutan-detail {
      padding: 60px 0;
      background-color: #f8f9fa;
    }

    .sambutan-photo-wrapper {
      text-align: center;
    }

    .photo-container {
      background: transparent;
      padding: 0;
      border-radius: 0;
      box-shadow: none;
      margin-bottom: 20px;
      max-width: 280px;
      margin-left: auto;
      margin-right: auto;
    }

    .photo-container img {
      width: 100%;
      height: auto;
      border-radius: 8px;
      object-fit: contain;
      aspect-ratio: 3/4;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .sambutan-detail .info-box {
      background: transparent;
      margin-top: 0;
    }

    .sambutan-detail .info-box h4 {
      font-size: 1.5rem;
      color: #2c3e50;
    }

    .sambutan-detail .sambutan-content {
      background: transparent;
      padding: 0;
      border-radius: 0;
      box-shadow: none;
    }

    .sambutan-detail .sambutan-content h3 {
      color: #2c3e50;
      border-bottom: 2px solid #e9ecef;
    }

    .sambutan-detail .sambutan-text {
      color: #495057;
      text-align: justify;
      line-height: 2;
      font-size: 1.05rem;
    }

    @media (max-width: 991px) {
      .sambutan-detail .col-lg-4 {
        margin-bottom: 2rem !important;
      }

      .photo-container {
        max-width: 240px;
      }
    }
</style>

@endsection
