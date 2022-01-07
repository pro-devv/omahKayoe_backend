<?php

namespace App\Http\Controllers;

use App\Models\CategoryBlog;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

class CategoryBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = CategoryBlog::all();
        return view('pages.category-blog.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'nama_kategori' => 'required',
        ],[
            'required' => 'data harus terisi.'
        ]);
        try {
            $addData = new CategoryBlog;
            $addData->name_blog = $request->get('nama_kategori');
            $addData->save();
            return redirect()->route('category-blog.index')->withStatus('Berhasil menambahkan data.');
        } catch (Exception $e) {
            return redirect()->back()->withError('Terdapat Kesalahan.');
        }catch(QueryException $e){
            return redirect()->back()->withError('Terdapat Kesalahan.');
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
        $data = CategoryBlog::find($id);
        return view('pages.category-blog.edit',compact('data'));
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
           'nama_kategori' => 'required',

       ],[
           'required' => 'Data harus terisi.'
       ]);
       try {
            $updateData = CategoryBlog::find($id);
            $updateData->name_blog = $request->get('nama_kategori');
            $updateData->save();
            return redirect()->route('category-blog.index')->withStatus('Berhasil Mengedit data');
       } catch (Exception $e) {
           return redirect()->back()->withError('Terdapat kesalahan.');
       }catch(QueryException $e){
            return redirect()->back()->withError('Terdapat kesalahan.');
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
            $hapusData = CategoryBlog::find($id);
            $hapusData->delete();
            return redirect()->route('category-blog.index')->withStatus('Berhasil menghapus data');
        } catch (Exception $e) {
            return redirect()->back()->withError('Terdapat kesalahan.');
        }catch(QueryException $e){
            return redirect()->back()->withError('Terdapat kesalahan.');
        }
    }
}
