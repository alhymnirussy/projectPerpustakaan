<table class="table">
    <thead style="text-align:center;">
        <tr>
            <th scope="col">Id_Anggota</th>
            <th scope="col">Nama Anggota</th>
            <th scope="col">Jenis Kelamin</th>
            <th scope="col">No Telp</th>
            <th scope="col">Alamat</th>
            <th scope="col"><button button="button" class="btn btn-primary add" id="add" onclick="tambahId()"><i class="bi bi-plus-lg"></i></button></td>
        </tr>
    </thead>
    <tbody class="isiTable">

    </tbody>
</table>

<script>

function tambahId(){
    $.ajax({
        url:'<?= site_url('anggota/tambahId') ?>',
        dataType:'json',
        success:function(response){
            if(response.sukses){
                $('.isiTable').append(`
                <tr>
                    <td><input type="text" class="form-control" name="id_anggota[]" id="id_anggota" value="1"></td>
                    <td><input type="text" class="form-control" name="nama_anggota[]" id="nama_anggota"></td>
                    <td><input type="text" class="form-control" name="jenis_kelamin[]" id="jenis_kelamin"></td>
                    <td><input type="text" class="form-control" name="no_telp[]" id="no_telp"></td>
                    <td><input type="text" class="form-control" name="alamat[]" id="alamat"></td>
                    <td><button class="btn btn-danger hapus"><i class="bi bi-trash-fill"></i></button></td>
                </tr>
            `)
            }
        },
        error:function(xhr, ajaxOptions, throwError){
                alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
            }
        
    })
}




</script>

