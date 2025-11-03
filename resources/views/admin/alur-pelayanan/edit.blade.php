@extends('admin.layouts.app')

@section('title', 'Edit Alur Pelayanan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Alur Pelayanan</h3>
                </div>
                <form action="{{ route('alur-pelayanan.update', $alurPelayanan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="urutan">Urutan Langkah <span class="text-danger">*</span></label>
                                    <input type="number" 
                                           class="form-control @error('urutan') is-invalid @enderror" 
                                           id="urutan" 
                                           name="urutan" 
                                           value="{{ old('urutan', $alurPelayanan->urutan) }}"
                                           min="1"
                                           required>
                                    @error('urutan')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="judul">Judul Langkah <span class="text-danger">*</span></label>
                                    <input type="text" 
                                           class="form-control @error('judul') is-invalid @enderror" 
                                           id="judul" 
                                           name="judul" 
                                           value="{{ old('judul', $alurPelayanan->judul) }}"
                                           required>
                                    @error('judul')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="4"
                                      required>{{ old('deskripsi', $alurPelayanan->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="icon">Icon/Gambar</label>
                                    @if($alurPelayanan->icon)
                                        <div class="mb-2">
                                            <img src="{{ asset('storage/' . $alurPelayanan->icon) }}" 
                                                 alt="{{ $alurPelayanan->judul }}" 
                                                 class="img-thumbnail" 
                                                 style="max-width: 100px;">
                                            <p class="text-muted mt-1">Icon saat ini</p>
                                        </div>
                                    @endif
                                    <div class="custom-file">
                                        <input type="file" 
                                               class="custom-file-input @error('icon') is-invalid @enderror" 
                                               id="icon" 
                                               name="icon"
                                               accept="image/*">
                                        <label class="custom-file-label" for="icon">Pilih icon baru...</label>
                                    </div>
                                    <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah icon</small>
                                    @error('icon')
                                        <div class="invalid-feedback d-block">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="status">Status <span class="text-danger">*</span></label>
                                    <select class="form-control @error('status') is-invalid @enderror" 
                                            id="status" 
                                            name="status"
                                            required>
                                        <option value="Aktif" {{ old('status', $alurPelayanan->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="Non-Aktif" {{ old('status', $alurPelayanan->status) == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="{{ route('alur-pelayanan.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>
@endpush
@endsection
