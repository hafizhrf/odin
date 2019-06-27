@extends('layouts.dashboard')
@section('title')
Cart
@endsection

@section('content')
<div class="container">

@if(\Session::has('success'))
<div class="alert alert-info"><span>{{\Session::get('success')}}</span></div>
@endif

<a href="{{ url('/inventaris') }}" class="btn btn-dark" style="margin-bottom:20px">Kembali</a>
    <div class="card">
        <div class="card-body">
            <h1>Cart</h1>

            <!-- jika cart kosong, maka akan ditampilkan tulisan "tidak ada barang didalam cart" -->
            @if($cart->count() > 0)
            <table class="table table-striped">
                <tr>
                    <th>Barang</th>
                    <th>Kode</th>
                    <th>Nama Inventaris</th>
                    <th>Action </th>
                </tr>

                <!-- foreach untuk menampilkan data cart yang dikirim dari controller -->
               @foreach($cart as $data)
                    <tr>
                        <td><img src="{{asset('img/Barang/'.$data->attributes->image)}}" alt="" style="height:60px; width:60px; align:center;"></td>
                        <td>{{$data->id}}</td>
                        <td>{{$data->name}}</td>
                        <td><form method="post" action="{{route('cart.destroy', $data->id)}}">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="submit" class="btn btn-danger"value="Hapus">
                        </form></td>
                    </tr>
               @endforeach
                <tr>
                    <td colspan="4"> 
                    @guest
                    <a href="" class="btn btn-success" id="lanjutkan" data-toggle="modal"  data-target="#login">Login untuk melanjutkan</a> 
                    @else
                    <a href="" class="btn btn-success"  data-toggle="modal" data-target="#pilihpeminjaman">Buat peminjaman baru</a>
                        <!-- jika user sudah memiliki peminjaman maka tombol tambah ke peminjaman yang yang sudah ada -->
                        @if($pemin->count() > 0)
                        <a href="" class="btn btn-info"  data-toggle="modal" data-target="#konfirmasi">Tambahkan ke peminjaman yang sudah ada</a>
                        @endif
                    @endguest
                    </td>
                </tr>
            </table>   
            @else
            <h1 style="color:lightgrey"><center>Tidak ada data di dalam cart</center></h1> 
            @endif
        </div>
    </div>
</div>
<br><br><br>
<div class="modal fade " id="konfirmasi" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
            <h2 class="modal-title">Pilih Peminjaman yang Ingin ditambahkan</h2>
            </div>
            <div class="modal-body">
            <table class="table">

            <!-- menampilkan seluruh data peminjam -->
                @if(isset($pemin))
                @foreach($pemin as $data)
                        <tr>
                            <td>{{$data->id}}</td>
                            <td>{{$data->kode}}</td>
                            <td>{{$data->tanggal_pinjam}}</td>
                            <td><form action="{{route('peminjaman.store')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="peminjaman" value="{{$data->id}}">
                                    <input type="submit" style="width:100%" value="Pilih" class="btn btn-success">
                                </form>
                            </td>
                        </tr>
                @endforeach
                @endif
                <tr>
                <td></td>
                <td colspan="3"></td>
                </tr>
            </table>
            </div>
        </div>
    </div>
</div>

<div class="modal fade " id="pilihpeminjaman" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="kodemodal">
                    <form action="{{route('peminjaman.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="check" value="1">
                        <input type="submit" style="width:100%" value="Konfirmasi" class="btn btn-info">
                    </form>  </h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table">

                <!-- menampilkan seluruh data cart untul dikonfirmasi -->
                @foreach($cart as $data)
                        <tr>
                            <td><img src="{{asset('img/Barang/'.$data->attributes->image)}}" alt="" style="height:60px; width:60px; align:center;"></td>
                            <td>{{$data->id}}</td>
                            <td>{{$data->name}}</td>
                            <td><form method="post" action="{{route('cart.destroy', $data->id)}}">
                            @csrf
                            <input type="hidden" name="_method" value="DELETE">
                            <input type="submit" class="btn btn-danger"value="Hapus">
                            </form></td>
                        </tr>
                @endforeach
                <tr>
                <td></td>
                <td colspan="3"></td>
                </tr>
            </div>
            </table>
        </div>
    </div>
</div>
@endsection