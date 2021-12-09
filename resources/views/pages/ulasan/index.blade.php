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
                            <h1>{{ ucwords(str_replace('-',' ',Request::segment(1))) }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-end">
                        <div class="page-title">
                            <ol class="breadcrumb text-end">
                                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class="active">{{ ucwords(str_replace('-',' ',Request::segment(1))) }}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="content">
        <div class="animated fadeIn">
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Rating Produk</th>
                                        <th>Nama Produk</th>
                                        <th>Ulasan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ ucwords($item->rating ) }}</td>
                                            <td>{{ ucwords($item->name_product ) }}</td>
                                            <td>{{ ucwords($item->desc_rating ) }}</td>
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
