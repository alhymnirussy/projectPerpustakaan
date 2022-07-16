<?php

namespace App\Controllers;

use App\Models\bukuModels;

class Buku extends BaseController
{
    public function __construct(){


        $this->daftarBuku = new bukuModels;
        
    }
    public function index()
    {
        $data=[
            'title'=>'Halaman Index Buku',
        ];
        return view('buku/index',$data);
    }
    public function dataBuku(){
        $data=[
            'buku'=>$this->daftarBuku->getBuku(),
        ];
        if($this->request->isAJAX()){
            $msg=[
                'sukses'=> view('buku/tampilDataBuku',$data)
            ];
            echo json_encode($msg);
        }
        else{
            exit('maaf tidak dapat di proses');
        }
    }
    public function tambah(){
        $id_baru = $this->daftarBuku->generateKode();
        if($this->request->isAJAX()){

            $data=[
                'id_generate'=>$id_baru
            ];
            $msg=[
                'data'=> view('buku/modalTambah',$data)
            ];
            echo json_encode($msg);
        }
        else{
            exit('maaf tidak dapat di proses');
        }

    }
    public function edit(){
        if($this->request->isAJAX()){
            $id_buku = $this->request->getVar('id_buku');

            $row = $this->daftarBuku->find($id_buku);

            $data = [
                'id_buku'=> $row['id_buku'],
                'slug'=>$row['slug'],
                'judul_buku'=>$row['judul_buku'],
                'kategori'=> $row['kategori'],
                'pengarang'=>$row['pengarang'],
                'penerbit'=>$row['penerbit'],
                'stok'=>$row['stok']
            ];

            $msg=[
                'sukses'=> view('buku/modalEdit',$data)
            ];
            echo json_encode($msg);
        }
        else{
            exit('maaf tidak dapat di proses');
        }
    }

    public function hapus(){
        if($this->request->isAJAX()){
            $id_buku = $this->request->getVar('data_id');

            $this->daftarBuku->delete($id_buku);

            $msg =[
                'sukses'=> 'Data Buku dengan Berhasil Dihapus!'
            ];

            echo json_encode($msg);
        }
    }
  
