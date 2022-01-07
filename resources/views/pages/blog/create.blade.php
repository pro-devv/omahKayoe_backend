@extends('layouts.template')
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
                                <li class=""><a href="{{ route('blog.index') }}">{{ ucwords(str_replace('-',' ',Request::segment(2))) }}</a> </li>
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
                            <form action="{{ route('blog.store') }}" method="post" class="form-vertical" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="title" class="form-control-label mb-2">Judul Blog <span>*</span></label>
                                    <input type="text" id="title" name="title" placeholder="Masukkan Judul Blog" class="form-control @error('title') is-invalid @enderror" >
                                    @error('title')
                                    <div class="invalid-feedback">
                                        <small class="help-block form-text text-danger">{{$message}}</small>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <div class="row">
                                        <div class="col">
                                            <label for="kategori" class=" form-control-label mb-2">Kategori Blog<span> *</span></label>
                                            <select class="form-control" name="kategori" id="kategori">
                                                @forelse ($data as $item)
                                                    <option value="{{ $item->id }}">{{ ucwords($item->name_blog ) }}</option>
                                                @empty
                                                <p class="text-warning">Tidak ada data</p>
                                                @endforelse
                                            </select>
                                        </div>
                                        <div class="col">
                                            <label for="user_id" class="form-control-label mb-2">Nama Pengarang <span>*</span></label>
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
                                    <label for="desc" class="form-control-label mb-2">Deskripsi <span>*</span></label>
                                    <textarea name="desc" id="summernote" class="form-control @error('desc') is-invalid @enderror" cols="30" rows="10"></textarea>
                                    @error('desc')
                                    <div class="invalid-feedback">
                                        <small class="help-block form-text text-danger">{{$message}}</small>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="gambar_blog" class=" form-control-label mb-2">Thumbnail <span>*</span></label>
                                    <input type="file" id="gambar_blog" name="gambar_blog" class="form-control @error('gambar_blog') is-invalid @enderror">
                                    @error('gambar_blog')
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

<!-- include libraries(jQuery, bootstrap) -->
{{-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet"> --}}
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

<!-- include summernote css/js -->
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>

<script type="text/javascript">
    jQuery(document).ready(function($) {
        $('#summernote').summernote({
            callbacks: {
        onPaste: function (e) {
            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

            e.preventDefault();

            // Firefox fix
            setTimeout(function () {
                document.execCommand('insertText', false, bufferText);
            }, 10);
        }
    }
        });
    });
</script>

@endpush
