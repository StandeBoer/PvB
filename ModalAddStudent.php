<div id="ModalAddStudent" class="modal">
<<<<<<< HEAD
    <div class="modal-header">
        <h5>Student toevoegen</h5>
=======
    <div class="modal-header" style="padding: 24px;">
        <h5>Add Student</h5>
>>>>>>> Jelmer
    </div>
    <div class="modal-content">

        <form method="POST">
            <label>Naam student:</label>
            <input type="text" class="form-control" style="border-radius: 0;" name="student_naam" placeholder="Naam">
            <br>
            <label>E-mailadres:</label>
            <input type="text" class="form-control" style="border-radius: 0;" name="student_email" placeholder="Emailadres">
            <input type="submit" name="NewStudentSubmit" class="btn btn-success" value="Versturen" style="border-radius: 0;">
            <input type="submit" name="sluiten" class="btn btn-success data-dismiss" value="Annuleren">
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
        <?php
        if (isset($_POST['NewStudentSubmit'])) {
            if (!empty($_POST['student_naam'] && $_POST['student_email'])) {
                $student_name = $_POST['student_naam'];
                $student_email = $_POST['student_email'];
                $add_student_sql = "INSERT INTO student (student_naam, student_emailadres) VALUES ('" . $student_name . "', '" . $student_email . "')";
                if ($conn->query($add_student_sql) === TRUE) {
                    echo "";
                } else {
                    echo "FOUTMELDING! Probeer opnieuw";
                }
            }
        }
        ?>
        
         
    </div>
</div>