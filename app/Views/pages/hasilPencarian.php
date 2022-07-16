<div class="row mt-2">
    <?php foreach($buku as $b): ?>
        <div class="col-md-2 mt-1">
            <div class="buku" style="width:100%;height:210px;">
                <img src="/img/<?= $b['cover']; ?>" alt="" style="height:100%; width:100%; border-radius:12px;box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
            </div>
            <div class="detailBuku text-center mt-2">
                <p><small><?= $b['judul_buku']; ?></small></p>
                <button type="button" class="btn btn-info" onclick="">detail</button>
            </div>
        </div>
    <?php endforeach; ?>
</div>