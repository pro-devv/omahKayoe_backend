<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
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
        $this->param['data'] = Product::select('product.id','product.category_id','product.uid','product.name_product','product.thumbnail','product.price','product.color','product.desc','users.name','category.name_category')
                            ->join('users','users.id','product.uid')
                            ->join('category', 'category.id','product.category_id')
                            ->where('product.id',$id)
                            ->first();

        return view('produk.detail-produk', $this->param);

    }
}
