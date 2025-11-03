@extends('admin.layouts.app')

@section('title', 'Kelola Berkas')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Kelola Berkas</h3>
                    <a href="{{ route('berkas.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Tambah Berkas
                    </a>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert">&times;</button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped" id="berkasTable">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Judul</th>
                                    <th>Kategori</th>
                                    <th>File</th>
                                    <th>Ukuran</th>
                                    <th>Download</th>
                                    <th>Status</th>
                                    <th width="15%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($berkas as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                            <strong>{{ $item->judul }}</strong>
                                            @if($item->deskripsi)
                                                <br><small class="text-muted">{{ Str::limit($item->deskripsi, 80) }}</small>
                                            @endif
                                        </td>
                                        <td>
                                            @if($item->kategori)
                                                <span class="badge badge-info">{{ $item->kategori }}</span>
                                            @else
                                                <span class="text-muted">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            @php
                                                $ext = pathinfo($item->file_name, PATHINFO_EXTENSION);
                                                $iconClass = match($ext) {
                                                    'pdf' => 'fa-file-pdf text-danger',
                                                    'doc', 'docx' => 'fa-file-word text-primary',
                                                    'xls', 'xlsx' => 'fa-file-excel text-success',
                                                    'ppt', 'pptx' => 'fa-file-powerpoint text-warning',
                                                    'zip', 'rar' => 'fa-file-archive text-secondary',
                                                    default => 'fa-file text-muted'
                                                };
                                            @endphp
                                            <i class="fas {{ $iconClass }}"></i> {{ $item->file_name }}
                                        </td>
                                        <td>{{ $item->file_size ?? '-' }}</td>
                                        <td><span class="badge badge-secondary">{{ $item->download_count }}</span></td>
                                        <td>
                                            @if($item->status == 'Aktif')
                                                <span class="badge badge-success">Aktif</span>
                                            @else
                                                <span class="badge badge-secondary">Non-Aktif</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('berkas.edit', $item->id) }}" class="btn btn-sm btn-warning">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('berkas.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Yakin ingin menghapus berkas ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                            <a href="{{ route('berkas.download', $item->id) }}" class="btn btn-sm btn-info" target="_blank">
                                                <i class="fas fa-download"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Belum ada data berkas</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $(document).ready(function() {
        $('#berkasTable').DataTable({
            "order": [[0, "desc"]],
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
            }
        });
    });
</script>
@endpush
@endsection
