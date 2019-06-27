@extends('layouts.dashboard')

@section('title')
Riwayat Peminjaman
@endsection

@section('content')

<div class="container">
    <a href="{{ url('/inventaris') }}" class="btn btn-dark" style="margin-bottom:20px">Kembali</a>
    @if(\Session::has('success'))
        <div class="alert alert-success"><span>{{\Session::get('success')}}</span></div>
    @endif
    <!-- Card untuk menampilkan peminjaman yang belum diknfirmasi -->
    <div class="card">
        <div class="card-body">
        <center>Total riwayat peminjaman <span class="badge badge-success">@foreach($total as $t) {{$t->data}}  @endforeach</span></center>    
        </div>
    </div>
    @if($dbdk->count() > 0)
    <div class="card">
        <div class="card-body">
        <h2>Peminjaman Belum Dikonfirmasi</h2><br>
            <table class="table table-striped">
                <tr>
                    <th>Kode Peminjaman</th>
                    <th>Tanggal Request</th>
                    <th colspan="2"><center>Action</center></th>
                </tr>
                @foreach($dbdk as $bdk)
                <tr>
                    <td>{{$bdk->kode}}</td>
                    <td>{{$bdk->tanggal_pinjam}}</td>
                    <td><a href="{{url('/riwayat',$bdk->id)}}" class="btn btn-success">Detail</a></td>
                    <td><form method="post" action="{{route('peminjaman.destroy', $bdk->id)}}">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <input onclick="return confirm('Apakah anda yakin ingin membatalkan request?');" type="submit" class="btn btn-danger" value="Cancel Request">
                        </form>
                    </td>
                </tr>
                @endforeach
            </table>  
        </div>
    </div>
    @else
    @endif

    @if($dsb->count() > 0)
    <hr>

    <!-- card untuk menampilkan data yang sedang berjalan -->
    <div class="card">
        <div class="card-body">
            <h2>Peminjaman Sedang Berjalan</h2><br>
            <table class="table table-striped">
                <tr>
                    <th>Kode Peminjaman</th>
                    <th>Tanggal Pinjam</th>
                    <th>Action</th>
                </tr>
                @foreach($dsb as $sb)
                <tr>
                    <td>{{$sb->kode}}</td>
                    <td>{{$sb->tanggal_pinjam}}</td>
                    <td><a href="{{url('/riwayat',$sb->id)}}" class="btn btn-success">Detail</a></td>
                </tr>
                @endforeach
            </table>    
        </div>
    </div>
    @else
    @endif

    @if($ds->count() > 0)
    <hr>

    <!-- card untuk menampilkan data peminjaman yang sudah selesai -->
    <div class="card">
        <div class="card-body">
            <h2>Peminjaman Sudah Selesai</h2><br>
            <table class="table table-striped">
                <tr>
                    <th>Kode Peminjaman</th>
                    <th>Tanggal Pinjam</th>
                    <th>Tanggal Kembali</th>
                    <th>Action</th>
                </tr>
                @foreach($ds as $s)
                <tr>
                    <td>{{$s->kode}}</td>
                    <td>{{$s->tanggal_pinjam}}</td>
                    <td>{{$s->tanggal_kembali}}</td>
                    <td><a href="{{url('/riwayat',$s->id)}}" class="btn btn-success">Detail</a></td>
                </tr>
                @endforeach
            </table>    
        </div>
    </div>
    @else
    @endif
</div><br><br><br>
@endsection