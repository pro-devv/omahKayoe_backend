<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Blog;
use Exception;
use Illuminate\Http\Request;
use File;

class BannerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $param;
    public function index()
    {
        $this->param['data'] = Banner::all();
        return view('pages.banner.index', $this->param);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.banner.create');
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
            'title' => 'required',
            'desc' => 'required',
            'gambar_banner' => 'required|image|mimes:jpeg,jpg,png'
        ],[
            'required' => 'Data harus terisi',
            'mimes' => 'Gambar harus jpeg,jpg,png'
        ]);
        try {
            $addData = new Banner;
            $addData->title = $request->title;
            $addData->desc = $request->desc;

            // input gambar
            $gambar_banner = $request->file('gambar_banner');
            $filename = date('His').'.'.$request->file('gambar_banner')->extension();

            if ($gambar_banner->move('img/banner/',$filename)) {
                $addData->banner = $filename;
            }
            $addData->save();

            return redirect()->route('banner.index')->withStatus('Berhasil menyimpan data');
        } catch (Exception $e ) {
            return redirect()->back()->withErrors('Terdapat kesalahan', $e);
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withErrors('Terdapat kesalahan', $e);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function show(Banner $banner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->param['data'] = Banner::findOrFail($id);
        return view('pages.banner.edit', $this->param);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // return $request;
        $request->validate([
            'title' => 'required',
            'desc' => 'required',
            'gambar_banner' => 'image|mimes:jpeg,jpg,png'
        ],[
            'required' => 'Data harus terisi',
            'mimes' => 'Gambar harus jpeg,jpg,png'
        ]);

        try {
            $updateData = Banner::find($id);
            $updateData->title = $request->title;
            $updateData->desc = $request->desc;

            // input gambar
            $gambar_banner = $request->file('gambar_banner');
            if (isset($gambar_banner)) {
                $image_path = public_path().'/img/banner/'.$updateData->banner;
                // return $image_path;
                unlink($image_path);
                $filename = date('His').'.'.$request->file('gambar_banner')->extension();
                if ($gambar_banner->move('img/banner/',$filename)) {
                    $updateData->banner = $filename;
                }
            }
            $updateData->save();

            return redirect()->route('banner.index')->withStatus('Berhasil menyimpan data');
        } catch (Exception $e ) {
            return redirect()->back()->withErrors('Terdapat kesalahan', $e);
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withErrors('Terdapat kesalahan', $e);
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Banner  $banner
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            // return $id;
            $deleteBlog = Banner::find($id);
            $image_path = public_path().'/img/banner/'.$deleteBlog->banner;

            if (File::delete($image_path)) {
                $deleteBlog->delete();
            }
            return redirect()->route('banner.index')->withStatus('Berhasil Menghapus Data');

        } catch (Exception $e ) {
            return redirect()->back()->withErrors('Terdapat kesalahan', $e);
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withErrors('Terdapat kesalahan', $e);
        }

    }
}
