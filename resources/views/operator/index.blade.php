@extends('layouts.dashboard')

@section('title')
Riwayat Peminjaman
@endsection

@section('content')
<div class="container data">
    @if(\Session::has('success'))
        <div class="alert alert-success"><span>{{\Session::get('success')}}</span></div>
    @endif
    <div class="card">
        <div class="card-body">
        Total Peminjaman <span class="badge badge-success">@foreach($ptotal as $t) {{$t->total}}  @endforeach</span><br>
        Peminjaman hari ini <span class="badge badge-success">@foreach($phariini as $t) {{$t->total}}  @endforeach</span><br>
        Pengembalian hari ini <span class="badge badge-success">@foreach($pghariini as $t) {{$t->total}}  @endforeach</span><br>
        </div>
    </div>
    @if($data->count() > 0)
    <div class="card">
        <div class="card-body">
        <h2>List Peminjaman</h2><br>
            <table class="table table-striped">
                <tr>
                    <th>Kode</th>
                    <th>Peminjam</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Status</th>
                    <th>Action  </th>
                </tr>
                @foreach($data as $p)
                <tr>
                    <td>{{$p->kode}}</td>
                    <td>{{$p->peminjam}}</td>
                    <td>{{$p->tanggal_pinjam}}</td>
                    <td>{{$p->tanggal_kembali}}</td>
                    <td>{{$p->status_peminjaman}}</td>
                    <td><form action="{{route('konfirmasi', $p->id)}}" method="POST">
                    @csrf
                        <input type="hidden" name="_method" val="patch">
                        <input type="submit" value="Konfirmasi">
                    </form></td>
                </tr>
                @endforeach
            </table>  
        </div>
    </div>
    @else
    @endif
</div>