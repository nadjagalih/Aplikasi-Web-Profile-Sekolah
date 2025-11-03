@extends('admin.layouts.app')

@section('title', 'Kelola Agenda')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Kelola Agenda Kegiatan</h3>
                    <div class="card-tools">
                        <a href="{{ route('agenda.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Tambah Agenda
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
                                    <th width="20%">Judul</th>
                                    <th width="15%">Tanggal Mulai</th>
                                    <th width="15%">Tanggal Selesai</th>
                                    <th width="15%">Tempat</th>
                                    <th width="10%">Warna</th>
                                    <th width="10%">Status</th>
                                    <th width="10%">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($agendas as $index => $agenda)
                                    <tr>
                                        <td>{{ $index + 1 }}</td>
                                        <td>{{ $agenda->judul }}</td>
                                        <td>{{ $agenda->tanggal_mulai->format('d/m/Y H:i') }}</td>
                                        <td>{{ $agenda->tanggal_selesai ? $agenda->tanggal_selesai->format('d/m/Y H:i') : '-' }}</td>
                                        <td>{{ $agenda->tempat ?? '-' }}</td>
                                        <td>
                                            <span class="color-box" data-color="{{ $agenda->warna }}"></span>
                                        </td>
                                        <td>
                                            @if($agenda->status == 'Aktif')
                                                <span class="badge badge-success">Aktif</span>
                                            @elseif($agenda->status == 'Selesai')
                                                <span class="badge badge-secondary">Selesai</span>
                                            @else
                                                <span class="badge badge-danger">Dibatalkan</span>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('agenda.edit', $agenda->id) }}" 
                                               class="btn btn-warning btn-sm">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('agenda.destroy', $agenda->id) }}" 
                                                  method="POST" 
                                                  class="d-inline"
                                                  onsubmit="return confirm('Yakin ingin menghapus agenda ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center">Belum ada data agenda</td>
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

@push('styles')
<style>
    .color-box {
        display: inline-block;
        width: 30px;
        height: 30px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
</style>
@endpush

@push('scripts')
<script>
    // Set background color dari data attribute
    document.querySelectorAll('.color-box').forEach(function(el) {
        el.style.background = el.getAttribute('data-color');
    });
</script>
@endpush

@endsection
