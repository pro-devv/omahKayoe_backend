@extends('layouts.template')
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
        <div class="animated fadeIn">
            <div class="row">
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
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('edit.profil.insert') }}" method="post" class="form-vertical" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="nama" class="form-control-label mb-2">Nama Lengkap<span>*</span></label>
                                    <input type="text" id="nama" name="nama" value="{{ $data->name }}" placeholder="Masukkan Nama Lengkap" class="form-control @error('nama') is-invalid @enderror" >
                                    @error('nama')
                                    <div class="invalid-feedback">
                                        <small class="help-block form-text text-danger">{{$message}}</small>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email" class="form-control-label mb-2">Email<span>*</span></label>
                                    <input type="text" id="email" name="email" value="{{ $data->email }}" placeholder="Masukkan Email" class="form-control @error('email') is-invalid @enderror" >
                                    @error('email')
                                    <div class="invalid-feedback">
                                        <small class="help-block form-text text-danger">{{$message}}</small>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="gender" class="form-control-label mb-2">Jenis Kelamin<span>*</span></label>
                                    @error('gender')
                                    <div class="invalid-feedback">
                                        <small class="help-block form-text text-danger">{{$message}}</small>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio1" value="l" {{ $data->gender == 'l' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineRadio1">Laki-Laki</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="gender" id="inlineRadio2" value="p" {{ $data->gender == 'p' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineRadio2">Perempuan</label>
                                    </div>
                                </div>
                                <div class="form-group mb-3">
                                    <label for="no_hp" class="form-control-label mb-2">No HP<span>*</span></label>
                                    <input type="text" id="no_hp" name="no_hp" value="{{ $data->no_hp }}" placeholder="Masukkan No HP" class="form-control @error('no_hp') is-invalid @enderror" >
                                    <span class="form-text text-muted">Contoh : 085xxxx</span>
                                    @error('no_hp')
                                    <div class="invalid-feedback">
                                        <small class="help-block form-text text-danger">{{$message}}</small>
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="address" class="form-control-label mb-2">Alamat Lengkap<span>*</span></label>
                                    <textarea name="address" id="" cols="30" rows="10" class="form-control @error('address') is-invalid @enderror" placeholder="Masukkan Alamat Anda">{{ $data->address }}</textarea>
                                    @error('address')
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
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-body">
                            <form action="{{ route('lupa.password') }}" method="post" class="form-vertical" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group mb-3">
                                    <label for="nama" class="form-control-label mb-2">Password Baru<span>*</span></label>
                                    <div class="input-group" id="show_hide_password">
                                        <input class="form-control @error('password') is-invalid @enderror" " type="password" name="password">
                                        <div class="input-group-addon">
                                          <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    @error('password')
                                        <small class="help-block form-text text-danger">{{$message}}</small>
                                    @enderror
                                </div>
                                <div class="form-group mb-3">
                                    <label for="email" class="form-control-label mb-2">Ulangi Password<span>*</span></label>
                                    <div class="input-group" id="show_ulangi_password">
                                        <input class="form-control @error('confirmed_password') is-invalid @enderror" " type="password" name="confirmed_password" >
                                        <div class="input-group-addon">
                                          <a href=""><i class="fa fa-eye-slash" aria-hidden="true"></i></a>
                                        </div>
                                    </div>
                                    @error('confirmed_password')
                                        <small class="help-block form-text text-danger">{{$message}}</small>
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
        $("#show_hide_password a").on('click', function(event) {
            event.preventDefault();
            if($('#show_hide_password input').attr("type") == "text"){
                $('#show_hide_password input').attr('type', 'password');
                $('#show_hide_password i').addClass( "fa-eye-slash" );
                $('#show_hide_password i').removeClass( "fa-eye" );
            }else if($('#show_hide_password input').attr("type") == "password"){
                $('#show_hide_password input').attr('type', 'text');
                $('#show_hide_password i').removeClass( "fa-eye-slash" );
                $('#show_hide_password i').addClass( "fa-eye" );
            }
        });
        $("#show_ulangi_password a").on('click', function(event) {
            event.preventDefault();
            if($('#show_ulangi_password input').attr("type") == "text"){
                $('#show_ulangi_password input').attr('type', 'password');
                $('#show_ulangi_password i').addClass( "fa-eye-slash" );
                $('#show_ulangi_password i').removeClass( "fa-eye" );
            }else if($('#show_ulangi_password input').attr("type") == "password"){
                $('#show_ulangi_password input').attr('type', 'text');
                $('#show_ulangi_password i').removeClass( "fa-eye-slash" );
                $('#show_ulangi_password i').addClass( "fa-eye" );
            }
        });
    });
</script>

@endpush
