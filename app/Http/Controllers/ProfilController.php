<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfilController extends Controller
{
    public function EditProfil($id)
    {
        $data = User::find($id);
        return view('pages.profil.edit',compact('data'));
    }
    public function EditProfilInsert(Request $request)
    {
        $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);
        try {
            $user  = User::find(Auth::user()->id);
            $user->name = $request->nama;
            $user->email = $request->email;
            $user->no_hp = $request->no_hp;
            $user->gender = $request->gender;
            $user->address = $request->address;
            $user->save();
            // $user->assignRole('admin');
            return redirect()->back()->withStatus('Berhasil mengedit data.');
        } catch (Exception $e ) {
            return $e;
            return redirect()->back()->withError('Terdapat kesalahan.');
        }catch(\Illuminate\Database\QueryException $e){
            return $e;
            return redirect()->back()->withError('Terdapat kesalahan.');
        }
    }
    public function LupaPassword(Request $request)
    {
        // return $request;
        $request->validate([
            'password' => 'min:8|required',
            'confirmed_password' => 'min:8|same:password',
        ],[
            'same' => 'Password tidak sama'
        ]);
        try {
            $UbahPassword = User::find(Auth::user()->id);
            $UbahPassword->password = Hash::make($request->confirmed_password);
            $UbahPassword->save();
            return redirect()->back()->withStatus('Berhasil mengganti password.');
        } catch (Exception $e ) {
            return redirect()->back()->withErrors('Terdapat kesalahan.');
        }catch(\Illuminate\Database\QueryException $e){
            return redirect()->back()->withErrors('Terdapat kesalahan.');
        }

    }
}
