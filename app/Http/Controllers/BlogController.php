<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\CategoryBlog;
use Exception;
use Illuminate\Http\Request;
use File;

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
        $this->param['data'] = Blog::select('blog.id','blog.category_blog_id','blog.uid','blog.title','blog.desc','blog.thumbnail', 'category_blog.name_blog','users.name')
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
            // return $slug;
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

            return redirect('/blog')->withStatus('Berhasil menyimpan data');

        } catch (Exception $e ) {
            return redirect('/blog')->withError('Terdapat kesalahan', $e);
        }catch(\Illuminate\Database\QueryException $e){
            return redirect('/blog')->withError('Terdapat kesalahan', $e);
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
        $this->param['data'] = Blog::find($id);
        $this->param['data_kategori'] = CategoryBlog::all();
        return view('pages.blog.edit',$this->param);
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
            'title' => 'required',
            'kategori' => 'required',
            'desc' => 'required',
            'gambar_blog' => 'required',
        ],[
            'required' => 'Data harus terisi'
        ]);

        try {
            $slug = \Str::slug($request->title);
            // return $slug;
            $updateData = Blog::find($id);
            $updateData->category_blog_id = $request->kategori;
            $updateData->uid = $request->user_id;
            $updateData->title = $request->title;
            $updateData->slug = $slug;
            $updateData->desc = $request->desc;
            if ($request->file('gambar_blog') != null) {
                $image_path = public_path().'/img/blog/'.$updateData->thumbnail;
                // return $image_path;
                unlink($image_path);
                // input gambar
                $gambar_blog = $request->file('gambar_blog');
                $filename = date('His').'.'.$request->file('gambar_blog')->extension();

                if ($gambar_blog->move('img/blog/',$filename)) {
                    $updateData->thumbnail = $filename;
                }
            }
            $updateData->save();

            return redirect('/blog')->withStatus('Berhasil mengganti data');

        } catch (Exception $e ) {
            return redirect('/blog')->withError('Terdapat kesalahan', $e);
        }catch(\Illuminate\Database\QueryException $e){
            return redirect('/blog')->withError('Terdapat kesalahan', $e);
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
            // return $id;
            $deleteBlog = Blog::find($id);
            $image_path = public_path().'/img/blog/'.$deleteBlog->thumbnail;

            if (File::delete($image_path)) {
                $deleteBlog->delete();
            }
            return redirect('/blog')->withStatus('Berhasil Menghapus Data');

        } catch (Exception $e ) {
            return redirect()->back()->withErrors('Terdapat kesalahan', $e);
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withErrors('Terdapat kesalahan', $e);
        }
    }
}
