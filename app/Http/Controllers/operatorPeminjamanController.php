<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\peminjaman;
use App\det_peminjaman;
use App\peminjam;
use App\vdetails;
use App\vpeminjamans;
use Cart;
use DB;
use Auth;

class operatorPeminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = vpeminjamans::all();
        $phariini = DB::select('SELECT count(*) as total FROM vpeminjaman WHERE tanggal_pinjam = current_date() AND status_peminjaman = ?',array('Sedang Berjalan'));
        $pghariini = DB::select('SELECT count(*) as total FROM vpeminjaman WHERE tanggal_kembali = current_date()');
        $ptotal = DB::select('SELECT count(*) as total FROM vpeminjaman');
        return view('operator.index', compact('data','phariini','ptotal','pghariini'));
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        return url('/');
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
