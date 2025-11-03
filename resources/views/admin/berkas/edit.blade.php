@extends('admin.layouts.app')

@section('title', 'Edit Berkas')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Berkas</h3>
                </div>
                <form action="{{ route('berkas.update', $berkas->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="judul">Judul <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('judul') is-invalid @enderror" 
                                   id="judul" 
                                   name="judul" 
                                   value="{{ old('judul', $berkas->judul) }}"
                                   required>
                            @error('judul')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="deskripsi">Deskripsi</label>
                            <textarea class="form-control @error('deskripsi') is-invalid @enderror" 
                                      id="deskripsi" 
                                      name="deskripsi" 
                                      rows="3">{{ old('deskripsi', $berkas->deskripsi) }}</textarea>
                            @error('deskripsi')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="kategori">Kategori</label>
                                    <select class="form-control @error('kategori') is-invalid @enderror" 
                                            id="kategori" 
                                            name="kategori">
                                        <option value="">-- Pilih Kategori --</option>
                                        <option value="Formulir" {{ old('kategori', $berkas->kategori) == 'Formulir' ? 'selected' : '' }}>Formulir</option>
                                        <option value="Panduan" {{ old('kategori', $berkas->kategori) == 'Panduan' ? 'selected' : '' }}>Panduan</option>
                                        <option value="Dokumen" {{ old('kategori', $berkas->kategori) == 'Dokumen' ? 'selected' : '' }}>Dokumen</option>
                                        <option value="SOP" {{ old('kategori', $berkas->kategori) == 'SOP' ? 'selected' : '' }}>SOP</option>
                                        <option value="Laporan" {{ old('kategori', $berkas->kategori) == 'Laporan' ? 'selected' : '' }}>Laporan</option>
                                        <option value="Lainnya" {{ old('kategori', $berkas->kategori) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                                    </select>
                                    @error('kategori')
                                        <div class="invalid-feedback">{{ $message }}</div>
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
                                        <option value="Aktif" {{ old('status', $berkas->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                        <option value="Non-Aktif" {{ old('status', $berkas->status) == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="file">File</label>
                            <div class="mb-2">
                                <div class="alert alert-info">
                                    <strong>File saat ini:</strong> 
                                    <i class="fas fa-file"></i> {{ $berkas->file_name }}
                                    <span class="badge badge-secondary ml-2">{{ $berkas->file_size }}</span>
                                    <br>
                                    <small>Diunduh: {{ $berkas->download_count }} kali</small>
                                </div>
                            </div>
                            <div class="custom-file">
                                <input type="file" 
                                       class="custom-file-input @error('file') is-invalid @enderror" 
                                       id="file" 
                                       name="file"
                                       accept=".pdf,.doc,.docx,.xls,.xlsx,.ppt,.pptx,.zip,.rar">
                                <label class="custom-file-label" for="file">Pilih file baru...</label>
                            </div>
                            <small class="form-text text-muted">
                                Kosongkan jika tidak ingin mengubah file. Format: PDF, Word, Excel, PowerPoint, ZIP, RAR. Maksimal 10MB
                            </small>
                            @error('file')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="{{ route('berkas.index') }}" class="btn btn-secondary">
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
