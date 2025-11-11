@extends('admin.layouts.main')

@section('content')
<style>
    .custom-card {
        width: 100%;
        height: 375px;
        /* Atur tinggi kartu sesuai kebutuhan */
    }

    .card-img {
        width: 100%;
        height: 100%;
        border-radius: 5px;
        background-size: cover;
        /* Untuk mengisi kartu dengan gambar tanpa pemotongan */
    }
</style>

<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-header bg-primary">
                <div class="row align-items-center">
                    <div class="col-6">
                        <h5 class="card-title fw-semibold text-white">Gambar Slider</h5>
                    </div>
                    <div class="col-6 text-right">
                        <a href="/admin/slider/create" type="button" class="btn btn-success float-end me-2">
                            <i class="ti ti-plus"></i> Tambah Slider
                        </a>
                        <a href="/" type="button" class="btn btn-warning float-end me-2" target="_blank">Live Preview</a>
                    </div>
                </div>
            </div>

            <div class="card-body">
                @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if (session()->has('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <div class="row">
                    @foreach ($sliders as $slider)
                    <div class="col-md-4">
                        <div class="card custom-card mb-4">
                            @php
                            $bgImage = asset('storage/' . $slider->img_slider);
                            @endphp
                            <div class="card-img" style="background-image: url('{{ $bgImage }}');"></div>
                            <div class="card-body">
                                <p class="mb-3"><strong>Slider {{ $loop->iteration }}</strong></p>
                                <a href="/admin/slider/{{ $slider->id }}/edit" type="button" class="btn btn-warning">
                                    <i class="ti ti-edit"></i> Edit
                                </a>
                                <form action="/admin/slider/{{ $slider->id }}" method="POST" class="d-inline" onsubmit="return confirm('Apakah Anda yakin ingin menghapus slider ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">
                                        <i class="ti ti-trash"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection