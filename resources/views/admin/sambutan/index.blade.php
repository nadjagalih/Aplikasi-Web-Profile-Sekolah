@extends('admin.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-header bg-primary">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h5 class="card-title fw-semibold text-white">Sambutan Kepala Puskesmas</h5>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
                @endif

                @if($sambutan)
                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            @if($sambutan->foto && file_exists(storage_path('app/public/' . $sambutan->foto)))
                                <img src="{{ asset('storage/' . $sambutan->foto) }}" alt="{{ $sambutan->nama }}" class="rounded img-preview py-3" id="preview">
                            @else
                                <div class="d-flex align-items-center justify-content-center" style="height: 300px; background-color: #f0f0f0;">
                                    <span class="text-muted">Tidak ada foto</span>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col">
                                <div class="mb-3">
                                    <h5><strong>{{ $sambutan->nama }}</strong></h5>
                                    <p class="text-muted">{{ $sambutan->jabatan }}</p>
                                </div>
                                <div class="mb-3">
                                    <h6><strong>Isi Sambutan:</strong></h6>
                                    <p>{!! $sambutan->isi_sambutan !!}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                <div class="alert alert-info">
                    Belum ada data sambutan
                </div>
                @endif
            </div>
            <div class="card-footer">
                @if($sambutan)
                    <a href="/admin/sambutan/{{ $sambutan->id }}/edit" type="button" class="btn btn-warning mb-1 float-end"><i class="ti ti-edit"></i> Edit Sambutan</a>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection
