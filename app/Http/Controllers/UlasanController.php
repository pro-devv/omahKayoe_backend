<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use Illuminate\Http\Request;

class UlasanController extends Controller
{
    private $param;
    public function index()
    {
        $this->param['data'] = Rating::select('rating.rating','rating.product_id','rating.desc_rating','product.name_product')
                                       ->join('product','product.id','rating.product_id')
                                       ->get();
        return view('pages.ulasan.index',$this->param);
    }
}