    public function simpan()
    {
        $validation = \Config\Services::validation();
        if($this->request->isAJAX()){
            
            $valid = $this->validate([
                'id'=>[
                    'rules'=> 'required|is_unique[buku.judul_buku]',
                    'errors'=>[
                        'required'=> '{field} harus diisi',
                        'is_unique'=>'{field} Sudah Terdaftar'                  
                    ]
                ],
                'judul'=>[
                    'rules'=> 'required|is_unique[buku.judul_buku]',
                    'errors'=>[
                        'required'=> '{field} harus diisi',
                        'is_unique'=>'{field} Sudah Terdaftar'                  
                    ]
                ],
                'kategori'=>[
                    'rules'=> 'required',
                    'errors'=>[
                        'required'=> '{field} harus diisi'                 
                    ]
                ],
                'pengarang'=>[
                    'rules'=> 'required',
                    'errors'=>[
                        'required'=> '{field} harus diisi'              
                    ]
                ],
                'penerbit'=>[
                    'rules'=> 'required',
                    'errors'=>[
                        'required'=> '{field} harus diisi',            
                    ]
                ],
                'stok'=>[
                    'rules'=> 'required|numeric',
                    'errors'=>[
                        'required'=> '{field} harus diisi',
                        'numeric'=>'{field} harus angka'                  
                    ]
                ],
                'file'=>[
                    'rules'=> 'is_image[file]|mime_in[file,image/png,image/jpg,image/png,image/jpeg]',
                    'errors'=>[
                        'is_image'=> '{field} bukan gambar',
                        'mime_in'=> 'ekstensi {field} tidak sesuai'       
                    ]
                ]      
            ]);
            if(!$valid){
                $msg = [
                    'error'=>[
                        'id'=> $validation->getError('id'),
                        'judul'=> $validation->getError('judul'),
                        'kategori'=> $validation->getError('kategori'),
                        'pengarang'=> $validation->getError('pengarang'),
                        'penerbit'=> $validation->getError('penerbit'),
                        'stok'=> $validation->getError('stok'),
                        'file'=>$validation->getError('file')
                    ]
                ];
                echo json_encode($msg);
            }
            else{
                $cover = $this->request->getFile('file');
                
                if($cover->getError() == 4){
                    $namaCover = 'no_image.jpeg';
                }
                else{
                    $cover->move('assets/img');
                    $namaCover = $cover->getName();
                }
             
                $judul = $this->request->getVar('judul');
                $slug = url_title($judul,'-',true);
                $this->daftarBuku->insert([
                    'id_buku' => $this->request->getVar('id'),
                    'judul_buku' => $this->request->getVar('judul'),
                    'kategori'=> $this->request->getVar('kategori'),
                    'slug' => $slug,
                    'pengarang' => $this->request->getVar('pengarang'),
                    'penerbit' => $this->request->getVar('penerbit'),
                    'stok' => $this->request->getVar('stok'),
                    'cover'=>$namaCover
                ]);

                $msg=[
                    'sukses'=>'Data Berhasil Ditambah'
                ];

                echo json_encode($msg);
            }
        }
        else{
            exit('Tidak Dapat Diproses');
        }
    }
    public function update(){

        $validation = \Config\Services::validation();

        if($this->request->isAJAX()){
            $judul_buku = $this->request->getVar('judul');
            $slug = $this->request->getVar('slug');
            $buku = $this->daftarBuku->getBuku($slug);

            $judul_dtbs = $buku['judul_buku'];
        

            if($judul_buku == $judul_dtbs){
                $rules_judul = 'required';
            }
            else{
                $rules_judul = 'required|is_unique[buku.judul_buku]';
            }
            
            $valid = $this->validate([
                'judul'=>[
                    'rules'=> $rules_judul,
                    'errors'=>[
                        'required'=> '{field} harus diisi',
                        'is_unique'=>'{field} Sudah Terdaftar'                  
                    ]
                ],
                'kategori'=>[
                    'rules'=> 'required',
                    'errors'=>[
                        'required'=> '{field} harus diisi'                 
                    ]
                ],
                'pengarang'=>[
                    'rules'=> 'required',
                    'errors'=>[
                        'required'=> '{field} harus diisi'              
                    ]
                ],
                'penerbit'=>[
                    'rules'=> 'required',
                    'errors'=>[
                        'required'=> '{field} harus diisi',            
                    ]
                ],
                'stok'=>[
                    'rules'=> 'required|numeric',
                    'errors'=>[
                        'required'=> '{field} harus diisi',
                        'numeric'=>'{field} harus angka'                  
                    ]
                ],
            ]);
            if(!$valid){
                $msg = [
                    'error'=>[
                        'judul'=> $validation->getError('judul'),
                        'kategori'=> $validation->getError('kategori'),
                        'pengarang'=> $validation->getError('pengarang'),
                        'penerbit'=> $validation->getError('penerbit'),
                        'stok'=> $validation->getError('stok'),
                       
                    ]
                ];
                echo json_encode($msg);
            }
            else{

                $judul = $this->request->getVar('judul');
                $slug = url_title($judul,'-',true);
            
                $data = [
                    'id_buku' => $this->request->getVar('id'),
                    'judul_buku' => $this->request->getVar('judul'),
                    'kategori'=> $this->request->getVar('kategori'),
                    'slug' => $slug,
                    'pengarang' => $this->request->getVar('pengarang'),
                    'penerbit' => $this->request->getVar('penerbit'),
                    'stok' => $this->request->getVar('stok'),
                ];
                
                $id_buku = $this->request->getVar('id');
                $this->daftarBuku->update($id_buku,$data);


                $msg=[
                    'sukses'=>'Data Berhasil Diubah'
                ];

                echo json_encode($msg);
            }
        }
        else{
            exit('Tidak Dapat Diproses');
        }
    }

    public function hapusBanyak(){
        if($this->request->isAJAX()){
            $id_buku = $this->request->getVar('id_buku');
            $jumlahDataId = count($id_buku);

            for($i=0; $i<$jumlahDataId; $i++){
                $this->daftarBuku->delete($id_buku[$i]);
            }

            $msg=[
                'sukses'=> "Data berjumlah $jumlahDataId berhasil dihapus"
            ];

            echo json_encode($msg);
        }
    }
    public function detail(){
        if($this->request->isAJAX()){
            $id_buku=$this->request->getVar('data_id');
            $buku = $this->daftarBuku->find($id_buku);
    
            $data=[
                'title'=>'Halaman Detail Anggota',
                'buku'=>$buku
            ];
    
            $msg=[
                'sukses'=>view('buku/modalDetail',$data)
            ];
    
            echo json_encode($msg);
        }
    }

}
