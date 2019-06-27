@extends('layouts.dashboard')
@section('title')
Profile
@endsection

@section('content')
<style>
body{
    overflow: hidden;
}
</style>
<div class="container">
    <div class="card">
        <div class="card-body">

        <!-- menampilkan profil user -->
            @foreach($prof as $profile)
                        <strong>Nama</strong><pre>{{$profile->nama}}</pre>
                        <strong>No Induk</strong><pre>{{$profile->no_induk}}</pre>
                        <strong>Alamat</strong><pre>{{$profile->alamat}}</pre>
                        <strong>No Telepon</strong><pre>{{$profile->telepon}}</pre>
                        <strong>Jabatan</strong><pre>{{$profile->jabatan}}</pre>  
                    @endforeach <br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
    </div>
</div>

@endsection