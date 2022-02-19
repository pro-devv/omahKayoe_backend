@extends('layouts.template-front')
@section('content')
    <!-- breadcrumb start-->
    <section class="breadcrumb breadcrumb_bg">
        <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
            <div class="breadcrumb_iner">
                <div class="breadcrumb_iner_item">
                <h2>Detail Produk</h2>
                <p>Produk <span>-</span> Detail Produk</p>
                </div>
            </div>
            </div>
        </div>
        </div>
    </section>
    <!-- breadcrumb start-->

    <!--================Single Product Area =================-->
    <form method="post" action="{{ route('store-produk-detail') }}">
        @csrf
        <input type="hidden" name="produk" value="{{ $data->name_product }}">
        <input type="hidden" name="foto" value="{{ $data->thumbnail }}">
        <input type="hidden" name="kategori" value="{{ $data->name_category }}">
        <input type="hidden" name="harga" id="harga" value="{{ $data->price }}">
        <input type="hidden" name="no_hp" value="{{ $data->no_hp }}">
        <div class="product_image_area section_padding">
            <div class="container">
                <div class="row s_product_inner justify-content-between">
                    <div class="col-lg-7 col-xl-7">
                        <div class="product_slider_img">
                            <div id="vertical">
                                <img src="{{ asset($data->thumbnail) }}" alt="{{ $data->name_product }}"/>
                                {{-- <div data-thumb="img/product/single-product/product_1.png">
                                    <img src="img/product/single-product/product_1.png" />
                                </div>
                                <div data-thumb="img/product/single-product/product_1.png">
                                    <img src="img/product/single-product/product_1.png" />
                                </div>
                                <div data-thumb="img/product/single-product/product_1.png">
                                    <img src="img/product/single-product/product_1.png" />
                                </div> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-5 col-xl-4">
                        <div class="s_product_text">
                            <h3>{{ $data->name_product }}</h3>
                            <h2>{{ $data->price }}</h2>
                            <p><span>Category</span> : {{ $data->name_category }}</p>
                            <p>
                                Cek deskripsi produk terlebih dahulu untuk membeli produk, agar barang datang anda puas dengan hasilnya.
                            </p>
                            <div class="card_area d-flex justify-content-between align-items-center">
                                <div class="product_count">
                                    <span class="inumber-decrement"> <i class="ti-minus"></i></span>
                                    <input class="input-number" type="text" id="qty" name="qty" value="1" min="0" max="10">
                                    <span class="number-increment"> <i class="ti-plus"></i></span>
                                </div>
                                <button type="button" class="btn_3" onclick="openModal()">pesan</button>
                                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                      <div class="modal-content">
                                        <div class="modal-header">
                                          <h5 class="modal-title" id="exampleModalLabel">Lengkapi Data Pesanan</h5>
                                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                          </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Nama Produk :</label>
                                                <input type="text" class="form-control" name="namaProduk" id="re cipient-name">
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">Nama Pembeli :</label>
                                                <input type="text" class="form-control" name="namaPembeli" id="re cipient-name">
                                            </div>
                                            <div class="form-group">
                                                <label for="recipient-name" class="col-form-label">No. Telepon :</label>
                                                <input type="text" class="form-control" name="phone" id="recipient-name">
                                            </div>
                                            <div class="form-group">
                                            <label for="message-text" class="col-form-label">Alamat Lengkap:</label>
                                                <textarea class="form-control" name="alamat" id="message-text"></textarea>
                                            </div>
                                            <div class="form-group">
                                            <label for="message-text" class="col-form-label">Total:</label>
                                                <textarea class="form-control" id="qty_pesan" name="qty_pesan" readonly></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                          <button type="submit" class="btn btn-primary" style="background-color: green">Pesan Produk</button>
                                        </div>
                                      </div>
                                    </div>
                                  </div>
                                  <Script>
                                      $('#exampleModal').on('show.bs.modal', function (event) {
                                    var button = $(event.relatedTarget) // Button that triggered the modal
                                    var recipient = button.data('whatever') // Extract info from data-* attributes
                                    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                                    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                                    var modal = $(this)
                                    modal.find('.modal-title').text('New message to ' + recipient)
                                    modal.find('.modal-body input').val(recipient)
                                  })
                                  </Script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!--================End Single Product Area =================-->

    <section class="sample-text-area">
		<div class="container box_1170">
			<h3 class="text-heading">Deskripsi</h3>
			<p class="sample-text">
				{{ $data->desc }}
			</p>
		</div>
	</section>


@endsection

@section('js')
    <script>
        function openModal() {
            $('#exampleModal').modal('show');
            var qty = $('#qty').val();
            var harga = $('#harga').val();
            var total = harga * qty;
            $('#qty_pesan').val(total);
        }
    </script>
