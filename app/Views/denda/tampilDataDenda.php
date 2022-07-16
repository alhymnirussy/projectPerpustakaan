<div class="row">
    <div class="col-lg-3 col-6">
        <div class="small-box bg-info">
            <div class="inner">
                <h3><?= "Rp. " .$totalDenda; ?></h3>
                <p>Total Denda yang Dibayarkan</p>
            </div>
            <div class="icon">
                <i class="bi bi-cash"></i>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col">
        <table class="table">
            <thead style="text-align:center;">
                <tr>
                <th scope="col">No.</th>
                <th scope="col">Besar Denda (Rp.)</th>
                <th scope="col">Status</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody style="text-align:center ;">
                <?php $no = 1; ?>
                <?php foreach($denda as $d): ?>
                <tr>
                <th scope="row"><?= $no++; ?></th>
                <td><?= $d['besar_denda']; ?></td>
                <td><button type="button" class="btn btn-success">Aktif</button></td>
                <td><button class="btn btn-warning" onclick="edit('<?= $d['id_denda']; ?>')">Edit</button></td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<script>
    function edit(id_denda){
        $.ajax({
            url:"<?= site_url('denda/edit'); ?>",
            data:{data_id:id_denda},
            dataType:'json',
            method:'post',
            success:function(response){
                if(response.sukses){
                    $('.modalView').html(response.sukses).show();
                    $('#modalEdit').modal('show');
                }
            },
            error:function(xhr,ajaxOptions,throwError){
                alert(xhr.status + "\n" + xhr.response.Text + "\n" + throwError);
            }
        })
    }
</script>