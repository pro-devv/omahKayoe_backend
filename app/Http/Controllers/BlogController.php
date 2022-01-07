<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\CategoryBlog;
use Exception;
use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\Auth;

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
        if (auth()->user()->hasRole('admin')) {
            $this->param['data'] = Blog::select('blog.id','blog.category_blog_id','blog.uid','blog.title','blog.desc','blog.thumbnail','category_blog.name_blog','users.name')
                                    ->join('category_blog','category_blog.id', 'blog.category_blog_id')
                                    ->join('users', 'users.id', 'blog.uid')
                                    ->where('uid',Auth::user()->id)
                                    ->get();
        }
        else
        {
            $this->param['data'] = Blog::select('blog.id','blog.category_blog_id','blog.uid','blog.title','blog.desc','blog.thumbnail','category_blog.name_blog','users.name')
                ->join('category_blog','category_blog.id', 'blog.category_blog_id')
                ->join('users', 'users.id', 'blog.uid')
                ->get();
        }

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
        // return $request;
        $request->validate([
            'title' => 'required',
            'kategori' => 'required',
            'desc' => 'required',
            'gambar_blog' => 'required',
        ],[
            'required' => 'Data harus terisi'
        ]);

        try {
            $slug = \Str::slug($request->title);
            $addData = new Blog;
            $addData->category_blog_id = $request->kategori;
            $addData->uid = $request->user_id;
            $addData->title = $request->title;
            $addData->slug = $slug;
            $addData->desc = $request->desc;
            // input gambar
            $gambar_blog = $request->file('gambar_blog');
            $filename = date('His').'.'.$request->file('gambar_blog')->extension();

            if ($gambar_blog->move('img/blog/',$filename)) {
                $addData->thumbnail = $filename;
            }
            $addData->save();

            return redirect()->route('blog.index')->withStatus('Berhasil menambahkan data.');
        } catch (Exception $e ) {
            return 'a';
            return redirect()->back()->withErrors('Terdapat kesalahan', $e);
        }catch(\Illuminate\Database\QueryException $e){
            return 'b';
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
        $data = Blog::find($id);
        $kategori = CategoryBlog::all();
        return view('pages.blog.edit',compact('data','kategori'));
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
        $request->validate([
            'title' => 'required|unique:blog,title',
            'kategori' => 'required',
            'desc' => 'required',
            'gambar_blog' => 'required',
        ],[
            'required' => 'Data harus terisi'
        ]);

        try {
            $slug = \Str::slug($request->title);
            $updateData = Blog::find($id);
            $updateData->category_blog_id = $request->kategori;
            $updateData->uid = $request->user_id;
            $updateData->title = $request->title;
            $updateData->slug = $slug;
            $updateData->desc = $request->desc;
            // input gambar
            $gambar_blog = $request->file('gambar_blog');
            $filename = date('His').'.'.$request->file('gambar_blog')->extension();
            if (isset($gambar_blog)) {
                $image_path = public_path().'/img/blog/'.$updateData->thumbnail;
                // return $image_path;
                unlink($image_path);

                if ($gambar_blog->move('img/blog/',$filename)) {
                    $updateData->thumbnail = $filename;
                }
            }
            $updateData->save();

            return redirect()->route('blog.index')->withStatus('Berhasil menambahkan data.');
        } catch (Exception $e ) {
            return 'a';
            return redirect()->back()->withErrors('Terdapat kesalahan', $e);
        }catch(\Illuminate\Database\QueryException $e){
            return 'b';
            return redirect()->back()->withErrors('Terdapat kesalahan', $e);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $deleteData = Blog::find($id);
            $image_path = public_path().'/img/blog/'.$deleteData->thumbnail;
            if (File::delete($image_path)) {
                $deleteData->delete();
            }
            return redirect()->route('blog.index')->withStatus('Berhasil Menghapus Data');


        } catch (Exception $e ) {
            return redirect()->back()->withError('Terdapat kesalahan');
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError('Terdapat kesalahan');
        }
    }
}
