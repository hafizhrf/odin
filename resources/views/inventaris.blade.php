@extends('layouts.dashboard')
@section('title')
Inventaris
@endsection
@section('content')



<div class="row">
    <div class="col-6 col-md-3" >
        <div class="card " style="margin-left: 30px; width:22rem;  border-radius:8px">

            <!-- form untuk searching data barang -->
            <span class="sidebar" style="background-color: #3d3d3d; color: white;padding: 8px; border-radius:8px"><center>SEARCH</center></span>
            <div style="padding: 20px 8px 0px 8px">
                <form method="get" action="{{url('search/query')}}">
                    @csrf
                    <div class="form-group">
                        <div class="input-group mb-4">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="ni ni-zoom-split-in"></i></span>
                            </div>
                            <input class="form-control" placeholder="Search" value="{{@$_GET['key']}}" name="key" type="text">
                        </div>
                        <input type="submit" style="display: none">
                    </div>
                </form>
            </div>

            <!-- div untuk memilih kategori barang -->
            <span class="sidebar" style="background-color: #3d3d3d; color: white;padding: 8px; border-radius:10px"><center>CATEGORY</center></span>
            <div style="padding: 8px; color: black">

                <!-- menampilkan data jenis barang -->
                @foreach($jenis as $j)
                <div class="category">
                    <i class="ni ni-bold-right"></i>&nbsp;<a href="{{url('filter',$j->nama_jenis)}}"  >{{$j->nama_jenis}}</a>
                </div>
                @endforeach
                <hr><a href="{{ route('cart.index') }}" style="width:100%" class="btn btn-dark"> <i class="ni ni-cart" style="font-size: 2.2em;"></i></a>
            </div>
            
            
        </div>
    </div>
    <div class="col-13 col-md-9">
        <span>
       
            <div class="card shadow" style="margin: 0 30px 20px 30px; border-radius:10px">

            <!-- alert untuk menampilkan message dari controller -->
            @if(\Session::has('success'))
                <div class="alert alert-success"><span>{{\Session::get('success')}}</span><a href="{{route('cart.index')}}" class="cek">ke dalam cart</a></div>
            @elseif(isset($_GET['key']) && $_GET['key'] !== "")
                <div class="alert alert-default"><span>Search : {{$_GET['key']}}</span></div>
            @endif

                <!-- card untuk menampilkan data inventaris -->
                <div class="card-body" >
                    <div class="row" >
                        @foreach($inv as $data)
                        <div class="col-md-4 col-md auto" style="margin-bottom:20px;">
                            <span>
                                <div class="card" style="width: 17rem; margin:40px 20px 20px; box-shadow: 0 1px 10px 0 #999; border-radius:0px;">
                                    <div class="card-img-top" alt="Card image cap">
                                    <a href="" data-ruang="{{$data->ruang}}" data-image="{{$data->image}}" data-kode="{{$data->kode}}" data-jenis="{{$data->jenis}}" data-ket="{{$data->keterangan}}" data-kondisi="{{$data->kondisi}}" data-id="{{$data->id}}" data-name="{{$data->nama}}" id="details{{$data->id}}" data-toggle="modal" data-target="#detailinv"><img src="{{asset('img/Barang/'.$data->image)}}" alt="" style="max-height: 230px; height:230px; width:100%; align:center;object-fit: cover">
                                    </div></a>
                                        
                                    <div class="card-body">
                                        <span class="card-title"><b>{{$data->nama}} </b></span> <br> <p class="badge badge-md badge-info">{{$data->kondisi}} | {{$data->kode}} | {{$data->ruang}} </p><br><br>
                                        @if($data->kondisi == "Tersedia")
                                        <form method="post" action="{{route('cart.store')}}">
                                            @csrf
                                            <input type="hidden" name="id" id="cartid" value="{{$data->id}}" required>   
                                            <input type="hidden" name="name" id="cartname" value="{{$data->nama}}" required>
                                            <input type="hidden" name="img" id="cartimg" value="{{$data->image}}" required>
                                            <input type="submit" style="width:100%" class="btn btn-dark" value="Masukan ke Keranjang">
                                        </form>
                                         @else
                                        <center><span style="padding:15px" class="badge badge-md badge-danger">Barang tidak tersedia</span></center>
                                        @endif
                                        </div>
                                </div>
                            </span>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </span>
    </div>
</div>



<!-- Modal untuk menampilkan data barang  -->
<div class="modal fade" id="detailinv" tabindex="-1" role="dialog" aria-labelledby="detailinvLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="namabarang"> </h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="alert alert-neutral" role="alert">
                    <strong>DESKRIPSI PRODUK</strong>
                        <div class="alert alert-neutral" role="alert">
                            <strong>Kode</strong><p id="kode"></p>
                            <strong>Keterangan</strong><p id="keterangan"></p>
                            <strong>Kondisi</strong><p id="kondisi"></p>
                            <strong>Jenis</strong><p id="jenis"></p>
                            <strong>Ruang</strong><p id="ruang"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @foreach($inv as $data)
        <script>
        //jquery untuk mengirim data barang ke dalam modal
            $(document).ready(function(){
                $("#details{{$data->id}}").click(function(){
                    var a = $("#details{{$data->id}}").data('name');
                    var b = $("#details{{$data->id}}").data('ket');
                    var c = $("#details{{$data->id}}").data('kondisi');
                    var e = $("#details{{$data->id}}").data('ruang');
                    var f = $("#details{{$data->id}}").data('jenis');
                    var g = $("#details{{$data->id}}").data('kode');
                    var g = $("#details{{$data->id}}").data('image');
                    $("#namabarang").text(a);
                    $("#keterangan").text(b);
                    $("#kondisi").text(c);
                    $("#jenis").text(f);
                    $("#ruang").text(e);
                    $("#kode").text(g);
                });
                $("#lanjutkan").click(function(){
                    $("#modaltitle").text("Login terlebih dahulu !");
                });
            });
        </script>
        @endforeach
@endsection