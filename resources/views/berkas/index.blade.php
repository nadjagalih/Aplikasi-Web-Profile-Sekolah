@extends('layouts.main')

@section('title', 'Berkas Download')

@section('content')

<!-- ======= Berkas Section ======= -->
<section id="berkas" class="berkas section-bg">
  <div class="container" data-aos="fade-up">

    <div class="section-title">
      <h2>Berkas Download</h2>
      <p>Unduh berbagai dokumen, formulir, dan panduan yang tersedia</p>
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

        <!-- Berkas Table -->
        <div class="table-responsive" data-aos="fade-up">
            <table class="table table-striped table-hover align-middle" id="berkasTable">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="30%">Judul</th>
                        <th width="15%">Kategori</th>
                        <th width="25%">Deskripsi</th>
                        <th width="10%">Ukuran</th>
                        <th width="10%" class="text-center">Download</th>
                        <th width="5%" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($berkas as $item)
                        <tr class="berkas-row" data-category="{{ strtolower($item->kategori) }}">
                            <td>{{ $loop->iteration }}</td>
                            <td>
                                <div class="d-flex align-items-center">
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
                                    <i class="bi {{ $iconClass }} me-2" style="font-size: 1.5rem;"></i>
                                    <div>
                                        <strong>{{ $item->judul }}</strong>
                                        <br>
                                        <small class="text-muted">{{ $item->file_name }}</small>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($item->kategori)
                                    <span class="badge bg-primary">{{ $item->kategori }}</span>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>
                                @if($item->deskripsi)
                                    <small>{{ Str::limit($item->deskripsi, 80) }}</small>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $item->file_size ?? 'N/A' }}</td>
                            <td class="text-center">
                                <span class="badge bg-secondary">{{ $item->download_count }}</span>
                            </td>
                            <td class="text-center">
                                <a href="{{ route('berkas.download', $item->id) }}" 
                                   class="btn btn-sm btn-primary" 
                                   title="Download">
                                    <i class="bi bi-download"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif

  </div>
</section><!-- End Berkas Section -->

<style>
.berkas {
    padding: 60px 0;
    background: #f8f9fa;
}

.section-title h2 {
    font-size: 2rem;
    font-weight: 700;
    margin-bottom: 1rem;
}

.section-title p {
    color: #6c757d;
    margin-bottom: 2rem;
}

.btn-group .btn {
    margin: 2px;
}

.table {
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.table thead th {
    font-weight: 600;
    border-bottom: 2px solid #dee2e6;
    text-transform: uppercase;
    font-size: 0.85rem;
    letter-spacing: 0.5px;
}

.table tbody tr {
    transition: all 0.3s ease;
}

.table tbody tr:hover {
    background-color: #f1f3f5;
}

.berkas-row.hide {
    display: none;
}

@media (max-width: 768px) {
    .table {
        font-size: 0.875rem;
    }
    
    .table td, .table th {
        padding: 0.5rem;
    }
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
            
            // Filter rows
            document.querySelectorAll('.berkas-row').forEach(row => {
                if (filter === 'all' || row.getAttribute('data-category') === filter) {
                    row.classList.remove('hide');
                } else {
                    row.classList.add('hide');
                }
            });
        });
    });
</script>
@endpush
@endsection
