@extends('admin.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12 d-flex align-items-strech">
      <div class="card w-100">
        <div class="card-header bg-primary">
            <div class="row align-items-center">
                <div class="col-6">
                    <h5 class="card-title fw-semibold text-white">Edit Sambutan Kepala Puskesmas</h5>
                </div>
            </div>
        </div>
        
        <div class="card-body">
            <form method="POST" action="/admin/sambutan/{{ $sambutan->id }}" enctype="multipart/form-data">
                @method('put')
                @csrf

                <div class="row">
                    <div class="col-lg-4">
                        <div class="card">
                            @if($sambutan->foto && file_exists(storage_path('app/public/' . $sambutan->foto)))
                                <img src="{{ asset('storage/' . $sambutan->foto) }}" alt="Foto Sambutan" class="rounded img-preview py-3" id="preview">
                            @else
                                <img class="rounded img-preview py-3" id="preview" style="display: none;">
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="mb-3">
                            <label for="foto" class="form-label">Foto Kepala Puskesmas <span style="color: red">*</span></label><br>
                            <input type="file" class="form-control" name="foto" id="foto" onchange="previewImage()" accept="image/*">
                            @error('foto')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="nama" class="form-label">Nama Kepala Puskesmas <span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="nama" id="nama" value="{{ old('nama', $sambutan->nama) }}" required>
                            @error('nama')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="jabatan" class="form-label">Jabatan <span style="color: red">*</span></label>
                            <input type="text" class="form-control" name="jabatan" id="jabatan" value="{{ old('jabatan', $sambutan->jabatan) }}" required>
                            @error('jabatan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="isi_sambutan" class="form-label">Isi Sambutan <span style="color: red">*</span></label>
                            <textarea class="form-control" id="editor" name="isi_sambutan" rows="10" required>{{ old('isi_sambutan', $sambutan->isi_sambutan) }}</textarea>
                            @error('isi_sambutan')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn btn-primary m-1 float-end">Update</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Ck Editor 5 -->
<script>
    let editorInstance;
    ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .then( editor => {
             editorInstance =editor;
        } )
        .catch( error => {
            console.error( error );
        } );

    function previewImage(){
        var preview     = document.getElementById('preview');
        var fileInput   = document.getElementById('foto');
        var file        = fileInput.files[0];
        var reader      = new FileReader();

        reader.onload = function(e){
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    }
</script>
@endsection
