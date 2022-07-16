<?php 

namespace App\Models;

use CodeIgniter\Model;

class pengembalianModels extends Model{
    protected $table = 'pengembalian';
    protected $allowedFields = ['id_pinjam','id_anggota','id_buku','tanggal_pinjam','tanggal_kembali','dikembalikan_pada','denda'];
    protected $useTimestamps = false;
    protected $primaryKey = 'id_pinjam';
    protected $dateFormat = 'datetime';


    public function getPengembalian($id_pinjam){

        return $this->where(['id_pinjam'=>$id_pinjam])->first();

    }
    function generateKode(){
        $q = $this->db->query('SELECT max(RIGHT(id_pinjam,4)) AS maxKode from pengembalian');
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

    public function getDataPengembalian(){
        return $this->db->table('pengembalian')
            ->join('anggota','anggota.id_anggota = pengembalian.id_anggota')
            ->join('buku','buku.id_buku = pengembalian.id_buku')
            ->get()->getResultArray();
    }
    public function getPengembalianDetail($id_pinjam){
        return $this->db->table('pengembalian')->where(['id_pinjam'=>$id_pinjam])
            ->join('anggota','anggota.id_anggota = pengembalian.id_anggota')
            ->join('buku','buku.id_buku = pengembalian.id_buku')
            ->get()->getResultArray();
    }
}

?>