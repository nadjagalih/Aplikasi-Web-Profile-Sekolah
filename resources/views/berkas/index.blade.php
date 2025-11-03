@extends('layouts.main')

@section('title', 'Berkas Download')

@section('content')
<!-- Breadcrumb -->
<div class="bg-light py-4 mb-5">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                <li class="breadcrumb-item active">Berkas Download</li>
            </ol>
        </nav>
    </div>
</div>

<!-- Berkas Content -->
<div class="container mb-5">
    <div class="row">
        <div class="col-12">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold mb-3">Berkas Download</h2>
                <p class="text-muted">Unduh berbagai dokumen, formulir, dan panduan yang tersedia</p>
            </div>

            @if($berkas->isEmpty())
                <div class="alert alert-info text-center" data-aos="fade-up">
                    <i class="bi bi-info-circle fs-3 d-block mb-2"></i>
                    <p class="mb-0">Belum ada berkas yang tersedia untuk diunduh.</p>
                </div>
            @else
                <!-- Filter Kategori -->
                <div class="mb-4" data-aos="fade-up">
                    <div class="btn-group flex-wrap" role="group">
                        <button type="button" class="btn btn-outline-primary active" data-filter="all">
                            <i class="bi bi-grid-fill"></i> Semua
                        </button>
                        @php
                            $categories = $berkas->pluck('kategori')->unique()->filter();
                        @endphp
                        @foreach($categories as $category)
                            <button type="button" class="btn btn-outline-primary" data-filter="{{ strtolower($category) }}">
                                <i class="bi bi-folder"></i> {{ $category }}
                            </button>
                        @endforeach
                    </div>
                </div>

                <!-- Berkas List -->
                <div class="row g-4">
                    @foreach($berkas as $item)
                        <div class="col-md-6 col-lg-4 berkas-item" data-category="{{ strtolower($item->kategori) }}" data-aos="fade-up" data-aos-delay="{{ $loop->iteration * 50 }}">
                            <div class="card h-100 shadow-sm hover-lift">
                                <div class="card-body d-flex flex-column">
                                    <div class="d-flex align-items-start mb-3">
                                        <div class="file-icon me-3">
                                            @php
                                                $ext = pathinfo($item->file_name, PATHINFO_EXTENSION);
                                                $iconClass = match($ext) {
                                                    'pdf' => 'bi-file-earmark-pdf text-danger',
                                                    'doc', 'docx' => 'bi-file-earmark-word text-primary',
                                                    'xls', 'xlsx' => 'bi-file-earmark-excel text-success',
                                                    'ppt', 'pptx' => 'bi-file-earmark-ppt text-warning',
                                                    'zip', 'rar' => 'bi-file-earmark-zip text-secondary',
                                                    default => 'bi-file-earmark text-muted'
                                                };
                                            @endphp
                                            <i class="bi {{ $iconClass }}" style="font-size: 2.5rem;"></i>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="card-title mb-1">{{ $item->judul }}</h5>
                                            @if($item->kategori)
                                                <span class="badge bg-primary">{{ $item->kategori }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    
                                    @if($item->deskripsi)
                                        <p class="card-text text-muted flex-grow-1">{{ Str::limit($item->deskripsi, 120) }}</p>
                                    @endif
                                    
                                    <div class="mt-auto">
                                        <div class="d-flex justify-content-between align-items-center mb-3">
                                            <small class="text-muted">
                                                <i class="bi bi-hdd"></i> {{ $item->file_size ?? 'N/A' }}
                                            </small>
                                            <small class="text-muted">
                                                <i class="bi bi-download"></i> {{ $item->download_count }} unduhan
                                            </small>
                                        </div>
                                        <a href="{{ route('berkas.download', $item->id) }}" class="btn btn-primary w-100">
                                            <i class="bi bi-download"></i> Unduh
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</div>

<style>
.hover-lift {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0,0,0,0.15) !important;
}

.btn-group .btn {
    margin: 2px;
}

.berkas-item {
    transition: opacity 0.3s ease, transform 0.3s ease;
}

.berkas-item.hide {
    opacity: 0;
    transform: scale(0.8);
    display: none;
}
</style>

@push('scripts')
<script>
    // Filter functionality
    document.querySelectorAll('[data-filter]').forEach(button => {
        button.addEventListener('click', function() {
            const filter = this.getAttribute('data-filter');
            
            // Update active button
            document.querySelectorAll('[data-filter]').forEach(btn => btn.classList.remove('active'));
            this.classList.add('active');
            
            // Filter items
            document.querySelectorAll('.berkas-item').forEach(item => {
                if (filter === 'all' || item.getAttribute('data-category') === filter) {
                    item.classList.remove('hide');
                } else {
                    item.classList.add('hide');
                }
            });
        });
    });
</script>
@endpush
@endsection
