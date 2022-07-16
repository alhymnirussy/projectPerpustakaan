<?= form_open('buku/hapusBanyak', ['class'=>'formDelete']); ?>
<button type="button" class="btn btn-info buttonTambah mb-2 d-inline" id="tambah" name="tambah"><i class="bi bi-plus-circle me-2"></i>Tambah</button>
<button type="submit" class="btn btn-danger hapusBanyak mb-2 d-inline"><i class="bi bi-trash3-fill me-2"></i>Selected Delete</button>
<div class="table">
<table id="tableBuku" class="table">
        <thead class="text-center">
            <tr>
                <th><input type="checkbox" name="cek" id="cekAll"></th>
                <th>No.</th>
                <th>Id Buku</th>
                <!-- <td>Cover</td> -->
                <th>Judul Buku</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody class="text-center">
            <?php $no=1; ?>
            <?php foreach($buku as $b): ?>
            <tr class="align-middle">
                <td><input type="checkbox" name="id_buku[]" class="cekId" value="<?= $b['id_buku']; ?>"></td>
                <td><?= $no++; ?></td>
                <td><?= $b['id_buku']; ?></td>
                <!-- <td><img src="/img/<?= $b['cover']; ?>" alt="" style="width: 100px; height:100px;"></td> -->
                <td><?= $b['judul_buku']; ?></td>
                <td>
                    <button type="button" class="d-inline btn btn-warning" onclick="detail('<?= $b['id_buku']; ?>')"><i class="bi bi-ticket-fill"></i></button>
                    <button type="button" class="d-inline btn btn-warning" onclick="edit('<?= $b['id_buku']; ?>')"><i class="bi bi-pen-fill"></i></button>
                    <button type="button" class="d-inline btn btn-danger" onclick="hapus('<?= $b['id_buku']; ?>')"><i class="bi bi-trash-fill"></i></button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>
<?php form_close(); ?>
<script>
    $(document).ready(function(){
        // script untuk datatables
        $('#tableBuku').DataTable({
            lengthMenu:[[5,10,25,50,-1],[5,10,25,50,"All"]]
        });

        $('#cekAll').click(function(e){
            if($(this).is(':checked')){
                $('.cekId').prop('checked',true)
            }
            else{
                $('.cekId').prop('checked',false)
            }
        })

        $('.buttonTambah').click(function(e){
            e.preventDefault();
            $.ajax({
                url:"<?= site_url('buku/tambah') ?>",
                dataType:"json",
                success:function(response){
                    $('.modalView').html(response.data).show();
                    $('#modalTambah').modal('show');
                },
                error:function(xhr,ajaxOptions,throwError){
                    alert(xhr.status + "\n" + xhr.response.Text + "\n" + throwError);
                }
            })
        });

        $('.formDelete').submit(function(e){
            e.preventDefault();

            let jumlahChecked = $('.cekId:checked')

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
                                dataBuku();
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

        // script untuk edit
        function edit(id_buku){
            $.ajax({
                type: 'post',
                url: "<?= site_url('buku/edit') ?>",
                data:{
                    id_buku : id_buku
                },
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
            });
        }

        // script hapus

        
        function hapus(id_buku){
            Swal.fire({
                title: 'Are you sure?',
                text: "Yakin ingin menghapus data dengan id : " + id_buku + " ?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if(result.isConfirmed) {
                    $.ajax({
                        url:"<?= site_url('buku/hapus'); ?>",
                        method:'post',
                        dataType:'json',
                        data:{data_id : id_buku},
                        success:function(response){
                            if(response.sukses){
                                Swal.fire({
                                    icon:'success',
                                    title:'Done',
                                    text:response.sukses
                                })
                            }
                        dataBuku();
                        },
                        error:function(xhr, ajaxOptions, throwError){
                            alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                        }

                    })
                }
            })

        }
        function detail(id_buku){
            $.ajax({
                url:'<?= site_url('buku/detail'); ?>',
                method:'post',
                dataType:'json',
                data:{data_id:id_buku},
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