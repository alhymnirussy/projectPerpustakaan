<?php 

namespace App\Models;

use CodeIgniter\Model;

class peminjamanModels extends Model{
    protected $table = 'peminjam';
    protected $allowedFields = ['id_pinjam','id_anggota','id_buku','tanggal_pinjam','tanggal_kembali'];
    protected $useTimestamps = false;
    protected $primaryKey = 'id_pinjam';
    protected $dateFormat = 'datetime';


    public function getPeminjaman($id_pinjam){

        return $this->where(['id_pinjam'=>$id_pinjam])->first();

    }

    function generateKode(){
        $q = $this->db->query('SELECT max(RIGHT(id_pinjam,4)) AS maxKode from peminjam');
        $kd = "";
        if($q->getNumRows() > 0){
            foreach($q->getResult() as $k){
                $tmp = ((int)$k->maxKode) + 1;
                $kd = sprintf("%04s", $tmp);
            }
        }
        else{
            $kd = "0001";
        }
        $kd_baru = "PJ".$kd;

        return $kd_baru;
    }

    public function getDataPeminjaman(){
        return $this->db->table('peminjam')
            ->join('anggota','anggota.id_anggota = peminjam.id_anggota')
            ->join('buku','buku.id_buku = peminjam.id_buku')
            ->get()->getResultArray();
    }
    public function getPeminjamanDetail($id_pinjam){
        return $this->db->table('peminjam')->where(['id_pinjam'=>$id_pinjam])
            ->join('anggota','anggota.id_anggota = peminjam.id_anggota')
            ->join('buku','buku.id_buku = peminjam.id_buku')
            ->get()->getResultArray();
    }
    public function hitungPeminjaman(){

        $query = $this->db->query("SELECT * FROM peminjam");
        $total = $query->getNumRows();

        if($total > 0){
            return $total;
        }
        else{
            return 0;
        }
        
    } 
}

?>