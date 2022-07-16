<?php echo form_open('pinjam/hapusBanyak',['class'=>'formDelete']) ?>
<div class="fiturButton mb-2">
    <a href="/pinjam/cobaPinjam" class="btn btn-success"><i class="bi bi-plus-circle me-2"></i>Tambah Peminjaman</a>
    <!-- <button type="button" class="btn btn-success" onclick="tambah()">Tambah Peminjaman</button> -->
    <button type="submit" class="btn btn-danger"><i class="bi bi-trash-fill me-2"></i>Selected Delete</button>
</div>
<div class="tanggal">
    <p><?= date("l, d-m-y"); ?></p>
</div>
<table class=" table mt-2" id="tablePeminjam" style="width: 100%;">
    <thead style="text-align: center;">
        <tr>
            <th><input type="checkbox" id="checkAll"></th>
            <th scope="col">No.</th>
            <th scope="col">Id Peminjaman</th>
            <th scope="col">Id Anggota</th>
            <th scope="col">Id Buku</th>
            <th scope="col">Status Pengembalian</th>
            <th scope="col">Detail</th>
        </tr>
    </thead>
    <tbody style="text-align: center;">
        <?php $no = 1; ?>
        <?php foreach($peminjaman as $key => $value): ?>
            <?php
                $tggl_kembali = date_create($value['tanggal_kembali']);
                $tggl_pinjam = date_create($value['tanggal_pinjam']);
                $today = date_create(date('Y-m-d'));
                $diff1 = date_diff($tggl_pinjam,$tggl_kembali);
                $diff2 = date_diff($tggl_pinjam,$today);
                $hari1 = $diff1->format("%a");
                $hari2 = $diff2->format("%a");
                $totalHari = $hari1-$hari2;
            ?>
                <tr>
                    <th scope="row"><input type="checkbox" class="cekId" name="id_pinjam[]" value="<?= $value['id_pinjam']; ?>"></th>
                    <th scope="row"><?= $no++; ?></th>
                    <td scope="row"><?= $value['id_pinjam']; ?></td>
                    <td scope="row"><?= $value['id_anggota']; ?></td>
                    <td scope="row"><?= $value['id_buku']; ?></td>
                    <td>
                        <?php
                                    $tggl_kembali = date_create($value['tanggal_kembali']);
                                    $tggl_pinjam = date_create($value['tanggal_pinjam']);
                                    $today = date_create(date('Y-m-d'));

                                    $diff1 = date_diff($tggl_pinjam,$tggl_kembali);
                                    $diff2 = date_diff($tggl_pinjam,$today);

                                    $hari1 = $diff1->format("%a");
                                    $hari2 = $diff2->format("%a");

                                    $totalHari = $hari1-$hari2;

                                    if($totalHari > 0 ){
                                        echo $totalHari." hari lagi";
                                    }
                                    elseif($totalHari == 0){
                                        echo "Hari Ini";
                                    }
                                    else{
                                        echo "Terlambat ". abs($totalHari). " hari";
                                    }                  
                        ?>
                    </td>
                    <td>
                        <button type="button" class="btn btn-info"><i class="bi bi-ticket-detailed-fill" id="detail" onclick="detail('<?= $value['id_pinjam']; ?>')"></i></button>
                    </td>
                </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php echo form_close(); ?>

<script>
    $(document).ready(function(){
        $('#tablePeminjam').DataTable({
            lengthMenu:[[5,10,25,50,-1],[5,10,25,50,"All"]]
        })
        $('#checkAll').click(function(e){
            if($(this).is(':checked')){
                $('.cekId').prop('checked',true)
            }
            else{
                $('.cekId').prop('checked',false)
            }
        })

    $('.formDelete').submit(function(e){
        e.preventDefault();
        let jumlahChecked = $('.cekId:checked');

            if(jumlahChecked.length === 0){
                Swal.fire({
                        icon:"error",
                        title:"warning",
                        text: "Please check at least 1 item to use this button!!!",
                });
            }
            else{
                Swal.fire({
                    title: 'Are you sure?',
                    text: `Yakin ingin menghapus data berjumlah : ${jumlahChecked.length}`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: $(this).attr('action'),
                            method:'post',
                            dataType:'json',
                            data:$(this).serialize(),
                            success:function(response){
                            if(response.sukses){
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.sukses
                                })
                                dataPeminjaman();
                            }
                                    },
                            error:function(xhr, ajaxOptions, throwError){
                                alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                            }
                        })
                    }
                })
            }
            return false;          
    })
})
    function detail(id_pinjam){
        $.ajax({
            url:'<?= site_url('pinjam/detail'); ?>',
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
    function tambah(){
        $.ajax({
            url:'<?= site_url('pinjam/tambah'); ?>',
            method:'post',
            dataType:'json',
            success:function(response){
                if(response.sukses){
                    $('.modalView').html(response.sukses).show();
                    $('#modalTambah').modal('show');            
                }
            },
            error:function(xhr, ajaxOptions, throwError){
                alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
            }
        })
    }
</script>
