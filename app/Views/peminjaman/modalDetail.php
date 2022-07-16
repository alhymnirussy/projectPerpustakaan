<div class="modal" tabindex="-1" id="modalDetail">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Detail Peminjaman</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
          <?php foreach($detail as $key => $value): ?>
          <div class="row">
            <div class="col-sm-6">
              <div class="card">
                <div class="card-header">
                  <b>Detail Anggota</b>
                </div>
                <div class="card-body">
                  <p class="card-text"><small><b>Id Anggota : </b><?= $value['id_anggota']; ?></small></p>
                  <p class="card-text"><small><b>Nama Anggota : </b><?= $value['nama_anggota']; ?></small></p>
                  <p class="card-text"><small><b>Jenis Kelamin : </b><?= $value['jenis_kelamin']; ?></small></p>
                  <p class="card-text"><small><b>No Telp : </b><?= $value['no_telp']; ?></small></p>
                  <p class="card-text"><small><b>Alamat : </b><?= $value['alamat']; ?></small></p>
                </div>
              </div>
            </div>
            <div class="col-sm-6">
              <div class="card">
                <div class="card-header">
                  <b>Detail Buku</b>
                </div>
                <div class="card-body">
                  <p class="card-text"><small><b>Id Buku : </b><?= $value['id_buku']; ?></small></p>
                  <p class="card-text"><small><b>Judul Buku : </b><?= $value['judul_buku']; ?></small></p>
                  <p class="card-text"><small><b>Kategori : </b><?= $value['kategori']; ?></small></p>
                  <p class="card-text"><small><b>Pengarang : </b><?= $value['pengarang']; ?></small></p>
                  <p class="card-text"><small><b>Penerbit : </b><?= $value['penerbit']; ?></small></p>
                </div>
              </div>
            </div>
            <div class="col">
              <div class="card">
                <div class="card-header">
                  <b>Detail Peminjaman</b>
                </div>
                <div class="card-body">
                  <div class="table-responsive">
                    <table class="table">
                      <thead style="text-align:center;">
                        <tr>
                          <th scope="col">Id Peminjaman</th>
                          <th scope="col">Tanggal Pinjam</th>
                          <th scope="col">Tanggal Kembali</th>
                          <th scope="col">Status Pengembalian</th>
                          <th scope="col">Status Denda</th>
                        </tr>
                      </thead>
                      <tbody style="text-align:center;">
                        <tr>
                          <td><?= $value['id_pinjam']; ?></td>
                          <td><?= $value['tanggal_pinjam']; ?></td>
                          <td><?= $value['tanggal_kembali']; ?></td>
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
                              <?php 
                                if($totalHari >= 0 ){?>
                                  <button type="button" class="btn btn-success"><?php echo "Free"; ?></button>
                              <?php }  
                                elseif($totalHari < -30){?>
                                  <button type="button" class="btn btn-warning"><?php echo "Rp. 60.000"; ?></button>
                              <?php } 
                                else{?>
                                  <button type="button" class="btn btn-danger"><?php echo "Rp.". abs($totalHari) * ($denda); ?></button>
                              <?php } ?>
                          </td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
          </div>
        </div>
          <?php endforeach; ?>
      </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-info d-inline" onclick="confirm('<?= $value['id_pinjam']; ?>','<?= $totalHari; ?>','<?= $denda; ?>')"><i class="bi bi-check-square-fill m-2"></i>Konfirmasi Pengembalian</button>
        <!-- <button type="button" class="btn btn-warning d-inline" onclick="edit('<?= $value['id_pinjam']; ?>')"><i class="bi bi-pen-fill me-2"></i>Edit Peminjaman</button> -->
        <button type="button" class="btn btn-danger d-inline" onclick="hapus('<?= $value['id_pinjam']; ?>')"><i class="bi bi-trash3-fill me-2"></i>Hapus Peminjaman</button>
        <button type="button" class="btn btn-secondary d-inline" data-bs-dismiss="modal">Close</button>
      </div>
        </div>
    </div>
</div>

<script>
  function edit(id_pinjam){
    $.ajax({
      url:'<?= site_url('pinjam/edit'); ?>',
      data:{data_id:id_pinjam},
      dataType:'json',
      success:function(response){
        if(response.sukses){
          $('#modalDetail').modal('hide');
          $('.modalView').html(response.sukses).show();
          $('#modalEdit').modal('show');
        }
      },
      error:function(xhr, ajaxOptions, throwError){
        alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
      }
    })
  }

  function hapus(id_pinjam){
    Swal.fire({
            title: 'Are you sure?',
            text: "Yakin ingin menghapus data dengan id : " + id_pinjam + " ?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if(result.isConfirmed) {
                $.ajax({
                    url:"<?= site_url('pinjam/hapus'); ?>",
                    method:'post',
                    dataType:'json',
                    data:{data_id : id_pinjam},
                    success:function(response){
                        if(response.sukses){
                            Swal.fire({
                                icon:'success',
                                title:'Done',
                                text:response.sukses
                            })
                        }
                    $('#modalDetail').modal('hide');
                    dataPeminjaman();
                    },
                    error:function(xhr, ajaxOptions, throwError){
                        alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
                    }
                })
            }
        })
  }

  function confirm(id_pinjam,total_hari,denda){
    Swal.fire({
            title:'Confirm',
            icon: 'warning',
            text: "Konfirmasi Pengembalian dengan id : " + id_pinjam + "? ",
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'OKE'
        }).then((result) => {
            if(result.isConfirmed) {
                $.ajax({
                    url:"<?= site_url('kembali/tambah'); ?>",
                    method:'post',
                    dataType:'json',
                    data:{data_id : id_pinjam, data_hari:total_hari, data_denda:denda},
                    success:function(response){
                        if(response.sukses){
                            Swal.fire({
                                icon:'success',
                                title:'Done',
                                text:response.sukses
                            })
                            $('#modalDetail').modal('hide');
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
</script>

