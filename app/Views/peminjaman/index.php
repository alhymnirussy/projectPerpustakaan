
<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="containerPeminjaman">
            
        </div>
         <!-- Small boxes (Stat box) -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
</div>

<div class="modalView" style="display:none;">

</div>

<script>

    function dataPeminjaman(){
        $.ajax({
            url:'<?= site_url('pinjam/dataPeminjaman'); ?>',
            dataType:'json',
            success:function(response){
                if(response.sukses){
                    $('.containerPeminjaman').html(response.sukses)
                }
            },
            error:function(xhr, ajaxOptions, throwError){
                alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
            }
        })
    }
     $(document).ready(function(){
        dataPeminjaman();
    });

</script>



<?= $this->endSection('content'); ?>