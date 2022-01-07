<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;
use App\Models\Transaksi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    private $param;
    public function index()
    {
        $this->param['transaksi']  = Transaksi::count();
        if (auth()->user()->hasRole('admin')) {
            $this->param['product']  = Product::where('uid',Auth::user()->id)->count();
        }else{
            $this->param['product']  = Product::count();
        }
        if (auth()->user()->hasRole('admin')) {
            $this->param['blog']  = Blog::where('uid',Auth::user()->id)->count();
        }else{
            $this->param['blog']  = Blog::count();
        }
        $this->param['admin'] = User::role('admin')->count();
        return view('dashboard',$this->param);
    }

}
