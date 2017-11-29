<div id="ModalDeleteKerntaak" class="modal">
    <div class="modal-header">
        <h5>Kerntaak toevoegen</h5>
    </div>
    <div class="modal-content">
        <form method="POST">
            <input type="submit" name="Kerntaak_delete" class="btn btn-success" value="Verwijderen" style="border-radius: 0;">
            <input type="submit" name="sluiten" class="btn btn-success data-dismiss="modal" value="sluiten">
            
        </form>
        
         <script type="text/javascript">
               $(document).ready(function () {
     $('#modalClose').click(function (){
                window.setTimeout(function () {
                  $('#contact').modal('hide');
                }, 5000);
              });
          });
          </script>
    </div>
</div>