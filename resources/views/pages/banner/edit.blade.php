@extends('layouts.template')
@push('css')
    <style>
        .test {
            text-emphasis: none;
        }
    </style>
@endpush
@section('content')
    <div class="breadcrumbs">
        <div class="breadcrumbs-inner">
            <div class="row m-0">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>{{ ucwords(str_replace('-',' ',Request::segment(4))).' Banner' }}</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-end">
                        <div class="page-title">
                            <ol class="breadcrumb text-end">
                                <li><a href="{{ route('dashboard') }}">Dashboard</a></li>
                                <li class=""><a href="{{ route('banner.index') }}">{{ ucwords(str_replace('-',' ',Request::segment(2))) }}</a> </li>
                                <li class="active">{{ ucwords(str_replace('-',' ',Request::segment(4))) }}</li>
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
                            <form action="{{ route('banner.update',$data->id) }}" method="post" class="form-vertical" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="form-group mb-3">
                                    <label for="title" class="form-control-label mb-2">Judul Banner <span>*</span></label>
                                    <input type="text" id="title" name="title" placeholder="Masukkan Judul Banner" class="form-control @error('title') is-invalid @enderror" value="{{ $data->title }}">
                                    @error('title')
                                    <div class="invalid-feedback">
                                        <small class="help-block form-text text-danger">{{$message}}</small>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="desc" class="form-control-label mb-2">Deskripsi <span>*</span></label>
                                    <textarea name="desc" id="desc" class="form-control @error('desc') is-invalid @enderror" cols="30" rows="10">{{ $data->desc }}</textarea>
                                    @error('desc')
                                    <div class="invalid-feedback">
                                        <small class="help-block form-text text-danger">{{$message}}</small>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <div class="row">
                                        <div class="col" id="">
                                            <img src="{{ asset('img/banner/'.$data->banner) }}" alt="{{ $data->title }}" srcset="" id="photosPreview">
                                        </div>
                                        <div class="col">
                                            <label for="gambar_banner" class=" form-control-label mb-2">Thumbnail <span>*</span></label>
                                            <input type="file" id="gambar_banner" name="gambar_banner" class="form-control @error('gambar_banner') is-invalid @enderror">
                                            @error('gambar_banner')
                                            <div class="invalid-feedback">
                                                <small class="help-block form-text text-danger">{{$message}}</small>
                                            </div>
                                            @enderror
                                        </div>
                                    </div>
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
    <script>
        jQuery(document).ready(function($) {
            $('#gambar_banner').change(function () {
                const file = this.files[0];
                if (file) {
                    let reader = new FileReader();
                    reader.onload = function (event) {
                        $('#photosPreview')
                        .attr("src",event.target.result);
                    };
                    reader.readAsDataURL(file);
                }
            })
        });
    </script>
@endpush
