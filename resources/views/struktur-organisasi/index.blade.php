@extends('layouts.main')

@section('title', 'Struktur Organisasi')

@section('content')

<style>
  /* Styling for the main section title */
  .section-title h2 {
    color: #000;
    text-align: center;
    font-weight: 700;
    font-size: 2rem;
    margin-bottom: 1.5rem;
  }

  /* Organization Chart Styles */
  .org-chart-container {
    overflow-x: auto;
    padding: 2rem 1rem;
    background: #f8f9fa;
  }

  .org-chart {
    display: flex;
    flex-direction: column;
    align-items: center;
    min-width: fit-content;
  }

  .org-level {
    display: flex;
    justify-content: center;
    flex-wrap: wrap;
    gap: 2rem;
    margin-bottom: 3rem;
    position: relative;
  }

  .org-node {
    background: white;
    border-radius: 0;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    padding: 1.5rem;
    text-align: center;
    min-width: 220px;
    max-width: 250px;
    position: relative;
    transition: all 0.3s ease;
    border: 1px solid #ddd;
  }

  .org-node:hover {
    transform: translateY(-5px);
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
  }

  .org-node.kepala {
    border: 2px solid #333;
  }

  .org-node.wakil {
    border: 1px solid #666;
  }

  .org-node.staff {
    border: 1px solid #999;
  }

  .org-photo {
    width: 120px;
    height: 120px;
    border-radius: 0;
    margin: 0 auto 1rem;
    overflow: hidden;
    border: 2px solid #333;
  }

  .org-node.kepala .org-photo {
    width: 140px;
    height: 140px;
    border: 3px solid #000;
  }

  .org-photo img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .org-name {
    font-size: 1.1rem;
    font-weight: 700;
    color: #2c3e50;
    margin-bottom: 0.5rem;
    line-height: 1.3;
  }

  .org-position {
    font-size: 0.9rem;
    color: #666;
    font-weight: 500;
    padding: 0.5rem;
    background: #f5f5f5;
    border-radius: 0;
    display: inline-block;
  }

  /* Connecting Lines */
  .org-level::before {
    content: '';
    position: absolute;
    top: -30px;
    left: 50%;
    width: 2px;
    height: 30px;
    background: #333;
  }

  .org-level:first-child::before {
    display: none;
  }

  /* Responsive */
  @media (max-width: 768px) {
    .org-node {
      min-width: 180px;
      max-width: 200px;
      padding: 1rem;
    }

    .org-photo {
      width: 100px;
      height: 100px;
    }

    .org-node.kepala .org-photo {
      width: 120px;
      height: 120px;
    }

    .org-name {
      font-size: 1rem;
    }

    .org-position {
      font-size: 0.85rem;
    }

    .org-level {
      gap: 1rem;
    }
  }

  .counts.section-bg {
    padding: 4rem 0;
    background-color: #f9fafb;
  }
</style>

<section class="counts section-bg">
  <div class="container">

    <div class="section-title" data-aos="fade-up">
      <h2>Struktur Organisasi Puskesmas</h2>
      <p class="text-muted">Susunan Kepegawaian dan Struktur Organisasi Puskesmas</p>
    </div>

    <div class="org-chart-container" data-aos="fade-up">
      <div class="org-chart">
        @php
          // Kelompokkan berdasarkan jabatan
          $kepala = $strukturOrganisasi->filter(function($item) {
            return stripos($item->jabatan, 'kepala') !== false;
          })->sortBy('jabatan');
          
          $wakil = $strukturOrganisasi->filter(function($item) {
            return stripos($item->jabatan, 'wakil') !== false || 
                   stripos($item->jabatan, 'kasubag') !== false ||
                   stripos($item->jabatan, 'koordinator') !== false;
          })->sortBy('jabatan');
          
          $staff = $strukturOrganisasi->filter(function($item) {
            return stripos($item->jabatan, 'kepala') === false && 
                   stripos($item->jabatan, 'wakil') === false &&
                   stripos($item->jabatan, 'kasubag') === false &&
                   stripos($item->jabatan, 'koordinator') === false;
          })->sortBy('jabatan');
        @endphp

        {{-- Level 1: Kepala --}}
        @if($kepala->count() > 0)
        <div class="org-level">
          @foreach ($kepala as $perangkat)
          <div class="org-node kepala" data-aos="zoom-in">
            <div class="org-photo">
              <img src="{{ asset('storage/' . $perangkat->foto) }}" alt="{{ $perangkat->nama }}">
            </div>
            <div class="org-name">{{ $perangkat->nama }}</div>
            <div class="org-position">{{ $perangkat->jabatan }}</div>
          </div>
          @endforeach
        </div>
        @endif

        {{-- Level 2: Wakil/Koordinator --}}
        @if($wakil->count() > 0)
        <div class="org-level">
          @foreach ($wakil as $perangkat)
          <div class="org-node wakil" data-aos="zoom-in" data-aos-delay="100">
            <div class="org-photo">
              <img src="{{ asset('storage/' . $perangkat->foto) }}" alt="{{ $perangkat->nama }}">
            </div>
            <div class="org-name">{{ $perangkat->nama }}</div>
            <div class="org-position">{{ $perangkat->jabatan }}</div>
          </div>
          @endforeach
        </div>
        @endif

        {{-- Level 3: Staff --}}
        @if($staff->count() > 0)
        <div class="org-level">
          @foreach ($staff as $perangkat)
          <div class="org-node staff" data-aos="zoom-in" data-aos-delay="200">
            <div class="org-photo">
              <img src="{{ asset('storage/' . $perangkat->foto) }}" alt="{{ $perangkat->nama }}">
            </div>
            <div class="org-name">{{ $perangkat->nama }}</div>
            <div class="org-position">{{ $perangkat->jabatan }}</div>
          </div>
          @endforeach
        </div>
        @endif
      </div>
    </div>

  </div>
</section>
@endsection