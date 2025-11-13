@extends('admin.layouts.app')

@section('title', 'Kelola Halaman')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary d-flex justify-content-between align-items-center">
                    <h5 class="card-title fw-semibold text-white mb-0">Daftar Halaman</h5>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="20%">Judul</th>
                                    <th width="15%">Menu</th>
                                    <th width="20%">Slug</th>
                                    <th width="10%" class="text-center">Status</th>
                                    <th width="15%">Dibuat</th>
                                    <th width="15%" class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pages as $index => $page)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $page->title }}</td>
                                        <td>
                                            @if($page->menu)
                                                <span class="badge bg-info">
                                                    {{ $page->menu->title }}
                                                </span>
                                            @else
                                                <span class="badge bg-secondary">-</span>
                                            @endif
                                        </td>
                                        <td>
                                            <code>{{ $page->slug }}</code>
                                        </td>
                                        <td class="text-center">
                                            <div class="form-check form-switch d-flex justify-content-center">
                                                <input class="form-check-input toggle-status" 
                                                       type="checkbox" 
                                                       data-id="{{ $page->id }}"
                                                       {{ $page->is_active ? 'checked' : '' }}>
                                            </div>
                                        </td>
                                        <td>{{ $page->created_at->format('d/m/Y H:i') }}</td>
                                        <td class="text-center">
                                            <div class="btn-group" role="group">
                                                <a href="{{ route('pages.edit', $page->id) }}" 
                                                   class="btn btn-sm btn-warning" 
                                                   title="Edit">
                                                    <i class="ti ti-edit"></i>
                                                </a>
                                                <form action="{{ route('pages.destroy', $page->id) }}" 
                                                      method="POST" 
                                                      class="d-inline delete-form">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" 
                                                            class="btn btn-sm btn-danger" 
                                                            title="Hapus">
                                                        <i class="ti ti-trash"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center py-4">
                                            <i class="ti ti-file-off fs-1 text-muted"></i>
                                            <p class="mt-2 text-muted">Belum ada halaman</p>
                                        </td>
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
    // Toggle status
    $('.toggle-status').change(function() {
        const pageId = $(this).data('id');
        const checkbox = $(this);
        
        $.ajax({
            url: '/admin/pages/' + pageId + '/toggle',
            type: 'POST',
            data: {
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                if(response.success) {
                    toastr.success(response.message);
                }
            },
            error: function() {
                checkbox.prop('checked', !checkbox.prop('checked'));
                toastr.error('Gagal mengubah status halaman!');
            }
        });
    });

    // Delete confirmation
    $('.delete-form').submit(function(e) {
        e.preventDefault();
        const form = this;
        
        if(confirm('Apakah Anda yakin ingin menghapus halaman ini?')) {
            form.submit();
        }
    });
});
</script>
@endpush
@endsection
