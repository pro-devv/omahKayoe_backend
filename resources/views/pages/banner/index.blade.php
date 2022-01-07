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
                <div class="col-sm-12">
                    <a href="{{ route('banner.create') }}">
                        <button class="btn btn-primary btn-icon-split mb-3 float-left">
                            <span class="icon text-white">
                                <i class="ti-plus"></i>&nbsp;Tambah Data
                            </span>
                        </button>
                    </a>
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
                                        <th>Thumbnail</th>
                                        <th>Title</th>
                                        <th>Desc</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td style="width: 25%">
                                                <img src="{{ asset('img/banner/'.$item->banner) }}" alt="{{ $item->title }}" class="img-fluid w-50">
                                            </td>
                                            <td>{{ ucwords($item->title ) }}</td>
                                            <td>{{ ucwords($item->desc ) }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <div class="p-1">
                                                        <a href="{{ route('banner.edit',$item->id) }}" class="btn btn-warning"><i class="ti-pencil-alt"></i></a>
                                                    </div>
                                                    <div class="p-1">
                                                        <form action="{{ route('banner.destroy',$item->id) }}" method="POST">
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
