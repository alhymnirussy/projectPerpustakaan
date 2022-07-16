<?php 

namespace App\Models;

use CodeIgniter\Model;

class anggotaModels extends Model{
    protected $table = 'anggota';
    protected $allowedFields = ['id_anggota','nama_anggota','jenis_kelamin','umur','no_telp','alamat','tanggal_daftar'];
    protected $useTimestamps = false;
    protected $primaryKey = 'id_anggota';

    function getAnggota($id=false){
        if($id==false){
            return $this->findAll();
        }
        return $this->where(['id_anggota'=>$id])->first();
    }
    // function getMax($table= null , $primaryKey = null ){
    //     $this->select_max($primaryKey);
    //     return $this->get($table)->row_array()[$primaryKey]; 
    // }
    function generateKode(){
        $q = $this->db->query('SELECT max(RIGHT(id_anggota,3)) AS maxKode from anggota');
        $kd = "";
        if($q->getNumRows() > 0){
            foreach($q->getResult() as $k){
                $tmp = ((int)$k->maxKode) + 1;
                $kd = sprintf("%03s", $tmp);
            }
        }
        else{
            $kd = "001";
        }
        $kd_baru = "A".$kd;

        return $kd_baru;

    }
    public function hitungAnggota(){

        $query = $this->db->query("SELECT * FROM anggota");
        $total = $query->getNumRows();

        if($total > 0){
            return $total;
        }
        else{
            return 0;
        }
        
    }
}

//     $sql = "SELECT MAX(id_buku) AS maxKode FROM buku";
    //     $query = $this->db->query($sql);

    //     if($query->getNumRows() > 0){
    //         $row = $query->getRow();
    //         $n = ((int)$row->maxKode+1);
    //         $no = sprintf("%'.04d", $n);
    //     }
    //     else{
    //         $no ="0001";
    //     }
    //     $char = "BK";
    //     $kodeBaru = $char.$no;

    //     return $kodeBaru;


?>