<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\inventaris;
use App\vinventaris;
use App\jenis;
use App\peminjam;
use DB;
use App\User;
use Auth;
use Illuminate\Support\Facades\Input;

class inventarisController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public $restful = true;  
    public function index()
    {
        // mengambil semua data yang ada di view 'vinventaris'
        $inv = vinventaris::all();

        // Mengambil data dari tabel jenis
        $jenis = jenis::all();

        // meredirect ke halaman inventaris berisi data dari variabel inv dan jenis
        return view('inventaris' , compact('inv','jenis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        //mengambil inputan dari keyboard yang dikirim
        $q = "%".Input::get('key')."%";

        //memanggil stored procedure untuk mencari barang
        $inv = DB::select('call search_procedure(?)',array($q));

        //mengambil seluruh data jenis untuk memfilter data
        $jenis = jenis::all();

        //jika user tidak memasukan data di kolom search ia akan langsung redirect ke halaman inventaris
        if($q == ""){
            return redirect('/inventaris');
        }else {
            return view('inventaris', compact('inv','jenis'));
        }
    }

    public function filter($filter){

        //mengambil seluruh data inventaris berdasarkan jenis yang dipilih
        $inv = vinventaris::all()->where('jenis',$filter);

        //mengambil seluruh data jenis
        $jenis = jenis::all();

        // meredirect ke halaman inventaris berisi data dari variabel inv dan jenis
        return view('inventaris' , compact('inv','jenis'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $id)
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


