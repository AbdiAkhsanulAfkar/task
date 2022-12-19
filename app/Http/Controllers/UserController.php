<?php

namespace App\Http\Controllers;

use App\Models\dataPengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{

    public function dataUser()
    {
        $user = DB::table('users')->where('role','user')->get();
 
        return view('user.data_user',['user' => $user]);
    }

    public function viewTambahUser()
    {
        return view('user.tambah_user');
    }

    public function tambahDataUser(Request $request)
    {   
        $user = new dataPengguna();
        $user->username = $request->input('username');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->role = $request->input('role');
        $user->save();
        return redirect('/user');
    }

    public function hapusDataUser($id){
        dataPengguna::where('id', $id)->delete();
        return redirect('/user');

    }

    public function editDataUser($id){
        $user = dataPengguna::where('id', $id)->get();
        return view('user.edit_user', ['user' => $user]);

    }

    public function postEditUser(Request $request)
{
	dataPengguna::where('id',$request->id)->update([
		'username' => $request->username,
        'email' => $request->email,
		// 'password' => bcrypt($request->password),
		'role' => $request->role
	]);
	return redirect('/user');
}

}
