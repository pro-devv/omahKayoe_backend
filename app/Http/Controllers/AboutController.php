<?php

namespace App\Http\Controllers;

use App\Models\AboutVillage;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    private $param;
    public function index()
    {
        $this->param['data'] = AboutVillage::all();

        return view('tentang_desa.index');
    }
}
