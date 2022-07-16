<?= form_open('denda/update',['class'=>'formEdit']); ?>
<div class="modal" tabindex="-1" id="modalEdit">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title"><?= $title; ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="row mb-3">
            <input type="hidden" name="id_denda" id="id_denda" value="<?= $denda['id_denda']; ?>">
            <label for="inputDenda" class="col-sm-4 col-form-label">Besar Denda (Rp.)</label>
            <div class="col-sm-8">
                <input type="text" class="form-control" id="inputDenda" name="denda" value="<?= $denda['besar_denda']; ?>" id="denda">
                <div class="invalid-feedback validasiDenda"></div>
            </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-success">Save changes</button>
      </div>
    </div>
  </div>
</div>
<?= form_close(); ?>

<script>
    $(document).ready(function(){
        $('.formEdit').submit(function(e){
            e.preventDefault();
            $.ajax({
                url:$(this).attr('action'),
                method:'post',
                data:$(this).serialize(),
                dataType:'json',
                success:function(response){
                    if(response.error){
                        if(response.error.denda){
                            $('#denda').addClass('invalid');
                            $('.validasiDenda').html(reponse.error.denda)
                        }else{
                            $('#denda').removeClass('invalid');
                            $('.validasiDenda').html('')
                        }
                    }else{
                        Swal.fire({
                            title:'Done',
                            icon:'success',
                            text:response.sukses
                        });
                        $('#modalEdit').modal('hide');
                        dataDenda();
                    }
                }
            })
        })
    })
</script>