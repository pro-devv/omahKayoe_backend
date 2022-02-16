<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class ListProductController extends Controller
{
    private $param;
    public function index()
    {
        $this->param['data'] = Category::all();

        return view('produk.index');
    }
}
