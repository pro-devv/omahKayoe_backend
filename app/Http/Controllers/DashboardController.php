<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    private $param;
    public function index()
    {
        $this->param['transaksi']  = Transaksi::count();
        $this->param['product']  = Product::count();
        $this->param['blog']  = Blog::count();
        $this->param['admin'] = User::role('admin')->count();
        return view('dashboard',$this->param);
    }
}
