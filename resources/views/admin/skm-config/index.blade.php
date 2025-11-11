@extends('admin.layouts.app')

@section('title', 'Konfigurasi SKM')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-8 col-xl-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Konfigurasi API Survey Kepuasan Masyarakat (SKM)</h3>
                </div>
                <form action="{{ route('skm-config.store') }}" method="POST">
                    @csrf
                    <div class="card-body">
                        @if(session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        @if(session('error'))
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                {{ session('error') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle"></i> 
                            <strong>Informasi:</strong> Masukkan URL lengkap API SKM Puskesmas Anda.
                        </div>

                        <div class="form-group">
                            <label for="api_url">URL API SKM <span class="text-danger">*</span></label>
                            <input type="url" 
                                   class="form-control @error('api_url') is-invalid @enderror" 
                                   id="api_url" 
                                   name="api_url" 
                                   value="{{ old('api_url') }}"
                                   placeholder="https://skm.trenggalekkab.go.id/api/survey-organisasi/NDYwMDAwMDAwMA"
                                   required>
                            @error('api_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Masukkan URL lengkap API SKM termasuk kode organisasi di akhir
                            </small>
                        </div>

                        <div class="form-group">
                            <label for="login_url">URL Login SKM <span class="text-danger">*</span></label>
                            <input type="url" 
                                   class="form-control @error('login_url') is-invalid @enderror" 
                                   id="login_url" 
                                   name="login_url" 
                                   value="{{ old('login_url') }}"
                                   placeholder="https://skm.trenggalekkab.go.id/survey-responden/NDYwMDAwMDAwMA"
                                   required>
                            @error('login_url')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">
                                Masukkan URL login SKM yang akan ditampilkan di header website. Tombol "Login SKM" akan muncul di header.
                            </small>
                        </div>

                        @if($config)
                        <div class="alert alert-secondary mt-3">
                            <strong>Status Konfigurasi:</strong>
                            <ul class="mb-0 mt-2">
                                <li>Terakhir diperbarui: {{ $config->updated_at->format('d/m/Y H:i') }}</li>
                                <li>URL API saat ini: <code>{{ Str::limit($config->api_url, 80) }}</code></li>
                                @if($config->login_url)
                                <li>URL Login SKM: <code>{{ Str::limit($config->login_url, 80) }}</code></li>
                                @else
                                <li>URL Login SKM: <span class="text-muted">Belum diatur</span></li>
                                @endif
                            </ul>
                        </div>
                        @else
                        <div class="alert alert-warning mt-3">
                            <i class="fas fa-exclamation-triangle"></i> 
                            Belum ada konfigurasi SKM. Silakan isi URL API di atas.
                        </div>
                        @endif
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> {{ $config ? 'Update' : 'Simpan' }} Konfigurasi
                        </button>
                        <a href="/dashboard" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
