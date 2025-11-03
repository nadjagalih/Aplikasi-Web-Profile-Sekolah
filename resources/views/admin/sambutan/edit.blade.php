@extends('admin.layouts.app')

@section('title', 'Edit Sambutan')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Edit Sambutan Kepala Puskesmas</h3>
                </div>
                <form action="{{ route('sambutan.update', $sambutan->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="nama_kepala">Nama Kepala Puskesmas <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('nama_kepala') is-invalid @enderror" 
                                   id="nama_kepala" 
                                   name="nama_kepala" 
                                   value="{{ old('nama_kepala', $sambutan->nama_kepala) }}"
                                   placeholder="Masukkan nama kepala puskesmas"
                                   required>
                            @error('nama_kepala')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="jabatan">Jabatan <span class="text-danger">*</span></label>
                            <input type="text" 
                                   class="form-control @error('jabatan') is-invalid @enderror" 
                                   id="jabatan" 
                                   name="jabatan" 
                                   value="{{ old('jabatan', $sambutan->jabatan) }}"
                                   placeholder="Contoh: Kepala Puskesmas"
                                   required>
                            @error('jabatan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="foto">Foto Kepala Puskesmas</label>
                            @if($sambutan->foto)
                                <div class="mb-2">
                                    <img src="{{ asset('storage/' . $sambutan->foto) }}" 
                                         alt="{{ $sambutan->nama_kepala }}" 
                                         class="img-thumbnail" 
                                         style="max-width: 200px;">
                                    <p class="text-muted mt-1">Foto saat ini</p>
                                </div>
                            @endif
                            <div class="custom-file">
                                <input type="file" 
                                       class="custom-file-input @error('foto') is-invalid @enderror" 
                                       id="foto" 
                                       name="foto"
                                       accept="image/*">
                                <label class="custom-file-label" for="foto">Pilih foto baru...</label>
                            </div>
                            <small class="form-text text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah foto.</small>
                            @error('foto')
                                <div class="invalid-feedback d-block">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="isi_sambutan">Isi Sambutan <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('isi_sambutan') is-invalid @enderror" 
                                      id="isi_sambutan" 
                                      name="isi_sambutan" 
                                      rows="10"
                                      placeholder="Masukkan isi sambutan kepala puskesmas"
                                      required>{{ old('isi_sambutan', $sambutan->isi_sambutan) }}</textarea>
                            @error('isi_sambutan')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="status">Status <span class="text-danger">*</span></label>
                            <select class="form-control @error('status') is-invalid @enderror" 
                                    id="status" 
                                    name="status"
                                    required>
                                <option value="Aktif" {{ old('status', $sambutan->status) == 'Aktif' ? 'selected' : '' }}>Aktif</option>
                                <option value="Non-Aktif" {{ old('status', $sambutan->status) == 'Non-Aktif' ? 'selected' : '' }}>Non-Aktif</option>
                            </select>
                            <small class="form-text text-muted">Hanya sambutan dengan status "Aktif" yang akan ditampilkan di halaman utama</small>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Update
                        </button>
                        <a href="{{ route('sambutan.index') }}" class="btn btn-secondary">
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
    // Preview nama file yang dipilih
    $('.custom-file-input').on('change', function() {
        let fileName = $(this).val().split('\\').pop();
        $(this).next('.custom-file-label').addClass("selected").html(fileName);
    });
</script>
@endpush
@endsection
