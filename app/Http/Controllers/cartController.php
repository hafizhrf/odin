<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use App\peminjaman;
use App\peminjam;
use Auth;
class cartController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cart = Cart::getContent(); //Mengambil seluruh data yang ada di session cart
        if(isset(Auth::user()->id)){
            $user = peminjam::all()->where('user_id',Auth::user()->id); //mengambil seluruh data di tabel peminjam sesuai user yang login
            foreach($user as $users){
                $pemin = peminjaman::get()->where('peminjam_id',$users['id'])->where('status_peminjaman','Belum Dikonfirmasi'); //mengambil data peminjaman sesuai user yang login dan status yang belum dikonfirmasi
                return view('cart.index', compact('cart','pemin')); //redirect ke halaman cart dengan data yang tadi di ambil
            }
        }
        else{
            return view('cart.index', compact('cart')); //redirect ke halaman cart dengan data yang tadi di ambil
        }
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
        //memvalidasi data yang dikirim lewat form
        $this->validate($request,[
            'id' => 'required',
            'name' => 'required',
            'img' => 'required'
        ]);

        //menambahkan data ke dalam cart session
        Cart::add(array(
            'id' => $request['id'],
            'name' => $request['name'],
            'price' => 0,
            'quantity' => 4,
            'attributes' => array('image' => $request['img'])
        ));

        //redirect ke halaman inventaris dengan pesan sukses
        return redirect('/inventaris')->with('success','1 Barang ditambahkan ');
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
        //menghapus cart dengan id yang dikirim lewat form
        Cart::remove($id);

        //redirect ke halaman cart
        return redirect('/cart')->with('success','Berhasil menghapus barang');
    }
}
