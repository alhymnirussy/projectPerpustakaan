<div class="col-sm-11">
    <div class="mt-4" style="width:75%;">
        <li style="display: block; margin-bottom:4px;">Id Buku : <?= $buku['id_buku']; ?></li>
        <li style="display: block; margin-bottom:4px;">Judul Buku : <?= $buku['judul_buku']; ?></li>
        <li style="display: block; margin-bottom:4px;">Penerbit : <?= $buku['penerbit']; ?></li>
        <li style="display: block; margin-bottom:4px;">Pengarang : <?= $buku['pengarang']; ?></li>
        <li style="display: block; margin-top:25px;">
            <?php $stokBuku = $buku['stok'] ;
            if($stokBuku != 0){?>
                <button tyoe="button" class="btn btn-info"><b>Stok : <?= $buku['stok']; ?></b></button>
             <?php } else{ ?>
                <button type="button" class="btn btn-danger">Stok :  <?= $buku['stok']; ?></button>
            <?php } ?>
        </li>
    </div>
</div>
<div class="col-sm-1">
    <div class="cover float-right" style="width:140px; height:180px;">
        <img src="/img/<?= $buku['cover']; ?>" alt="cover" style="width: 100%;height:100%; box-shadow: 10px 10px 5px #888888;">                            
    </div>      
</div>

