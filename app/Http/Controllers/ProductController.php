<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Filesystem\Filesystem;
use File;
class ProductController extends Controller
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
           $this->param['data'] = Product::select('product.id','product.category_id','product.uid','product.name_product','product.thumbnail','product.price','product.color','product.desc','users.name','category.name_category')
                                ->join('users','users.id','product.uid')
                                ->join('category', 'category.id','product.category_id')
                                ->where('uid',Auth::user()->id)
                                ->get();
        }else{
            $this->param['data']  = Product::select('product.id','product.category_id','product.uid','product.name_product','product.thumbnail','product.price','product.color','product.desc','users.name','category.name_category')
                                    ->join('users','users.id','product.uid')
                                    ->join('category', 'category.id','product.category_id')
                                    ->get();
        }
        return view('pages.product.index', $this->param);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->param['data'] = Category::all();
        return view('pages.product.create',$this->param);
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
            'nama_produk' => 'required|string',
            'price' => 'required',
            'color' => 'required',
            'desc' => 'required',
            'gambar_produk' => 'required|image|mimes:jpeg,jpg,png'
        ],[
            'required' => 'Data harus terisi'
        ]);
        try {
            $addData = new Product;
            $addData->category_id = $request->kategori;
            $addData->uid = $request->user_id;
            $addData->name_product = $request->nama_produk;
            $addData->price = $request->price;
            $addData->color = $request->color;
            $addData->desc = $request->desc;
            $addData->thumbnail =  $request->file('gambar_produk');
            $addData->save();
            $last_id =  $addData->id;
            if($request->file('gambar_produk') != null) {
                $folder = 'img/product/'.$last_id;
                $file = $request->file('gambar_produk');
                $filename = date('His').'.'.$request->file('gambar_produk')->extension();
                    // Get canonicalized absolute pathname
                    // return $folder;
                    $path = realpath($folder);

                    // If it exist, check if it's a directory
                    if(!($path !== true AND is_dir($path)))
                    {
                        // Path/folder does not exist then create a new folder
                        mkdir($folder, 0755, true);
                    }
                    if($file->move($folder, $filename)) {
                        $upFile = Product::find($last_id);
                        $upFile->thumbnail = $folder.'/'.$filename;
                        $upFile->save();
                    }
            }
            return redirect()->route('product.index')->withStatus('Berhasil menyimpan data');
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
        $this->param['data'] = Product::findOrFail($id);
        $this->param['kategori'] = Category::all();
        return view('pages.product.edit',$this->param);
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
        // return $request;
        $request->validate([
            'nama_produk' => 'required|string',
            'price' => 'required',
            'color' => 'required',
            'desc' => 'required',
        ],[
            'required' => 'Data harus terisi'
        ]);

        try {
            $updateData = Product::find($id);
            $updateData->category_id = $request->kategori;
            $updateData->uid = $request->user_id;
            $updateData->name_product = $request->nama_produk;
            $updateData->price = $request->price;
            $updateData->color = $request->color;
            $updateData->desc = $request->desc;
            // $updateData->thumbnail =  $request->file('gambar_produk');
            $updateData->save();
            $last_id =  $updateData->id;
            // return $last_id;
            if($request->file('gambar_produk') != null) {
                $image_path = public_path().'/'.$updateData->thumbnail;
                // return $image_path;
                unlink($image_path);

                $folder = 'img/product/'.$last_id;
                $file = $request->file('gambar_produk');
                $filename = date('His').'.'.$request->file('gambar_produk')->extension();
                    // Get canonicalized absolute pathname
                    // return $folder;
                    $path = realpath($folder);

                    // If it exist, check if it's a directory
                    if(!($path !== true AND is_dir($path)))
                    {
                        // Path/folder does not exist then create a new folder
                        mkdir($folder, 0755, true);
                    }
                    if($file->move($folder, $filename)) {
                        $upFile = Product::find($last_id);
                        $upFile->thumbnail = $folder.'/'.$filename;
                        $upFile->save();
                    }
            }
            return redirect()->route('product.index')->withStatus('Berhasil menyimpan data');

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
            $deleteData  = Product::find($id);
            if (File::deleteDirectory(public_path('/img/product/'.$deleteData->id))) {
                $deleteData->delete();
            }
            return redirect('/product')->withStatus('Berhasil Menghapus Data');

            // $image_path = public_path().'/img/banner/'.$deleteBlog->banner;
        } catch (Exception $e ) {
            return redirect()->back()->withErrors('Terdapat kesalahan', $e);
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withErrors('Terdapat kesalahan', $e);
        }


    }
}
