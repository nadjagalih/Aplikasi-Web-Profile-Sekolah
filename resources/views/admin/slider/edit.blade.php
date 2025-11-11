@extends('admin.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-10 mx-auto">
      <div class="card w-100">
        <div class="card-header bg-primary">
            <div class="row align-items-center">
                <div class="col-6">
                    <h5 class="card-title fw-semibold text-white">Edit Gambar Slider</h5>
                </div>
                <div class="col-6 text-right">
                    <a href="/admin/slider" type="button" class="btn btn-danger float-end">Kembali</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            @if (session()->has('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <form method="POST" action="/admin/slider/{{ $slider->id }}" enctype="multipart/form-data">
                @method('put')
                @csrf

                <div class="mb-3">
                    <img src="{{ asset('storage/' .$slider->img_slider) }}" class="img-preview img-fluid mb-3 mt-2" id="preview" style="border-radius: 5px; max-width: 100%; max-height: 400px;"><br>
                    <label for="img_slider" class="form-label">Gambar Slider</label>
                    <input class="form-control @error('img_slider') is-invalid @enderror" type="file" id="img_slider" name="img_slider" onchange="previewImage()">
                    <small class="text-muted">Format: JPG, JPEG, PNG. Maksimal 2MB. Kosongkan jika tidak ingin mengubah gambar</small>
                    @error('img_slider')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <button type="submit" class="btn btn-primary m-1 float-end">
                    <i class="ti ti-device-floppy"></i> Update
                </button>
            </form>
        </div>
      </div>
    </div>
</div>

<script>
    function previewImage(){
        var preview     = document.getElementById('preview');
        var fileInput   = document.getElementById('img_slider');
        var file        = fileInput.files[0];
        var reader      = new FileReader();

        reader.onload = function(e){
            preview.src = e.target.result;
        };
        reader.readAsDataURL(file);
    }
</script>

@endsection