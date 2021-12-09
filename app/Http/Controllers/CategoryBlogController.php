<?php

namespace App\Http\Controllers;

use App\Models\CategoryBlog;
use Exception;
use Illuminate\Http\Request;

class CategoryBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $param;
    public function index()
    {
        $this->param['data'] = CategoryBlog::all();
        return view('pages.category_blog.index',$this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

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
            'required' => 'Data harus terisi'
        ]);

        try {
            $addData = new CategoryBlog;
            $addData->name_blog = $request->nama_kategori;
            $addData->save();
            return redirect('/category-blog')->withStatus('Berhasil menyimpan data');
        } catch (Exception $e ) {
            return redirect()->back()->withError('Terdapat kesalahan', $e);
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withError('Terdapat kesalahan', $e);
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
        $this->param['data'] = CategoryBlog::findOrFail($id);
        return view('pages.category_blog.edit',$this->param);
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
            'required' => 'Data harus terisi'
        ]);

        try {
            $updateData = CategoryBlog::find($id);
            $updateData->name_blog = $request->nama_kategori;
            $updateData->save();
            return redirect('/category-blog')->withStatus('Berhasil menyimpan data');
        } catch (Exception $e ) {
            return redirect()->back()->withErrors('Terdapat kesalahan', $e);
        }catch(\Illuminate\Database\QueryException $e){
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
            $deleteData = CategoryBlog::find($id);
            $deleteData->delete();
            return redirect('/category-blog')->withStatus('Berhasil menghapus data');
        } catch (Exception $e ) {
            return redirect()->back()->withErrors('Terdapat kesalahan', $e);
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withErrors('Terdapat kesalahan', $e);
        }
    }
}
