<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\CategoryBlog;
use Exception;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $param;
    public function index()
    {
        $this->param['data'] = Blog::select('blog.id','blog.category_blog_id','blog.uid','blog.title','blog.desc')
                                ->join('category_blog','category_blog.id', 'blog.category_blog_id')
                                ->join('users', 'users.id', 'blog.uid')
                                ->get();

        return view('pages.blog.index',$this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['data'] = CategoryBlog::all();
        return view('pages.blog.create',$this->param);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|unique:blog,title',
            'kategori' => 'required',
            'desc' => 'required',
            'gambar_banner' => 'required',
        ],[
            'required' => 'Data harus terisi'
        ]);

        try {
            $slug = Str::slug($request->title);
            $addData = new Blog;
            $addData->category_blog_id = $request->kategori;
            $addData->uid = $request->user_id;
            $addData->title = $request->title;
            $addData->slug = $slug;
            $addData->desc = $request->desc;
            // input gambar
            $gambar_blog = $request->file('gambar_blog');
            $filename = date('His').'.'.$request->file('gambar_blog')->extension();

            if ($gambar_blog->move('img/banner/',$filename)) {
                $addData->banner = $filename;
            }
            $addData->save();


        } catch (Exception $e ) {
            return redirect()->back()->withErrors('Terdapat kesalahan', $e);
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withErrors('Terdapat kesalahan', $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
