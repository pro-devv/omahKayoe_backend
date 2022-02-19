<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;

class ListProductController extends Controller
{
    private $param;
    public function index()
    {
        $this->param['data'] = Product::select('product.id','product.category_id','product.uid','product.name_product','product.thumbnail','product.price','product.color','product.desc','users.name','category.name_category')
                    ->join('users','users.id','product.uid')
                    ->join('category', 'category.id','product.category_id')
                    ->orderBy('id'
                    ,'DESC')
                    ->get();


        return view('produk.index', $this->param);
    }

    public function detail($id)
    {
        $this->param['data'] = Product::select('product.id','product.category_id','product.uid','product.name_product','product.thumbnail','product.price','product.color','product.desc','users.name','users.no_hp','category.name_category')
                            ->join('users','users.id','product.uid')
                            ->join('category', 'category.id','product.category_id')
                            ->where('product.id',$id)
                            ->first();

        return view('produk.detail-produk', $this->param);

    }

    public function store(Request $request)
    {
        // return $request;

        $produk = $request->namaProduk;
        $nama = $request->namaPembeli;
        $phone = $request->phone;
        $alamat = $request->alamat;
        $qty = $request->qty_pesan;

        return redirect()->away('https://api.whatsapp.com/send?phone='.$request->no_hp.'.&text='.'Nama%20Produk%20%3A%20'.$produk.'%0A'.'Nama%20%3A%20'.$nama.'%0A'.'No%20Telepon%20%3A%20'.$phone.'%0A'.'Alamat%20%3A%20'.$alamat.'%0A'.'Total%20%3A%20'.$qty);
    }
}
