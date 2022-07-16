<?php

namespace App\Controllers;
use App\Models\peminjamanModels;
use App\Models\anggotaModels;
use App\Models\bukuModels;

class Home extends BaseController
{

    public function __construct(){

        $this->pinjam = new PeminjamanModels();
        $this->daftarBuku = new BukuModels();
        $this->daftarAnggota = new AnggotaModels();
    }
    public function index()
    {
        $jumlah_peminjaman = $this->pinjam->hitungPeminjaman();
        $jumlah_buku = $this->daftarBuku->hitungBuku();
        $jumlah_anggota = $this->daftarAnggota->hitungAnggota();
        $data =[
            'title'=>'Halaman Depan Perpustakaan',
            'jumlah_buku'=>$jumlah_buku,
            'jumlah_anggota'=>$jumlah_anggota,
            'jumlah_peminjaman'=>$jumlah_peminjaman
        ];

        return view('home/index',$data);
    }
}
