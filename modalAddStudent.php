<!-- Modal voor het toevoegen van een student 
 Eerste div id moet gelijk zijn aan de data-target hashtag -->
<div id="ModalAddStudent" class="modal">
    <div class="modal-header">
        <h5>Add Student</h5>
    </div>
    <div class="modal-content">

        <form method="POST">
            <label>Student naam:</label>
            <input type="text" class="form-control" style="border-radius: 0;" name="student_naam" placeholder="Naam" required>
            <br>
            <label>Student e-mailadres:</label>
            <input type="text" class="form-control" style="border-radius: 0;" name="student_email" placeholder="Emailadres" required>
            <input type="submit" name="NewStudentSubmit" class="btn btn-success" value="Versturen" style="border-radius: 0;">
        </form>
        
        <?php
        if (isset($_POST['NewStudentSubmit'])) {
            if (!empty($_POST['student_naam'] && $_POST['student_email'])) {
                $student_name = $_POST['student_naam'];
                $student_email = $_POST['student_email'];
                $current_date = date('Y');
                $add_student_sql = "INSERT INTO student (student_naam, student_emailadres, student_jaar) VALUES ('" . $student_name . "', '" . $student_email . "', '" . $current_date . "')";
                if ($conn->query($add_student_sql) === TRUE) {
                    echo "Student is toegevoegd";
                } else {
                    echo "FOUTMELDING! Probeer opnieuw";
                }
            }
        }
        ?>
        
    </div>
</div>
