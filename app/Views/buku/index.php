<?= $this->extend('layouts/template'); ?>

<?= $this->section('content'); ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="container-buku">

            <!-- isi dari container buku -->

            </div>
    </div>
    </div>
</div>

<div class="modalView"></div>

<script>
    // script untuk tampilkan buku dengan ajax
    function dataBuku(){
        $.ajax({
            url:"<?= site_url('buku/dataBuku'); ?>",
            dataType:"json",
            success:function(response){
                $('.container-buku').html(response.sukses);
            },
            error:function(xhr, ajaxOptions, throwError){
                alert(xhr.status + "\n" + xhr.responseText + "\n" + throwError);
            }
        });
    }
    $(document).ready(function(){
        dataBuku();
    });

    // script sweet alert
    $(function(){
        <?php if(session()->has("pesan")) { ?>
            Swal.fire({
                icon: 'success',
                title: 'Done!',
                text: '<?= session("pesan") ?>'
            })
        <?php } ?>
        });

</script>
<!-- /.content-wrapper -->
<?= $this->endSection('content'); ?>






