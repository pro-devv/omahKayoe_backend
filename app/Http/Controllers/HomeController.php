<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $dataBanner = Banner::select('banner.*')->orderBy('id','DESC')->get();
        $dataProduk = Product::select('product.id','product.category_id','product.uid','product.name_product','product.thumbnail','product.price','product.color','product.desc','users.name','category.name_category')
                    ->join('users','users.id','product.uid')
                    ->join('category', 'category.id','product.category_id')
                    ->orderBy('id'
                    ,'DESC')
                    ->limit(4)
                    ->get();
        $dataKategori = Category::select('id','name_category')->get();

        $data = array(
            'dataBanner' => $dataBanner,
            'dataProduk' => $dataProduk,
            'dataKategori' => $dataKategori,
        );
// return $data;
        return view('welcome', $data);
    }
}
