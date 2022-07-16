<div class="modal" tabindex="-1" id="modalBuku">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row">
        <?php foreach($buku as $b): ?>
            <div class="col-lg-2">
               <div class="buku" style="width:100%;height:180px;border:1px solid;">
                    <img src="/img/<?= $b['cover']; ?>" alt="" style="height:100%; width:100%;">
               </div>
               <div class="judul">
                    <p class="text-center"><small><?= $b['judul_buku']; ?></small></p>
                    <?= $b['cover']; ?>
               </div>
            </div>
        <?php endforeach; ?>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>