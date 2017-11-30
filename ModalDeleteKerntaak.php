<div id="ModalDeleteKerntaak" class="modal">
    <div class="modal-header">
        <h5>Kerntaak toevoegen</h5>
    </div>
    <div class="modal-content">
        <form method="POST">
            Wilt u deze kerntaak echt verwijderen?<br><br>
            <input type="submit" name="Kerntaak_delete" class="btn btn-success" value="Ja">
            <input type="submit" name="sluiten" class="btn btn-success data-dismiss" value="Nee" align="right;">
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