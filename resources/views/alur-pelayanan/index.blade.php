@extends('layouts.main')

@section('content')

<!-- ======= Alur Pelayanan Section ======= -->
<section id="alur-pelayanan" class="alur-pelayanan section-bg">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>Alur Pelayanan Puskesmas</h2>
      <p>Informasi alur pelayanan</p>
    </div>

    @if($alurPelayanan && $alurPelayanan->gambar)
      <div class="row justify-content-center">
        <div class="col-lg-10 col-xl-9">
          <div class="text-center" data-aos="zoom-in">
            <img src="{{ asset('storage/' . $alurPelayanan->gambar) }}" 
                 alt="Alur Pelayanan Puskesmas" 
                 class="img-fluid"
                 style="max-width: 60%; height: auto;">
          </div>
          
          @if($alurPelayanan->deskripsi)
            <div class="mt-4" data-aos="fade-up" data-aos-delay="100">
              <div class="row">
                <div class="col-lg-10 mx-auto p-3">
                  <div class="deskripsi-content">
                    {!! $alurPelayanan->deskripsi !!}
                  </div>
                </div>
              </div>
            </div>
          @endif
        </div>
      </div>
    @else
      <div class="alert alert-info text-center" role="alert" data-aos="fade-up">
        <i class="bi bi-info-circle me-2" style="font-size: 2rem;"></i>
        <p class="mb-0" style="font-size: 1.1rem;">Informasi alur pelayanan sedang dalam proses pembaruan.</p>
      </div>
    @endif

  </div>
</section><!-- End Alur Pelayanan Section -->

<style>
  .alur-pelayanan {
    padding: 80px 0;
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
  }

  .section-title h2 {
    font-size: 2.5rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 1rem;
    text-align: center;
  }

  .section-title p {
    font-size: 1.1rem;
    color: #6c757d;
    text-align: center;
    margin-bottom: 3rem;
  }

  @media (max-width: 768px) {
    .alur-pelayanan {
      padding: 60px 0;
    }

    .section-title h2 {
      font-size: 1.8rem;
    }

    .section-title p {
      font-size: 1rem;
    }
  }
</style>

@endsection
