<table class="table" id="tablePengembalian">
  <thead style="text-align:center ;">
    <tr>
      <th scope="col">No.</th>
      <th scope="col">Id Peminjaman</th>
      <th scope="col">Id Anggota</th>
      <th scope="col">Id Buku</th>
      <th scope="col">Tanggal Pinjam</th>
      <th scope="col">Tanggal Kembali</th>
      <th scope="col">Dikembalikan Pada</th>
      <th scope="col">Aksi</th>
    </tr>
  </thead>
  <tbody style="text-align:center ;">
    <?php $no = 1; ?>
    <?php foreach($pengembalian as $key => $value): ?>
        <tr>
            <th scope="row"><?= $no++; ?></th>
            <td><?= $value['id_pinjam']; ?></td>
            <td><?= $value['id_anggota']; ?></td>
            <td><?= $value['id_buku']; ?></td>
            <td><?= $value['tanggal_pinjam']; ?></td>
            <td><?= $value['tanggal_kembali']; ?></td>
            <td><?= $value['dikembalikan_pada']; ?></td>
            <td><button class="btn btn-info" onclick="detail('<?= $value['id_pinjam']; ?>')">Detail</button></td>
        </tr>
    <?php endforeach; ?>
    <tr>
  </tbody>
</table>

<script>
      $(document).ready(function(){
        $('#tablePengembalian').DataTable({
            lengthMenu:[[5,10,25,50,-1],[5,10,25,50,"All"]]
        })
      });

      function detail(id_pinjam){
        $.ajax({
            url:'<?= site_url('kembali/detail'); ?>',
            data:{data_id : id_pinjam},
            dataType:'json',
            success:function(response){
                if(response.sukses){
                    $('.modalView').html(response.sukses).show();
                    $('#modalDetail').modal('show');
                }
            },
            error:function(xhr, ajaxOptions, throwError){
                alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
            }
        })
    }
</script>