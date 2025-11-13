@extends('admin.layouts.app')

@section('title', 'Edit Menu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-primary">
                    <h5 class="card-title fw-semibold text-white mb-0">Edit Menu</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('menu.update', $menu->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="title" class="form-label">Judul Menu <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('title') is-invalid @enderror" 
                                           id="title" 
                                           name="title" 
                                           value="{{ old('title', $menu->title) }}" 
                                           required>
                                    @error('title')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" 
                                           class="form-control @error('slug') is-invalid @enderror" 
                                           id="slug" 
                                           name="slug" 
                                           value="{{ old('slug', $menu->slug) }}" 
                                           readonly>
                                    <small class="text-muted">Slug akan dibuat otomatis dari judul</small>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Tipe Menu <span class="text-danger">*</span></label>
                                    <select class="form-select @error('type') is-invalid @enderror" 
                                            id="type" 
                                            name="type" 
                                            required>
                                        <option value="">-- Pilih Tipe --</option>
                                        <option value="internal" {{ old('type', $menu->type) == 'internal' ? 'selected' : '' }}>Internal Link</option>
                                        <option value="external" {{ old('type', $menu->type) == 'external' ? 'selected' : '' }}>External Link</option>
                                        <option value="custom" {{ old('type', $menu->type) == 'custom' ? 'selected' : '' }}>Custom URL</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="url" class="form-label">URL</label>
                                    <input type="text" 
                                           class="form-control @error('url') is-invalid @enderror" 
                                           id="url" 
                                           name="url" 
                                           value="{{ old('url', $menu->url) }}"
                                           placeholder="Contoh: /berita atau https://example.com">
                                    <small class="text-muted">
                                        <span id="url-help-internal" style="display:none;">Masukkan URL internal (contoh: /berita, /kontak)</span>
                                        <span id="url-help-external" style="display:none;">Masukkan URL lengkap (contoh: https://google.com)</span>
                                        <span id="url-help-custom" style="display:none;">Masukkan URL custom sesuai kebutuhan</span>
                                    </small>
                                    @error('url')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="parent_id" class="form-label">Menu Induk (Parent)</label>
                                    <select class="form-select @error('parent_id') is-invalid @enderror" 
                                            id="parent_id" 
                                            name="parent_id">
                                        <option value="">-- Tidak Ada (Menu Utama) --</option>
                                        @foreach($parentMenus as $parent)
                                            <option value="{{ $parent->id }}" {{ old('parent_id', $menu->parent_id) == $parent->id ? 'selected' : '' }}>
                                                {{ $parent->title }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <small class="text-muted">Pilih menu induk jika ini adalah submenu</small>
                                    @error('parent_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="target" class="form-label">Target Link <span class="text-danger">*</span></label>
                                    <select class="form-select @error('target') is-invalid @enderror" 
                                            id="target" 
                                            name="target" 
                                            required>
                                        <option value="_self" {{ old('target', $menu->target) == '_self' ? 'selected' : '' }}>Same Window (_self)</option>
                                        <option value="_blank" {{ old('target', $menu->target) == '_blank' ? 'selected' : '' }}>New Tab (_blank)</option>
                                    </select>
                                    @error('target')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="icon" class="form-label">Icon (Opsional)</label>
                                    <input type="text" 
                                           class="form-control @error('icon') is-invalid @enderror" 
                                           id="icon" 
                                           name="icon" 
                                           value="{{ old('icon', $menu->icon) }}"
                                           placeholder="Contoh: ti ti-home">
                                    <small class="text-muted">Gunakan class icon Tabler Icons</small>
                                    @error('icon')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="order" class="form-label">Urutan <span class="text-danger">*</span></label>
                                    <input type="number" 
                                           class="form-control @error('order') is-invalid @enderror" 
                                           id="order" 
                                           name="order" 
                                           value="{{ old('order', $menu->order) }}" 
                                           min="0"
                                           required>
                                    <small class="text-muted">Semakin kecil angka, semakin di depan</small>
                                    @error('order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="position" class="form-label">Posisi Menu <span class="text-danger">*</span></label>
                                    <select class="form-select @error('position') is-invalid @enderror" 
                                            id="position" 
                                            name="position" 
                                            required>
                                        <option value="header" {{ old('position', $menu->position) == 'header' ? 'selected' : '' }}>Header</option>
                                        <option value="footer" {{ old('position', $menu->position) == 'footer' ? 'selected' : '' }}>Footer</option>
                                        <option value="sidebar" {{ old('position', $menu->position) == 'sidebar' ? 'selected' : '' }}>Sidebar</option>
                                    </select>
                                    @error('position')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" 
                                       type="checkbox" 
                                       id="is_active" 
                                       name="is_active" 
                                       value="1" 
                                       {{ old('is_active', $menu->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">
                                    Menu Aktif
                                </label>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('menu.index') }}" class="btn btn-secondary">
                                <i class="ti ti-arrow-left"></i> Kembali
                            </a>
                            <button type="submit" class="btn btn-primary">
                                <i class="ti ti-device-floppy"></i> Update Menu
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
$(document).ready(function() {
    // Auto generate slug from title
    $('#title').on('keyup', function() {
        const title = $(this).val();
        $.ajax({
            url: '/admin/menu/slug',
            type: 'GET',
            data: { title: title },
            success: function(response) {
                $('#slug').val(response.slug);
            }
        });
    });

    // Show URL help text based on type
    $('#type').change(function() {
        const type = $(this).val();
        $('[id^="url-help-"]').hide();
        
        if(type) {
            $('#url-help-' + type).show();
        }
    });

    // Trigger on page load if type is already selected
    $('#type').trigger('change');
});
</script>
@endpush
@endsection
