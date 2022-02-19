<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = User::all();
        return view('pages.users.index',compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.users.create');
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
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required'],
        ]);

        try {
            $user = User::create([
                'name' => $request->nama,
                'email' => $request->email,
                'no_hp' => $request->no_hp,
                'gender' => $request->gender,
                'address' => $request->address,
                'password' => Hash::make($request->password),
            ]);
            $user->assignRole('user');
            return redirect()->route('user.index')->withStatus('Berhasil menambahkan data.');
        } catch (Exception $e ) {
            return redirect()->back()->withErrors('Terdapat kesalahan.');
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withErrors('Terdapat kesalahan.');
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
        $data = User::find($id);
        return view('pages.users.edit', compact('data'));
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
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);


        try {
            $user  = User::find($id);
            $user->name = $request->nama;
            $user->email = $request->email;
            $user->no_hp = $request->no_hp;
            $user->gender = $request->gender;
            $user->address = $request->address;
            $user->save();
            // $user->assignRole('admin');
            return redirect()->route('user.index')->withStatus('Berhasil mengedit data.');
        } catch (Exception $e ) {
            return redirect()->back()->withErrors('Terdapat kesalahan.');
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withErrors('Terdapat kesalahan.');
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
            $deleteData = User::find($id);
            $deleteData->delete();
            return redirect()->route('user.index')->withStatus('Berhasil menghapus data.');
        } catch (Exception $e ) {
            return redirect()->back()->withErrors('Terdapat kesalahan.');
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withErrors('Terdapat kesalahan.');
        }
    }
}
