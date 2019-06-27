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
use Illuminate\Support\Facades\Input;
class peminjamanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //mengambil seluruh data peminjam berdasarkan user yang login
        $user = peminjam::all()->where('user_id',Auth::user()->id);

        foreach($user as $users){
            //mengambil function total untuk mengecek total peminjaman yang dilakukan user
            $total = DB::select('select total(?) as data',array($users['id']));

            //mengambil data peminjaman sesua status peminjaman
            $dbdk = peminjaman::all()->where('status_peminjaman','Belum Dikonfirmasi')->where('peminjam_id',$users['id']);
            $dsb = peminjaman::all()->where('status_peminjaman','Sedang Berjalan')->where('peminjam_id',$users['id']);
            $ds = peminjaman::all()->where('status_peminjaman','Selesai')->where('peminjam_id',$users['id']);
            
            //redirect ke halaman riwayat beserta data tadi
            return view('riwayat', compact('total','dbdk','dsb','ds'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
    }

    public function detail($id)
    {   
            
            //mengambil data peminjaman yang idnnya dipilih
            $peminjaman = vpeminjamans::get()->where('id',$id);
            foreach($peminjaman as $det){
                
                //mengambil semua data detail peminjaman sesuai peminjaman yang dipilih
                $detail = vdetails::all()->where('peminjaman_id',$det['id']);

                //mengecek apakah peminjaman yang dipilih itu milik user yang sudah belum login atau bukan
                $user = peminjam::get()->where('user_id',Auth::user()->id);
                foreach($user as $users){
                    if($det['peminjam_id'] == $users['id']){
                        return view('detail_p', compact('detail','peminjaman'));
                    }
                    else{
                        return redirect('/riwayat');
                    }
                }
                
            }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //menjalankan sql untuk melakukan transaksi (TCL)
        DB::BeginTransaction();
        try{
            $m = "";

            //menganbil semua data peminjam berdasarkan user yang login
            $user = peminjam::all()->where('user_id',Auth::user()->id);

            
            foreach($user as $users){
                //mengambil seluruh data peminjaman yang id peminjamnya sesuai yang login dan statusnya belum dikonfirmasi
                $check = peminjaman::get()->where('peminjam_id',$users['id'])->where('status_peminjaman','Belum Dikonfirmasi');

                //mengambil seluruh data yang ada di session cart
                $cart = Cart::getContent();

                //jika user yang login belum memiliki peminjaman, maka:
                if(count($check) == 0 || Input::post('check') == 1){

                    //akan dibuatkan peminjaman baru
                    $data = peminjaman::create([
                        'kode' => uniqid(),
                        'peminjam_id' => $users['id'],
                        'tanggal_pinjam' =>  date('Y-m-d'),
                        'status_peminjaman' => "Belum Dikonfirmasi"
                    ]);
                    
                    //perulangan untuk menginput data ke tabel peminjaman berdasarkan barang yang ada di cart sesuai peminjaman yang baru saja dibuat
                    foreach($cart as $detail){
                        det_peminjaman::create([
                            'peminjaman_id' => $data->id,
                            'inventaris_id' => $detail['id']
                        ]);
                        //menghapus data yang ada di session cart
                        Cart::remove($detail['id']);
                    }
                }

                //jika user ingin menambahkan barang baru, maka:
                else{
                    $this->validate($request,[
                        'peminjaman' => 'required',
                    ]);
                        //perulangan untuk menginput data ke tabel peminjaman berdasarkan barang yang ada di cart sesuai peminjaman yang ingin ditambahkan
                        foreach($cart as $detail){
                            $checkinv = DB::select('select * from detail_peminjamans where peminjaman_id = ? and inventaris_id=?',array($request['peminjaman'],$detail['id']));
                            if(count($checkinv) < 1){
                                det_peminjaman::create([
                                    'peminjaman_id' => $request['peminjaman'],
                                    'inventaris_id' => $detail['id']
                                ]);
                                Cart::remove($detail['id']);
                            }
                            else{
                                Cart::remove($detail['id']);
                            }
                        }
                    $m = " + barang baru ditambahkan";
                }
            }

            //sql untuk menjalankan perintah commit (klarifikasi bahwa prosedur diatas itu sudah fix)
            DB::commit();

            //redirect ke halaman riwayat
            return redirect('/riwayat')->with('success','Peminjaman berhasil dibuat'.$m);
        }
        catch(\exception $e){

            //sql untuk menjalankan perintah rollback(mengembalikan database seperti sebelum dimulainya transaksi di line ke 84) jika prosedur diatas gagal dijalankan
            DB::rollback();
            return redirect('/riwayat')->with('success','Gagal membuat peminjaman');
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
        //menghapus data peminjaman sesuai id yang dipilih
        peminjaman::destroy($id);
        return redirect('/riwayat')->with('success','Peminjaman berhasil di batalkan');
    }
}
