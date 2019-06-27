
@extends('layouts.dashboard')

@section('title')
Detail Peminjaman
@endsection

@section('content')
<div class="container">
    <a href="{{ url('/riwayat') }}"  class="btn btn-dark" style="margin-bottom:20px">Kembali</a>
    <div class="card">
        <div class="card-body">
        
        

        
            <table class="table">
            <h2 clas="card-title">Detail peminjaman</h2>
            <tr>
                <th>Peminjam</th>
                <th>Tanggal Pinjam</th>
                <th>Tanggal Kembali</th>
                <th>Status</th>
            </tr>   

            <!-- menampilkan detail peminjaman dari controller -->
            @foreach($peminjaman as $p)
            <tr>
                <td>{{$p->peminjam}}</td>
                <td>{{$p->tanggal_pinjam}}</td>
                <td>{{$p->tanggal_kembali}}</td>
                <td>{{$p->status_peminjaman}}</td>
            </tr>
            <tr>
            <!-- Mengecek jika status peminjamannya selesai, maka tombol generate code tidak akan ditampilkan -->
                <td>@if($p->status_peminjaman == "Selesai")

                    @else
                    <a href="" class="btn btn-success" id="generateid" data-aaa="{{$p->kode}}" data-toggle="modal" data-target="#generate">Generate Kode</a>
                    @endif
                </td>
                <td colspan="3"></td>
            </tr>
            @endforeach
            </table>

    

            <table class="table table-striped">
            <hr><h2 clas="card-title">Inventaris yang dipinjam</h2>
            <tr>
                <th>Barang</th>
                <th>Kode</th>
                <th>Nama Inventaris</th>
                <th colspan="2">Keterangan</th>
            </tr>

            <!-- menampilkan data barang yang dipinjam sesuai peminjaman yang dipilih -->
            @foreach($detail as $data)
            <tr>
                <td><img src="{{asset('img/Barang/'.$data->image)}}" alt="" style="height:60px; width:60px; align:center;"></td>
                <td>{{$data->kode}}</td>
                <td>{{$data->nama}}</td>
                <td>{{$data->keterangan}}</td>

                <!-- Tombol untuk menghapus detail barang -->
                @foreach($peminjaman as $p)
                    @if($p->status_peminjaman == 'Belum Dikonfirmasi')
                        <td><form method="post" action="{{route('detail.destroy', $data->id)}}">
                        @csrf
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="id_p" value="">
                        <input onclick="return confirm('Apakah anda yakin ingin menghapus barang?');" type="submit" class="btn btn-danger" value="Hapus">
                        </form></td>
                    @endif
                @endforeach
                
            </tr>
            @endforeach
        </table>
        </div>
    </div>
</div>

<div class="modal fade " id="generate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h2 class="modal-title" id="kodemodal">Generate Success!</h2>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Berikan kode ini <span id="a" class="badge badge-info">@foreach($peminjaman as $p) {{$p->kode}} @endforeach</span> kepada operator terdekat untuk memproses peminjaman / pengembalian
            </div>
        </div>
    </div>
</div>
@endsection