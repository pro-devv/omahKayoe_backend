<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class ListBlogController extends Controller
{
    private $param;
    public function index()
    {
        $this->param['data'] = Blog::all();

        return view('blog.index');
    }
}
