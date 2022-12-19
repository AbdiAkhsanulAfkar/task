<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GedungController extends Controller
{

    public function dataGedung()
    {
        $gedung = DB::table('gedung')->get();
 
        return view('gedung.data_gedung',['gedung' => $gedung]);
    }

    public function viewTambahGedung()
    {
        return view('gedung.tambah_gedung');
    }

    public function tambahDataGedung(Request $request)
    {   
        $gedung = new Gedung();
        $gedung->nama_gedung = $request->input('nama_gedung');
        $gedung->lokasi = $request->input('lokasi');
        $gedung->harga = $request->input('harga');
        $gedung->save();
        return redirect('/gedung');
    }

    public function hapusDataGedung($id){
        Gedung::where('id', $id)->delete();
        return redirect('/gedung');

    }

    public function editDataGedung($id){
        $gedung = Gedung::where('id', $id)->get();
        return view('gedung.edit_gedung', ['gedung' => $gedung]);

    }

    public function postEditGedung(Request $request)
{
	Gedung::where('id',$request->id)->update([
		'nama_gedung' => $request->nama_gedung,
        'lokasi' => $request->lokasi,
		'harga' => $request->harga
	]);
	return redirect('/gedung');
}

}
