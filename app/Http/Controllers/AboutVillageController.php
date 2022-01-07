<?php

namespace App\Http\Controllers;

use App\Models\AboutVillage;
use Exception;
use Illuminate\Http\Request;

class AboutVillageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = AboutVillage::all();
        return view('pages.tentang-desa.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.tentang-desa.create');
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
            'desc' => 'required',
            'thumbnail' => 'image|mimes:jpeg,jpg,png'
        ],[
            'required' => 'Data harus terisi',
            'mimes' => 'Gambar harus jpeg,jpg,png'
        ]);
        try {
            $addData = new AboutVillage;
            $addData->title = $request->title;
            $addData->desc = $request->desc;

            // input gambar
            $thumbnail = $request->file('thumbnail');
            $filename = date('His').'.'.$request->file('thumbnail')->extension();

            if ($thumbnail->move('img/tentang-desa/',$filename)) {
                $addData->thumbnail = $filename;
            }
            $addData->save();

            return redirect()->route('about.index')->withStatus('Berhasil menyimpan data');
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
