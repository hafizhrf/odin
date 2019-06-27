@extends('layouts.dashboard')
@section('title')
ODIN
@endsection
@section('home')
<div class="banner" >
<img src="{{asset('img/9282.jpg')}}" alt="" style="width: 100%">
</div>
<div class="homepage-content-top">
    <div class="content">
        <img src="{{asset('img/content.png')}}" alt="" class="content-img">
        <span class="slogan"><b>INVENTARISIR</b> barang <br>dengan mudah dan aman<hr>
        <a href="{{route('inventaris.index')}}" class="btn btn-neutral">LIHAT INVENTARIS</a>
    </span>
    </div>
</div>
<div class="homepage-content-center">
    <img src="{{asset('img/content2.png')}}" alt="" class="content-img2">
</div>
<div class="homepage-content-bottom">
    <span class="slogan2"><b>MEMUDAHKAN</b> anda dalam <br> pencarian barang
</div>
@endsection
