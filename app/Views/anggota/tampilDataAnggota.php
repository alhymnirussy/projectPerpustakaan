<?= form_open('anggota/hapusBanyak', ['class'=>'formDelete']); ?>
<div class="button mb-2">
    <button type="button" class="btn btn-info d-inline" onclick="tambah()"><i class="bi bi-plus-square me-2"></i>Tambah</button>
    <button type="submit" class="btn btn-danger hapusBanyak d-inline"><i class="bi bi-trash3-fill me-2"></i>Selected Delete</button>
</div>
<table id="example" class="table" style="width:100%">
        <thead class="text-center">
            <tr>
                <th><input type="checkbox" id="cekAll"></th>
                <th>No.</th>
                <th>Id Anggota</th>
                <th>Nama Anggota</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php $no=1; ?>
            <?php foreach($anggota as $agt): ?>
            <tr class="align-middle">
                <td><input type="checkbox" name="id_anggota[]" class="cek" value="<?= $agt['id_anggota']; ?>"></td>
                <td><?= $no++; ?></td>
                <td><?= $agt['id_anggota']; ?></td>
                <td><?= $agt['nama_anggota']; ?></td>
                <td>
                    <button type="button" class="btn btn-danger d-inline" onclick="detail('<?= $agt['id_anggota']; ?>')"><i class="bi bi-ticket-fill"></i></button>
                    <button type="button" class="btn btn-warning d-inline" onclick="edit('<?= $agt['id_anggota']; ?>')"><i class="bi bi-pen-fill"></i></button>
                    <button type="button" class="btn btn-danger d-inline" onclick="hapus('<?= $agt['id_anggota']; ?>')"><i class="bi bi-trash-fill"></i></button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?= form_close(); ?>

    <script>
        $(document).ready(function(){
            // script untuk datatables
            $('#example').DataTable({
                lengthMenu:[[5,10,25,50,-1],[5,10,25,50,"All"]]
            });

            $('#cekAll').click(function(e){
                if($(this).is(':checked')){
                    $('.cek').prop('checked',true);
                }
                else{
                    $('.cek').prop('checked',false);
                }
            });
            $('.formDelete').submit(function(e){
                e.preventDefault();

                let jumlahChecked = $('.cek:checked');

                if(jumlahChecked.length === 0){
                    Swal.fire({
                        icon:"error",
                        title:"warning",
                        text: "Please check at least 1 item to use this button!!!",
                    });
                }else{
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
                                            dataAnggota();
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
        });

    // button edit
    function edit(id_anggota){
        $.ajax({
            url:"<?= site_url('anggota/edit'); ?>",
            method:'post',
            data:{data_id : id_anggota},
            dataType:'json',
            success:function(response){
                if(response.sukses){
                    $('.modalView').html(response.sukses).show();
                    $('#modalEdit').modal('show');
                }
            },
            error:function(xhr, ajaxOptions, throwError){
                alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
            }
        })
    }
    // button delete

    function hapus(id_anggota){
        Swal.fire({
            title: 'Are you sure?',
            text: "Yakin ingin menghapus data dengan id : " + id_anggota + " ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if(result.isConfirmed) {
                $.ajax({
                    url:"<?= site_url('anggota/hapus'); ?>",
                    method:'post',
                    dataType:'json',
                    data:{data_id : id_anggota},
                    success:function(response){
                        if(response.sukses){
                            Swal.fire({
                                icon:'success',
                                title:'Done',
                                text:response.sukses
                            })
                        }
                    dataAnggota();
                    },
                    error:function(xhr, ajaxOptions, throwError){
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                    }

                })
            }
        })
    }

    function detail(id_anggota){
        $.ajax({
            url:'<?= site_url('anggota/detail'); ?>',
            method:'post',
            dataType:'json',
            data:{data_id:id_anggota},
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
