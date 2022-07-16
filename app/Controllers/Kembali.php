<?php

namespace App\Controllers;

use App\Models\peminjamanModels;
use App\Models\pengembalianModels;
use App\Models\anggotaModels;
use App\Models\bukuModels;
use App\Models\dendaModels;

class Kembali extends BaseController
{
    public function __construct(){

        $this->pinjam = new PeminjamanModels();
        $this->daftarBuku = new BukuModels();
        $this->daftarAnggota = new AnggotaModels();
        $this->denda = new dendaModels();
        $this->kembali = new pengembalianModels();
    }
    public function index(){
        $data=[
            'title'=>'Halaman Data Pengembalian Buku'
        ];

        return view('pengembalian/index',$data);
    }
    public function dataPengembalian(){
        if($this->request->isAJAX()){
            $pengembalian = $this->kembali->getDataPengembalian();

            $data =[
                'pengembalian'=>$pengembalian
            ];
    
            $msg=[
                'sukses'=>view('pengembalian/tampilDataPengembalian',$data)
            ];
    
            echo json_encode($msg);
        }
    }
    public function tambah(){
        if($this->request->isAJAX()){
            $id_pinjam = $this->request->getVar('data_id');
            $totalHari = $this->request->getVar('data_hari');
            $denda = $this->request->getVar('data_denda');

            if($totalHari >= 0 ){
                $jumlahDenda = 0;
            }elseif($totalHari < -30 ){
                $jumlahDenda = 60000;
            }else{
                $jumlahDenda = abs($totalHari)*$denda;
            }

            $today = date('Y-m-d');
            $row = $this->pinjam->find($id_pinjam);
            $this->daftarBuku->pengembalianStok($row['id_buku']);
        
            $this->kembali->insert([
                'id_pinjam'=>$row['id_pinjam'],
                'id_anggota'=>$row['id_anggota'],
                'id_buku'=>$row['id_buku'],
                'tanggal_pinjam'=>$row['tanggal_pinjam'],
                'tanggal_kembali'=>$row['tanggal_kembali'],
                'dikembalikan_pada'=>$today,
                'denda'=>$jumlahDenda
            ]);

            $this->denda->totalDenda($jumlahDenda);

            $this->pinjam->delete($id_pinjam);

            $msg=[
                'sukses'=>"Pengembalian dengan id peminjaman : $id_pinjam Berhasil"
            ];

            echo json_encode($msg);
        }
    }
    public function detail(){
        if($this->request->isAJAX()){
            $id_pinjam = $this->request->getVar('data_id');
            $dataPengembalianDetail = $this->kembali->getPengembalianDetail($id_pinjam);

            $data = [
                'title'=>'Halaman Detail',
                'detail'=>$dataPengembalianDetail,
            ];

            $msg=[
                'sukses'=>view('pengembalian/modalDetail',$data)
            ];

            echo json_encode($msg);
        }
    }

}