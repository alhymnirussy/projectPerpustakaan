<?php

namespace App\Controllers;

use App\Models\dendaModels;


class Denda extends BaseController
{
    public function __construct(){

        $this->daftarDenda = new dendaModels;
        
    }
    public function index(){

        $data =[
            'title'=>'Halaman Denda'
        ];

        return view('denda/index',$data);
    }
    public function edit(){
        if($this->request->isAJAX()){
            $id_denda = $this->request->getVar('data_id');

            $dataDenda = $this->daftarDenda->find($id_denda);

            $data=[
                'title'=>'Halaman Edit Denda',
                'denda'=>$dataDenda
            ];

            $msg=[
                'sukses'=>view('denda/modalEdit',$data)
            ];

            echo json_encode($msg);  
        }
    }
    public function dataDenda(){
        if($this->request->isAJAX()){
            $denda = $this->daftarDenda->tampilDenda();
            $totalDenda = $this->daftarDenda->getTotalDenda();

            $data =[
                'denda'=>$denda,
                'totalDenda'=>$totalDenda
            ];

            $msg=[
                'sukses'=>view('denda/tampilDataDenda',$data)
            ];

            echo json_encode($msg);
        }
    }
    public function update(){
        $validation = \Config\Services::validation();
        if($this->request->isAJAX()){
            $id_denda = $this->request->getVar('id_denda');

            $valid = $this->validate([
                'denda'=> [
                    'rules'=>'required',
                    'errors'=>'{field} harus diisi'
                ]
            ]);

            if(!$valid){
                $msg=[
                    'error'=> [
                        'denda'=> $validation->getError('denda')
                    ]
                ];
                echo json_encode($msg);
            }
            else{
                $data =[
                    'id_denda'=>$this->request->getVar('id_denda'),
                    'besar_denda'=>$this->request->getVar('denda')
                ];

                $this->daftarDenda->update($id_denda,$data);

                $msg=[
                    'sukses'=>'Data denda berhasil diupdate'
                ];

                echo json_encode($msg);
            }

            
        }
    }
    // public function nonAktif($id_denda){

    //     $this->daftarDenda->nonAktifDenda($id_denda);

    //     return redirect()->to('/denda/tampilkanDenda');
    // }
    // public function Aktif($id_denda){

    //     $this->daftarDenda->AktifDenda($id_denda);

    //     return redirect()->to('/denda/tampilkanDenda');
    // }

}