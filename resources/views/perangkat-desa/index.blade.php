@extends('layouts.main')

@section('title', 'Struktur Organisasi')

@section('content')

<style>
  /* Styling for the main section title */
  .section-title h2 {
    color: #000;
    /* Sets the title color to black */
    text-align: center;
    /* Keeps the main section title centered */
    font-weight: 700;
    /* Bold font weight */
    font-size: 2rem;
    /* Font size for the title */
    margin-bottom: 1.5rem;
    /* Space below the title */
  }

  /*
     * No other styles are explicitly changed here as per your request.
     * Ensure any existing styles for .member, .pic, .member-info, etc.,
     * are defined elsewhere in your CSS (e.g., in layouts/main.blade.php
     * or a separate CSS file) if they are not already.
     */
</style>

<!-- Breadcrumb -->
<div class="bg-light py-4 mb-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item"><a href="#">Profil</a></li>
                <li class="breadcrumb-item active">Struktur Organisasi</li>
            </ol>
        </nav>
    </div>
</div>

<section class="counts section-bg">
  <div class="container">

    <div class="section-title" data-aos="fade-up">
      <h2>Struktur Organisasi Puskesmas</h2>
      <p class="text-muted">Susunan Kepegawaian dan Struktur Organisasi Puskesmas</p>
    </div>

    <div class="row">
      @foreach ($perangkatDesa as $perangkat)
      <div class="col-xl-3 my-3" data-aos="fade-up">
        <div class="member">
          <div class="pic"><img src="{{ asset('storage/' . $perangkat->foto) }}" class="img-fluid" alt=""></div>
          <div class="member-info">
            <h4>{{ $perangkat->nama }}</h4>
            <span>{{ $perangkat->jabatan }}</span>
          </div>
        </div>
      </div>
      @endforeach
    </div>

  </div>
</section>
@endsection