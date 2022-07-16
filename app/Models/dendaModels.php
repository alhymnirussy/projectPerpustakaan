<?php 

namespace App\Models;

use CodeIgniter\Model;

class dendaModels extends Model{
    protected $table = 'denda';
    protected $allowedFields = ['id_denda','besar_denda'];
    protected $useTimestamps = false;
    protected $primaryKey = 'id_denda';

    public function getDenda(){
        
        $data = $this->where(['status'=> 1])->first();
        $denda = $data['besar_denda'];
        return $denda;
    }
    public function getTotalDenda(){
        
        $data = $this->where(['status'=> 1])->first();
        $denda = $data['total_denda'];
        return $denda;
    }
    public function tampilDenda(){
        return $this->findAll();
    }
    // public function aktifDenda($id_denda){
    //     $sql = "UPDATE denda SET status = 1 WHERE id_denda = '$id_denda'
    //     ";
        
    //     $this->db->query($sql);  
    // }
    // public function nonAktifDenda($id_denda){
    //     $sql = "UPDATE denda SET status = 0 WHERE id_denda = '$id_denda'";
    //     $this->db->query($sql);
    // }
    public function totalDenda($jumlahDenda){
        $data = $this->where(['status'=> 1])->first();
        $denda = $data['total_denda'];
        $denda += $jumlahDenda; 
        $sql = "UPDATE denda SET total_denda = '$denda' WHERE status = 1";
        $this->db->query($sql);
    }
}

?>