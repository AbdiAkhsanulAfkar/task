<?php

namespace App\Http\Controllers;

use App\Models\dataPengguna;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class PenyediaController extends Controller
{

    public function dataPenyedia()
    {
        $penyedia = DB::table('users')->where('role','penyedia')->get();
 
    	// mengirim data pegawai ke view index
        return view('penyedia.data_penyedia',['penyedia' => $penyedia]);
    }

    public function viewTambahPenyedia()
    {
        return view('penyedia.tambah_penyedia');
    }

    public function tambahDataPenyedia()
    {   
        $attributes = request()->validate([
            'username' => ['required', 'max:20'],
            'email' => ['required', 'email', 'max:50', Rule::unique('users', 'email')],
            'password' => ['required', 'min:5', 'max:20'],
            'role' => ['required']
        ]);
        $attributes['password'] = bcrypt($attributes['password'] );

        $user = dataPengguna::create($attributes);
        return redirect('/penyedia');
    }
    

    public function hapusDataPenyedia($id){
        dataPengguna::where('id', $id)->delete();
        return redirect('/penyedia');

    }

    public function editDataPenyedia($id){
        $penyedia = dataPengguna::where('id', $id)->get();
        return view('penyedia.edit_penyedia', ['penyedia' => $penyedia]);

    }

    public function postEditPenyedia(Request $request)
{
	dataPengguna::where('id',$request->id)->update([
		'username' => $request->username,
        'email' => $request->email,
		// 'password' => bcrypt($request->password),
		'role' => $request->role
	]);
	return redirect('/penyedia');
}

}
