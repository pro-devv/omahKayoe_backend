@extends('layouts.template')
@push('css')
    <link rel="stylesheet" href="{{ asset('backend/assets/lib/datatable/dataTables.bootstrap.min.css') }}">
@endpush
@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>{{ ucwords(str_replace('-',' ',Request::segment(2))) }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-end">
                        <div class="page-title">
                            <ol class="breadcrumb text-end">
                                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="active">{{ ucwords(str_replace('-',' ',Request::segment(2))) }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="row">
            @if (session('status'))
                <div class="alert alert-success" role="alert">
                    {{session('status')}}
                </div>
            @elseif (session('error'))
                <div class="alert alert-danger" role="alert">
                    {{session('error')}}
                </div>
            @endif
        </div>
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                           <strong>Tambah Data</strong>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('category-blog.store') }}" method="post" class="form-vertical" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="nama_kategori" class="form-control-label mb-2">Nama Kategori <span>*</span></label>
                                    <input type="text" id="nama_kategori" name="nama_kategori" placeholder="Masukkan Nama Kategori" class="form-control @error('nama_kategori') is-invalid @enderror"  autofocus>
                                    @error('nama_kategori')
                                    <div class="invalid-feedback">
                                        <small class="help-block form-text text-danger">{{$message}}</small>
                                    </div>
                                    @enderror
                                </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fa fa-dot-circle-o"></i> Simpan
                            </button>
                            <button type="reset" class="btn btn-danger btn-sm">
                                <i class="fa fa-ban"></i> Reset
                            </button>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Kategori Produk</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ ucwords($item->name_blog ) }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="p-1">
                                                        <a href="{{ route('category-blog.edit',$item->id) }}" class="btn btn-warning"><i class="ti-pencil-alt"></i></a>
                                                    </div>
                                                    <div class="p-1">
                                                        <form action="{{ route('category-blog.destroy',$item->id) }}" method="POST">
                                                            @method('delete')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus Data ?')"><i class="ti-trash"></i></button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @empty
                                        <p class="text-warning">Tidak ada data</p>
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

@push('js')
    <script src="{{ asset('backend/assets/js/lib/data-table/datatables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/lib/data-table/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/lib/data-table/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/lib/data-table/buttons.bootstrap.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/lib/data-table/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/lib/data-table/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/assets/js/lib/data-table/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/lib/data-table/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/lib/data-table/buttons.colVis.min.js') }}"></script>
    {{-- <script src="{{ asset('backend/assets/js/init/datatables-init.js') }}"></script> --}}


    <script type="text/javascript">
        $(document).ready(function() {
        $('#datatable').DataTable();
    } );
    </script>
@endpush
