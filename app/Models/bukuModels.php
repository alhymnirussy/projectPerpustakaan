<?php 

namespace App\Models;

use CodeIgniter\Model;


class bukuModels extends Model{
    protected $table = 'buku';
    protected $allowedFields = ['id_buku','judul_buku','kategori','pengarang','penerbit','slug','cover','stok'];
    protected $useTimestamps = false;
    protected $primaryKey = 'id_buku';

    function getBuku($slug=false){

        if($slug){
            return $this->where(['slug'=>$slug])->first();
        }
        return $this->findAll();
    }
 
    public function getStok($id_buku){
        
        $data = $this->where(['id_buku'=>$id_buku])->first();
        $stok = $data['stok'];

        return $stok;
    }
    public function peminjamanStok($id_buku){

        $stok = $this->getStok($id_buku);
        $stok--;
        $sql = "UPDATE buku SET stok = '$stok' WHERE id_buku = '$id_buku'";

        $this->db->query($sql);
    }
    public function pengembalianStok($id_buku){

        $stok = $this->getStok($id_buku);
        $stok++;
        $sql = "UPDATE buku SET stok = '$stok' WHERE id_buku = '$id_buku'";

        $this->db->query($sql);
    }
  
    function generateKode(){
        $q = $this->db->query('SELECT max(RIGHT(id_buku,3)) AS maxKode from buku');
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
        $kd_baru = "BK".$kd;

        return $kd_baru;

    }
    public function hitungBuku(){

        $query = $this->db->query("SELECT * FROM buku");
        $total = $query->getNumRows();

        if($total > 0){
            return $total;
        }
        else{
            return 0;
        }
    }
    public function cariBuku($value){

        $q = $this->db->query("SELECT * FROM buku WHERE judul_buku LIKE '$value'");

        return $q;
    }
}


?>