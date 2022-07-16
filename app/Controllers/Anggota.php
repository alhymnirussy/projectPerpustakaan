<?php

namespace App\Controllers;

use App\Models\anggotaModels;

class Anggota extends BaseController
{
    public function __construct(){

        $this->daftarAnggota = new AnggotaModels;
        
    }
    public function index()
    {
        $data=[
            'title'=>'Halaman Index Anggota',
        ];
        return view('anggota/index',$data);
    }
   public function detail(){
    if($this->request->isAJAX()){
        $id_anggota=$this->request->getVar('data_id');
        $anggota = $this->daftarAnggota->find($id_anggota);

        $data=[
            'title'=>'Halaman Detail Anggota',
            'anggota'=>$anggota
        ];

        $msg=[
            'sukses'=>view('anggota/modalDetail',$data)
        ];

        echo json_encode($msg);
    }
   }
    public function tambah(){
        $id_baru = $this->daftarAnggota->generateKode();
        $today = date('d-m-Y');

        if($this->request->isAJAX()){

            $data =[
                'title_modal'=> 'Tambah Data Anggota',
                'id_baru'=>$id_baru,
                'today'=>$today
            ];

            $msg =[
                'sukses'=>view('anggota/modalTambah',$data)
            ];

            echo json_encode($msg);

        }
    }
    // public function tambahBanyak(){
    //     if($this->request->isAJAX()){
    //         $msg =[
    //             'sukses'=>view('anggota/formTambahBanyak')
    //         ];
    //         echo json_encode($msg);
    //     }
    // }

    public function simpan(){
        $validation = \Config\Services::validation();
        if($this->request->isAJAX()){

            $valid = $this->validate([
                'nama_anggota'=>[
                    'rules'=>'required|is_unique[anggota.nama_anggota]',
                    'errors'=>[
                        'required'=>'{field} tidak boleh kosong',
                        'is_unique'=>'{field} sudah terdaftar'
                    ]
                    ],
                    'jenis_kelamin'=> [
                        'rules'=>'required',
                        'errors'=>[
                            'required'=>'{field} harus diisi'
                        ]
                    ],
                    'no_telp'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required'=>'{field} harus diisi'
                        ]
                    ],
                    'alamat'=>[
                        'rules'=>'required',
                        'errors'=>[
                            'required'=>'{field} harus diisi'
                        ]
                    ]
            ]);

            if(!$valid){
                $msg=[
                    'error'=>[
                        'nama_anggota'=>$validation->getError('nama_anggota'),
                        'jenis_kelamin'=>$validation->getError('jenis_kelamin'),
                        'no_telp'=>$validation->getError('no_telp'),
                        'alamat'=>$validation->getError('alamat')
                    ]
                ];

                echo json_encode($msg);
            }
            else{
                $this->daftarAnggota->insert([
                    'id_anggota'=>$this->request->getVar('id_anggota'),
                    'nama_anggota'=>$this->request->getVar('nama_anggota'),
                    'jenis_kelamin'=>$this->request->getVar('jenis_kelamin'),
                    'no_telp'=>$this->request->getVar('no_telp'),
                    'alamat'=>$this->request->getVar('alamat'),
                    'tanggal_daftar'=>$this->request->getVar('tanggalDaftar')
                ]);

                $msg=[
                    'sukses'=>'Data Berhasil Diinput'
                ];

                echo json_encode($msg);
            }

        }
    }
    public function dataAnggota(){
        $data = [
            'anggota'=> $this->daftarAnggota->getAnggota()
        ];

        if($this->request->isAJAX()){
            $msg =[
                'sukses'=> view('anggota/tampilDataAnggota',$data)
            ];

            echo json_encode($msg);
        }
    }
    public function edit(){
        if($this->request->isAJAX()){
            $id_anggota = $this->request->getVar('data_id');

            $row = $this->daftarAnggota->find($id_anggota);

            $data = [
                'id_anggota'=> $row['id_anggota'],
                'nama_anggota'=>$row['nama_anggota'],
                'jenis_kelamin'=>$row['jenis_kelamin'],
                'no_telp'=>$row['no_telp'],
                'alamat'=>$row['alamat']
            ];

            $msg = [
                'sukses'=> view('anggota/modalEdit', $data)
            ];

            echo json_encode($msg);
        }
    }
    public function hapus(){
        if($this->request->isAJAX()){
            $id_anggota = $this->request->getVar('data_id');

            $this->daftarAnggota->delete($id_anggota);

            $msg =[
                'sukses'=> 'Data Anggota dengan Berhasil Dihapus!'
            ];

            echo json_encode($msg);
        }
    }
    
    public function update(){

        $validation = \Config\Services::validation();

        if($this->request->isAJAX()){
            $id_anggota = $this->request->getVar('id_anggota');
            $row = $this->daftarAnggota->find($id_anggota);
            $namaAnggota_dtbs = $row['nama_anggota'];
            $nama_anggota = $this->request->getVar('nama_anggota');

            if($nama_anggota == $namaAnggota_dtbs){
                $rules_nama = 'required';
            }
            else{
                $rules_nama = 'required|is_unique[anggota.nama_anggota]';
            }

            $valid = $this->validate([
                'nama_anggota'=> [
                    'rules' => $rules_nama,
                    'errors'=> [
                        'required'=> '{field} tidak boleh kosong',
                        'is_unique'=> '{field} sudah terdaftar '
                    ],
                ],
                'jenis_kelamin'=> [
                    'rules'=>'required',
                    'errors'=>[
                        'required'=>'{field} harus diisi'
                    ]
                ],
                'no_telp'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required'=>'{field} harus diisi'
                    ]
                ],
                'alamat'=>[
                    'rules'=>'required',
                    'errors'=>[
                        'required'=>'{field} harus diisi'
                    ]
                ]
            ]);

            if(!$valid){
                $msg = [
                    'error'=> [
                        'nama_anggota'=> $validation->getError('nama_anggota'),
                        'jenis_kelamin'=> $validation->getError('nama_anggota'),
                        'no_telp'=> $validation->getError('no_telp'),
                        'alamat'=> $validation->getError('alamat'),
                    ]
                ];

                echo json_encode($msg);
            }
            else{
                $data = [
                    'nama_anggota' => $this->request->getVar('nama_anggota'),
                    'jenis_kelamin' => $this->request->getVar('jenis_kelamin'),
                    'no_telp' => $this->request->getVar('no_telp'),
                    'alamat' => $this->request->getVar('alamat'),
                ];

                $this->daftarAnggota->update($id_anggota,$data);

                $msg=[
                    'sukses'=>'Data Berhasil Diinput'
                ];
                echo json_encode($msg);

            }
        }
    }
    public function hapusBanyak(){
        if($this->request->isAJAX()){
            $id_anggota = $this->request->getVar('id_anggota');
            $jumlahDataId = count($id_anggota);

            for($i=0; $i<$jumlahDataId; $i++){
                $this->daftarAnggota->delete($id_anggota[$i]);
            }

            $msg=[
                'sukses'=> "Data berjumlah $jumlahDataId berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }
    
}
