@extends('admin.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
      <div class="card w-100">
        <div class="card-header bg-primary">
            <div class="row align-items-center">
                <div class="col-6">
                    <h5 class="card-title fw-semibold text-white">Kontak</h5>
                </div>
                <div class="col-6 text-right">
                    <a href="/kontak" type="button" class="btn btn-warning float-end me-2" target="_blank">Live Preview</a>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            @if (session()->has('success'))
                <div class="alert alert-success" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <div class="row">
                <div class="col-lg-8">
                    @if($kontak->map_url)
                        <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" id="gmap_canvas" src="{{ $kontak->map_url }}"></iframe>
                    @else
                        <iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" id="gmap_canvas" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d252760.86139202642!2d111.47004833973135!3d-8.163560447044588!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e791ad33bad6389%3A0x19f173f90f85d9be!2sTrenggalek%2C%20Kabupaten%20Trenggalek%2C%20Jawa%20Timur!5e0!3m2!1sid!2sid!4v1762759569624!5m2!1sid!2sid"></iframe>
                    @endif
                </div>
                <div class="col-lg-4">
                    <form method="POST" action="/admin/kontak/{{ $kontak->id }}">
                        @method('put')
                        @csrf
    
                        <div class="col">
                            <div class="mb-3">
                                <label for="email" class="form-label">email <span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="email" id="email" value="{{ old('email', $kontak->email) }}">
                                @error('email')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="no_hp" class="form-label">no_hp <span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="no_hp" id="no_hp" value="{{ old('no_hp', $kontak->no_hp) }}">
                                @error('no_hp')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="lokasi" class="form-label">Alamat Lengkap <span style="color: red">*</span></label>
                                <input type="text" class="form-control" name="lokasi" id="lokasi" value="{{ old('lokasi', $kontak->lokasi) }}">
                                <i><small>Contoh : Karangmulyo, Purwodadi, Purworejo</small></i>
                                @error('lokasi')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="map_url" class="form-label">URL Google Maps (Opsional)</label>
                                <textarea class="form-control" name="map_url" id="map_url" rows="3" placeholder="Paste URL iframe Google Maps di sini...">{{ old('map_url', $kontak->map_url) }}</textarea>
                                @error('map_url')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <i><small class="text-muted">
                                    <strong>Cara mendapatkan URL:</strong><br>
                                    1. Buka Google Maps → Cari lokasi<br>
                                    2. Klik "Share" → Klik bagian "Sematkan Peta"<br>
                                    3. Klik "Salin HTML"<br>
                                    Jika kosong, akan menggunakan alamat di atas
                                </small></i>
                            </div>
                            <div class="mb-3">
                                <label for="instagram_url" class="form-label">URL Instagram (Opsional)</label>
                                <input type="text" class="form-control" name="instagram_url" id="instagram_url" value="{{ old('instagram_url', $kontak->instagram_url) }}" placeholder="https://www.instagram.com/username">
                                @error('instagram_url')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                                <i><small class="text-muted">Contoh: https://www.instagram.com/username atau https://instagram.com/username</small></i>
                            </div>
                        </div>
    
                        <button type="submit" class="btn btn-primary m-1 float-end">Update</button>
                   </form>
                </div>
            </div>
              
        </div>

      </div>
    </div>
</div>

<script>
    // Auto extract src from iframe if user paste entire iframe code
    document.getElementById('map_url').addEventListener('paste', function(e) {
        setTimeout(() => {
            let value = this.value.trim();
            
            // Check if pasted content contains iframe tag
            if (value.includes('<iframe') && value.includes('src=')) {
                // Extract src attribute
                let match = value.match(/src="([^"]*)"/);
                if (match && match[1]) {
                    this.value = match[1];
                }
            }
        }, 10);
    });

    // Preview update on input
    document.getElementById('map_url').addEventListener('input', function() {
        let url = this.value.trim();
        if (url) {
            // Extract src if it's still iframe code
            if (url.includes('<iframe') && url.includes('src=')) {
                let match = url.match(/src="([^"]*)"/);
                if (match && match[1]) {
                    url = match[1];
                }
            }
            document.getElementById('gmap_canvas').src = url;
        }
    });
</script>
@endsection