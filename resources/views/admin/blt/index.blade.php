@extends('admin.layouts.main')

@section('content')
<div class="row">
    <div class="col-lg-12">
      <div class="card shadow-lg w-100">
        <div class="card-header bg-primary">
            <div class="d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <h5 class="card-title fw-semibold text-white mb-0">Master Data Penerima BLT</h5>
                <div class="d-flex flex-wrap justify-content-center gap-2">
                    <a href="/admin/blt/export" class="btn btn-success btn-sm">
                        <i class="ti ti-file-export"></i> Export
                    </a>
                    <button type="button" class="btn btn-light btn-sm" data-bs-toggle="modal" data-bs-target="#importModal">
                        <i class="ti ti-file-import"></i> Import
                    </button>
                    <a href="/admin/blt/create" class="btn btn-warning btn-sm">
                        <i class="ti ti-plus"></i> Tambah Data
                    </a>
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

            <div class="table-responsive mt-2">
                <table id="table_blt" class="table table-hover nowrap w-100">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>NIK</th>
                            <th>Nama</th>
                            <th class="d-none d-md-table-cell">Tahun</th>
                            <th>Metode Pencairan</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($blts as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td><span class="fw-bold">{{ $item->nik }}</span></td>
                                <td>{{ $item->nama }}</td>
                                <td class="d-none d-md-table-cell">{{ $item->tahun }}</td>
                                <td>{{ $item->metode_pencairan }}</td>
                                <td>
                                    @if($item->status == 'cair')
                                        <span class="badge bg-success">CAIR</span>
                                    @elseif($item->status == 'ditolak')
                                        <span class="badge bg-danger">DITOLAK</span>
                                    @else
                                        <span class="badge bg-warning text-dark">{{ strtoupper($item->status) }}</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group">
                                        <a href="/admin/blt/{{ $item->id }}/edit" class="btn btn-warning btn-sm"><i class="ti ti-edit"></i></a>
                                        <form id="del-{{ $item->id }}" action="/admin/blt/{{ $item->id }}" method="POST" class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button type="button" class="btn btn-danger btn-sm swal-confirm" data-form="del-{{ $item->id }}"><i class="ti ti-trash"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
      </div>
    </div>
</div>

{{-- Modal Import Tetap Sama --}}
<div class="modal fade" id="importModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <form action="/admin/blt/import" method="POST" enctype="multipart/form-data" class="w-100">
        @csrf
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Import Excel</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
          </div>
          <div class="modal-body p-4">
            <input type="file" name="file" class="form-control" required>
            <small class="text-muted mt-2 d-block">*Pastikan format kolom sesuai template.</small>
          </div>
          <div class="modal-footer">
            <button type="submit" class="btn btn-primary w-100">Proses Import</button>
          </div>
        </div>
    </form>
  </div>
</div>

<script>
    $(document).ready( function () {
        $('#table_blt').DataTable({
            responsive: true,
            autoWidth: false,
            // Mengurutkan berdasarkan data terbaru (kolom ID atau No)
            order: [[0, 'asc']],
            language: {
                search: "_INPUT_",
                searchPlaceholder: "Cari NIK, Nama, atau Status...",
                lengthMenu: "_MENU_",
            }
        });
    });
</script>
@endsection
