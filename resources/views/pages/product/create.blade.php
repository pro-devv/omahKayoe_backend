@extends('layouts.template')
@push('css')
{{-- <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap-colorpicker.css') }}"> --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.3.3/css/bootstrap-colorpicker.css" integrity="sha512-hKFYpObSr7o0QUPe5owNQQXOTnErkr0wudSPuqsIoGZtkmZMui0UauNNaoTwXWgKTh/MfR8tAOpwpT6XhqzGDw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/css/bootstrap-colorpicker.min.css" integrity="sha512-m/uSzCYYP5f55d4nUi9mnY9m49I8T+GUEe4OQd3fYTpFU9CIaPazUG/f8yUkY0EWlXBJnpsA7IToT2ljMgB87Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />
@endpush
@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>{{ 'Tambah '.ucwords(str_replace('-',' ',Request::segment(2))) }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-end">
                        <div class="page-title">
                            <ol class="breadcrumb text-end">
                                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class=""><a href="{{ route('product.index') }}">{{ ucwords(str_replace('-',' ',Request::segment(2))) }}</a> </li>
                                <li class="active">{{ ucwords(str_replace('-',' ',Request::segment(3))) }}</li>
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
                            <form action="{{ route('product.store') }}" method="post" class="form-vertical" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                   <div class="row">
                                       <div class="col-md-8">
                                            <label for="nama_produk" class="form-control-label mb-2">Nama Produk <span>*</span></label>
                                            <input type="text" id="nama_produk" name="nama_produk" placeholder="Masukkan Nama Kursi" class="form-control @error('nama_produk') is-invalid @enderror" >
                                            @error('nama_produk')
                                            <div class="invalid-feedback">
                                                <small class="help-block form-text text-danger">{{$message}}</small>
                                            </div>
                                            @enderror
                                       </div>
                                       <div class="col-md-4">
                                        <label for="user_id" class="form-control-label mb-2">Nama Pengrajin <span>*</span></label>
                                        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}"  class="form-control @error('user') is-invalid @enderror" readonly>
                                        <input type="text" id="user" name="user" value="{{ Auth::user()->name }}" placeholder="" class="form-control @error('user') is-invalid @enderror" readonly>
                                        @error('user_id')
                                        <div class="invalid-feedback">
                                            <small class="help-block form-text text-danger">{{$message}}</small>
                                        </div>
                                        @enderror
                                       </div>
                                   </div>
                                </div>
                                <div class="form-group mb-3">
                                   <div class="row">
                                       <div class="col">
                                            <label for="price" class="form-control-label mb-2">Harga <span>*</span></label>
                                            <input type="text" id="price" name="price" placeholder="Masukkan Jumlah Harga" class="form-control @error('price') is-invalid @enderror" >
                                            @error('price')
                                            <div class="invalid-feedback">
                                                <small class="help-block form-text text-danger">{{$message}}</small>
                                            </div>
                                            @enderror
                                       </div>
                                        <div class="col">
                                            <label for="color" class="form-control-label mb-2">Warna Produk<span>*</span></label>
                                            <input id="warna" type="text" name="color" class="form-control value=""/>
                                            {{-- <input type="text" id="color" name="color" placeholder="Masukkan Judul Banner" class="form-control @error('color') is-invalid @enderror" > --}}
                                            @error('color')
                                            <div class="invalid-feedback">
                                                <small class="help-block form-text text-danger">{{$message}}</small>
                                            </div>
                                            @enderror
                                       </div>
                                   </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="kategori" class=" form-control-label mb-2">Kategori<span>*</span></label>
                                    <select class="form-control" name="kategori" id="kategori">
                                        @forelse ($data as $item)
                                            <option value="{{ $item->id }}">{{ ucwords($item->name_category ) }}</option>
                                        @empty
                                        <p class="text-warning">Tidak ada data</p>
                                        @endforelse
                                    </select>
                                    @error('kategori')
                                    <div class="invalid-feedback">
                                        <small class="help-block form-text text-danger">{{$message}}</small>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="desc" class="form-control-label mb-2">Deskripsi <span>*</span></label>
                                    <textarea name="desc" id="desc" class="form-control @error('desc') is-invalid @enderror" cols="30" rows="10"></textarea>
                                    @error('desc')
                                    <div class="invalid-feedback">
                                        <small class="help-block form-text text-danger">{{$message}}</small>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="gambar_produk" class=" form-control-label mb-2">Foto Produk <span>*</span></label>
                                    <input type="file" id="gambar_produk" name="gambar_produk" class="form-control @error('gambar_produk') is-invalid @enderror">
                                    @error('gambar_produk')
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
        </div>
    </div>
@endsection
@push('js')
{{-- <script src="{{ asset('frontend/js/jquery.js') }}"></script> --}}
{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha512-+NqPlbbtM1QqiK8ZAo4Yrj2c4lNQoGv8P79DPtKzj++l5jnN39rHA/xsqn8zE9l0uSoxaCdrOgFs6yjyfbBxSg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/3.4.0/js/bootstrap-colorpicker.min.js" integrity="sha512-94dgCw8xWrVcgkmOc2fwKjO4dqy/X3q7IjFru6MHJKeaAzCvhkVtOS6S+co+RbcZvvPBngLzuVMApmxkuWZGwQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    jQuery(document).ready(function($) {
        $('#warna').colorpicker();
    })
</script>
@endpush
