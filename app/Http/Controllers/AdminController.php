<?php

namespace App\Http\Controllers;

use App\Models\dataPengguna;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{

    public function dataAdmin()
    {
        $admin = DB::table('users')->where('role','admin')->get();
 
    	// mengirim data pegawai ke view index
        return view('admin.data_admin',['admin' => $admin]);
    }

    public function viewTambahAdmin()
    {
        return view('admin.tambah_admin');
    }

    public function tambahDataAdmin(Request $request)
    {   
        $admin = new dataPengguna();
        $admin->username = $request->input('username');
        $admin->email = $request->input('email');
        $admin->password = bcrypt($request->input('password'));
        $admin->role = $request->input('role');
        $admin->save();
        return redirect('/admin');
    }

    public function hapusDataAdmin($id){
        dataPengguna::where('id', $id)->delete();
        return redirect('/admin');

    }

    public function editDataAdmin($id){
        $admin = dataPengguna::where('id', $id)->get();
        return view('admin.edit_admin', ['admin' => $admin]);

    }

    public function postEditAdmin(Request $request)
{
	dataPengguna::where('id',$request->id)->update([
		'username' => $request->username,
        'email' => $request->email,
		// 'password' => bcrypt($request->password),
		'role' => $request->role
	]);
	return redirect('/admin');
}

}
