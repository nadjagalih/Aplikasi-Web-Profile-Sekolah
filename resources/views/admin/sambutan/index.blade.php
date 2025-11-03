@extends('admin.layouts.app')

@section('title', 'Kelola Sambutan Kepala Puskesmas')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kelola Sambutan Kepala Puskesmas</h3>
                    <div class="card-tools">
                        <a href="{{ route('sambutan.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Sambutan
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th width="15%">Foto</th>
                                    <th width="20%">Nama Kepala</th>
                                    <th width="15%">Jabatan</th>
                                    <th width="10%">Status</th>
                                    <th width="15%">Tanggal Dibuat</th>
                                    <th width="20%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($sambutans as $index => $sambutan)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>
                                            @if($sambutan->foto)
                                                <img src="{{ asset('storage/' . $sambutan->foto) }}" 
                                                     alt="{{ $sambutan->nama_kepala }}" 
                                                     class="img-thumbnail" 
                                                     style="max-width: 100px;">
                                            @else
                                                <span class="badge badge-secondary">Tidak ada foto</span>
                                            @endif
                                        </td>
                                        <td>{{ $sambutan->nama_kepala }}</td>
                                        <td>{{ $sambutan->jabatan }}</td>
                                        <td>
                                            @if($sambutan->status == 'Aktif')
                                                <span class="badge badge-success">Aktif</span>
                                            @else
                                                <span class="badge badge-secondary">Non-Aktif</span>
                                            @endif
                                        </td>
                                        <td>{{ $sambutan->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <a href="{{ route('sambutan.edit', $sambutan->id) }}" 
                                               class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <form action="{{ route('sambutan.destroy', $sambutan->id) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus sambutan ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i> Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="text-center">Belum ada data sambutan</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
