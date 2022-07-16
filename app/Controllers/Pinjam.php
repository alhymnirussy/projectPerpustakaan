<?php

namespace App\Controllers;

use App\Models\peminjamanModels;
use App\Models\anggotaModels;
use App\Models\bukuModels;
use App\Models\dendaModels;
use App\Models\pengembalianModels;

class Pinjam extends BaseController
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
            'title'=>'Halaman Peminjaman Buku'
        ];

        return view('peminjaman/index',$data);
    }

    public function dataPeminjaman(){
        $dataPeminjaman = $this->pinjam->getDataPeminjaman();
        $denda = $this->denda->getDenda();
        $data = [
            'title'=>'Halaman Data Peminjaman',
            'peminjaman'=> $dataPeminjaman,
            'denda'=> $denda
        ];

        if($this->request->isAJAX()){

            $msg=[
                'sukses'=>view('peminjaman/tampilDataPeminjaman',$data)
            ];

            echo json_encode($msg);
        }
    }
    public function detail(){
        if($this->request->isAJAX()){
            $denda = $this->denda->getDenda();
            $id_pinjam = $this->request->getVar('data_id');
            $dataPeminjamanDetail = $this->pinjam->getPeminjamanDetail($id_pinjam);

            $data = [
                'title'=>'Halaman Detail',
                'detail'=>$dataPeminjamanDetail,
                'denda'=> $denda
            ];

            $msg=[
                'sukses'=>view('peminjaman/modalDetail',$data)
            ];

            echo json_encode($msg);
        }
    }
    public function edit(){
        if($this->request->isAJAX()){
            $data_anggota = $this->daftarAnggota->getAnggota();
            $data_buku = $this->daftarBuku->getBuku();
            $id_pinjam = $this->request->getVar('data_id');
            $data_pinjam = $this->pinjam->getPeminjamanDetail($id_pinjam);

            $data =[
                'title'=>'Halaman Edit Data Peminjaman',
                'anggota'=>$data_anggota,
                'buku'=>$data_buku,
                'peminjaman'=> $data_pinjam
            ];

            $msg=[
                'sukses'=>view('peminjaman/modalEdit',$data)
            ];

            echo json_encode($msg);

        }
    }
    public function update(){
        if($this->request->isAJAX()){
            $id_pinjam = $this->request->getVar('id_pinjam');

            $data =[
                'id_anggota'=>$this->request->getVar('id_anggota'),
                'id_buku'=>$this->request->getVar('id_buku'),
                'tanggal_pinjam'=>$this->request->getVar('tanggal_pinjam'),
                'tanggal_kembali'=>$this->request->getVar('tanggal_kembali')
            ];

            $this->pinjam->update($id_pinjam,$data);

            $msg=[
                'sukses'=>'Data Berhasil Diupdate'
            ];

            echo json_encode($msg);
        }
    }
    public function hapus(){
        if($this->request->isAJAX()){
            $id_pinjam = $this->request->getVar('data_id');

            $this->pinjam->delete($id_pinjam);

            $msg=[
                'sukses'=> "Data peminjaman dengan id : $id_pinjam berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }
    public function cobaPinjam(){
            $id_pinjam = $this->kembali->generateKode();
            session();
            $validation = \Config\Services::validation();
            $buku = $this->daftarBuku->getBuku();
            $anggota = $this->daftarAnggota->getAnggota();

            $data = [
                'title'=>'Halaman Coba peminjam',
                'buku' => $buku,
                'id_baru'=>$id_pinjam,
                'anggota'=> $anggota,
                'validation' => $validation
            ];

            return view('peminjaman/coba_peminjam',$data); 
        
    }
    // public function tambah(){
    //     $id_pinjam = $this->pinjam->generateKode();
    //     $buku = $this->daftarBuku->getBuku();
    //     $anggota = $this->daftarAnggota->getAnggota();

    //     if($this->request->isAJAX()){
    //         $data = [
    //             'title'=>'Halaman Tambah Peminjaman',
    //             'buku' => $buku,
    //             'id_baru'=>$id_pinjam,
    //             'anggota'=> $anggota
    //         ];

    //         $msg=[
    //             'sukses'=>view('peminjaman/modalTambah',$data)
    //         ];

    //         echo json_encode($msg);
    //     }
    // }
    // public function simpan(){

        // $valid = $this->validate([
        //     'pilihBuku'=>[
        //         'rules'=> 'required',
        //         'errors'=>[
        //             'required'=> 'field buku harus diisi',     
        //         ]
        //     ],
        //     'pilihAnggota'=>[
        //         'rules'=> 'required',
        //         'errors'=>[
        //             'required'=> 'field anggota harus diisi',     
        //         ]
        //     ],
        //     'tanggalPinjam'=>[
        //         'rules'=> 'required',
        //         'errors'=>[
        //             'required'=> 'field tanggal pinjam harus diisi',     
        //         ]
        //     ],
        //     'tanggalKembali'=>[
        //         'rules'=> 'required',
        //         'errors'=>[
        //             'required'=> 'field tanggal kembali harus diisi',     
        //         ]
        //     ], 
        // ]);
    //     if(!$valid){
    //         return redirect()->to('/pinjam/cobaPinjam')->withInput();
    //     }
        // else{
        //     $this->pinjam->insert([
        //         'id_pinjam' => $this->pinjam->generateKode(),
        //         'id_anggota'=> $this->request->getVar('pilihAnggota'),
        //         'id_buku'=> $this->request->getVar('pilihBuku'),
        //         'tanggal_pinjam'=> $this->request->getVar('tanggalPinjam'),
        //         'tanggal_kembali'=> $this->request->getVar('tanggalKembali')
        //     ]);
        // session()->setFlashdata('pesan','Data Berhasil Ditambahkan');

        // return redirect()->to('/pinjam');

        // }
    // }
    public function tampilAnggota(){
        if($this->request->isAJAX()){
            $id = $this->request->getVar('dataId');

            $row = $this->daftarAnggota->find($id);

            $data = [
                'anggota' => $row
            ];

            $msg=[
                'sukses'=> view('peminjaman/dataAnggota',$data)
            ];
            
            echo json_encode($msg);
        }   
    }
    public function tampilBuku(){
        if($this->request->isAJAX()){
            $id = $this->request->getVar('dataId');

            $row = $this->daftarBuku->find($id);

            $data = [
                'buku' => $row
            ];

            $msg=[
                'sukses'=> view('peminjaman/dataBuku',$data)
            ];
            
            echo json_encode($msg);
        }   
    }
    public function hapusBanyak(){
        if($this->request->isAJAX()){
            $id_pinjam = $this->request->getVar('id_pinjam');
            $jumlahDataId = count($id_pinjam);

            for($i=0; $i<$jumlahDataId; $i++){
                $this->pinjam->delete($id_pinjam[$i]);
            }

            $msg=[
                'sukses'=> "Data berjumlah $jumlahDataId berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }
    public function simpan(){
        $validation = \Config\Services::validation();
        if($this->request->isAJAX()){

            $valid = $this->validate([
                'pilihBuku'=>[
                    'rules'=> 'required',
                    'errors'=>[
                        'required'=> 'field buku harus diisi',     
                    ]
                ],
                'pilihAnggota'=>[
                    'rules'=> 'required',
                    'errors'=>[
                        'required'=> 'field anggota harus diisi',     
                    ]
                ],
                'tanggalPinjam'=>[
                    'rules'=> 'required',
                    'errors'=>[
                        'required'=> 'field tanggal pinjam harus diisi',     
                    ]
                ],
                'tanggalKembali'=>[
                    'rules'=> 'required',
                    'errors'=>[
                        'required'=> 'field tanggal kembali harus diisi',     
                    ]
                ], 
            ]);

            if(!$valid){
                $msg=[
                    'error'=>[
                        'pilihBuku'=>$validation->getError('pilihBuku'),
                        'pilihAnggota'=>$validation->getError('pilihAnggota'),
                        'tanggalPinjam'=>$validation->getError('tanggalPinjam'),
                        'tanggalKembali'=>$validation->getError('tanggalKembali')
                    ]
                ];

                    echo json_encode($msg);
            }
            else{
                $id_buku = $this->request->getVar('pilihBuku');
                $stokBuku = $this->daftarBuku->getStok($id_buku);
                if($stokBuku != 0){
                    $this->daftarBuku->peminjamanStok($id_buku);
                    $this->pinjam->insert([
                        'id_pinjam' => $this->request->getVar('id_pinjam'),
                        'id_anggota'=> $this->request->getVar('pilihAnggota'),
                        'id_buku'=> $this->request->getVar('pilihBuku'),
                        'tanggal_pinjam'=> $this->request->getVar('tanggalPinjam'),
                        'tanggal_kembali'=> $this->request->getVar('tanggalKembali')
                    ]);
                    $msg=[
                        'sukses'=>'Data Berhasil Diinput'
                    ];
    
                    echo json_encode($msg);
                }
                else{
                    $msg = [
                        'errors'=>"Maaf, stok buku dengan id $id_buku : $stokBuku"
                    ];
                    echo json_encode($msg);
                }
            }

        }
    }

}