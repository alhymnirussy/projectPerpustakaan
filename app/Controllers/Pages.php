<?php

namespace App\Controllers;

use App\Models\bukuModels;

class Pages extends BaseController
{

    public function __construct(){

    
        $this->daftarBuku = new BukuModels();
    }
    public function halamanDepan(){
        $buku = $this->daftarBuku->getBuku();
        $data=[
            'title'=>'Halaman Depan',
            'buku'=>$buku
        ];

        return view('pages/halamanDepan',$data);

    }
    public function dataBuku(){

            $buku = $this->daftarBuku->getBuku();

        $data=[
            'title'=>'Daftar Buku',
            'buku'=>$buku
        ];

        return view('pages/indexBuku',$data);

    }
    public function cariBuku(){
        if($this->request->isAJAX()){
            $value = $this->request->getVar('cari');

            $buku = $this->daftarBuku->cariBuku($value);
            
            $data = [
                'title'=>'Halaman Daftar Buku',
                'buku'=>$buku
            ];

            $msg=[
                'sukses'=>view('pages/hasilPencarian',$data)
            ];

            echo json_encode($msg);

        }
    }
    
}
