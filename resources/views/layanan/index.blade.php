@extends('layouts.main')

@section('content')

<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap');

    :root {
        --primary-color: #28a745;
        --primary-dark: #218838;
        --secondary-color: #17a2b8;
        --text-dark: #2c3e50;
        --text-light: #6c757d;
        --bg-light: #f8f9fa;
    }

    body {
        font-family: 'Poppins', sans-serif;
        background-color: var(--bg-light);
        color: var(--text-dark);
    }

    /* Section Styles */
    #layanan {
        background: white;
        padding: 5rem 0;
        min-height: 100vh;
    }

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
        margin-top: 1.5rem;
    }

    /* Layanan Card Styles - Like Puskesmas Setiabudi */
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

    /* Modal Styles */
    .modal-header {
        background: linear-gradient(135deg, var(--primary-color), var(--primary-dark));
        color: white;
    }

    .modal-title {
        font-weight: 600;
    }

    .modal-body {
        padding: 2rem;
    }

    .detail-section {
        margin-bottom: 1.5rem;
    }

    .detail-section h6 {
        font-weight: 600;
        color: var(--text-dark);
        margin-bottom: 0.75rem;
        display: flex;
        align-items: center;
    }

    .detail-section h6 i {
        margin-right: 0.5rem;
        color: var(--primary-color);
    }

    .detail-content {
        color: var(--text-light);
        line-height: 1.8;
        text-align: justify;
    }

    .detail-content ul,
    .detail-content ol {
        margin-left: 1.5rem;
    }

    @media (max-width: 768px) {
        .section-title h2 {
            font-size: 2rem;
        }

        .section-title p {
            font-size: 0.95rem;
        }

        #layanan {
            padding: 3rem 0;
        }
        
        .layanan-image-section {
            height: 220px;
        }
        
        .layanan-icon-large {
            width: 90px;
            height: 90px;
        }
        
        .layanan-icon-large i {
            font-size: 60px;
        }

        .layanan-badge {
            top: 10px;
            right: 10px;
            padding: 0.3rem 0.8rem;
            font-size: 0.75rem;
        }

        .layanan-content {
            padding: 1.5rem;
        }

        .layanan-title-main {
            font-size: 1.1rem;
            min-height: auto;
        }

        .layanan-description-text {
            font-size: 0.9rem;
        }

        .layanan-meta-info {
            flex-direction: column;
            gap: 0.75rem;
            align-items: flex-start;
        }

        .layanan-price {
            font-size: 0.85rem;
        }

        .btn-read-more {
            font-size: 0.85rem;
        }
    }

    @media (max-width: 576px) {
        .section-title h2 {
            font-size: 1.75rem;
        }

        .layanan-image-section {
            height: 200px;
        }

        .layanan-icon-large {
            width: 80px;
            height: 80px;
        }
        
        .layanan-icon-large i {
            font-size: 50px;
        }

        .layanan-content {
            padding: 1.25rem;
        }

        .layanan-title-main {
            font-size: 1rem;
        }

        .layanan-description-text {
            font-size: 0.85rem;
            margin-bottom: 1rem;
        }
    }
</style>

<section id="layanan">
    <div class="container" data-aos="fade-up">
        <div class="section-title">
            <h2>Layanan Puskesmas</h2>
            <p>Berbagai layanan kesehatan yang tersedia untuk melayani Anda</p>
        </div>
        
        <div class="row justify-content-center">
            @foreach ($layanans as $layanan)
            <div class="col-lg-4 col-md-6 col-sm-12 mb-4" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 100 }}">
                <div class="layanan-card-wrapper">
                    <!-- Image Section with Icon -->
                    <div class="layanan-image-section {{ (!$layanan->gambar || !file_exists(storage_path('app/public/' . $layanan->gambar))) ? 'no-image' : '' }}" 
                         @if($layanan->gambar && file_exists(storage_path('app/public/' . $layanan->gambar))) 
                         style="background-image: url('{{ asset('storage/' . $layanan->gambar) }}'); background-size: cover; background-position: center;"
                         @endif>
                        <!-- Tidak ada overlay jika ada gambar, biarkan gambar terlihat penuh -->
                        
                        <div class="layanan-badge">
                            Layanan {{ $loop->iteration }}
                        </div>
                        
                        @if(!$layanan->gambar || !file_exists(storage_path('app/public/' . $layanan->gambar)))
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
                        
                        <a href="#" class="btn-read-more" data-bs-toggle="modal" data-bs-target="#modalLayanan{{ $layanan->id }}" onclick="event.preventDefault()">
                            Read More <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Modal Detail Layanan -->
            <div class="modal fade" id="modalLayanan{{ $layanan->id }}" tabindex="-1" aria-labelledby="modalLayanan{{ $layanan->id }}Label" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalLayanan{{ $layanan->id }}Label">
                                <i class="bi bi-heart-pulse me-2"></i>{{ $layanan->nama_layanan }}
                            </h5>
                            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            @if($layanan->gambar && file_exists(storage_path('app/public/' . $layanan->gambar)))
                            <div class="text-center mb-4">
                                <img src="{{ asset('storage/' . $layanan->gambar) }}" 
                                     alt="{{ $layanan->nama_layanan }}" 
                                     class="img-fluid"
                                     style="max-height: 400px; width: 100%; object-fit: cover; object-position: center;">
                            </div>
                            @endif

                            <div class="detail-section">
                                <h6><i class="bi bi-info-circle"></i>Deskripsi Layanan</h6>
                                <div class="detail-content">
                                    {!! $layanan->deskripsi !!}
                                </div>
                            </div>

                            @if($layanan->persyaratan)
                            <div class="detail-section">
                                <h6><i class="bi bi-clipboard-check"></i>Persyaratan</h6>
                                <div class="detail-content">
                                    {!! $layanan->persyaratan !!}
                                </div>
                            </div>
                            @endif

                            @if($layanan->biaya)
                            <div class="detail-section">
                                <h6><i class="bi bi-cash-coin"></i>Biaya</h6>
                                <div class="detail-content">
                                    <strong>{{ $layanan->biaya }}</strong>
                                </div>
                            </div>
                            @endif

                            <div class="detail-section">
                                <h6><i class="bi bi-check-circle"></i>Status Ketersediaan</h6>
                                <div class="detail-content">
                                    <span class="layanan-status-badge {{ $layanan->status == 'Tersedia' ? 'status-tersedia' : 'status-tidak-tersedia' }}">
                                        {{ $layanan->status }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection