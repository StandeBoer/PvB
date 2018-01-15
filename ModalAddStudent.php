<div id="ModalAddStudent" class="modal">
    <div class="modal-header" style="padding-left: 24px;">
        <h5>Student toevoegen</h5>
    </div>
    <div class="modal-content">

        <form method="POST">

            <?php
            $error = '';
            $get_cohort = "SELECT * FROM cohort";
            $result_cohort = $conn->query($get_cohort);
            if ($result_cohort->num_rows > 0) {
                ?>
                <select name="cohort_option" required>
                    <option selected="selected" disabled>Kies een Cohort</option>
                    <?php
                    while ($row_cohort = $result_cohort->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row_cohort["cohort_id"] ?>"><?php echo $row_cohort["cohort_jaar"] ?></option>
                        <?php
                    }
                    ?>
                </select>
                <?php
            }
            ?>

            <select name="klas_option" class="hide">

            </select><br />
            <i class="material-icons prefix tiny">mode_edit</i><label>Naam student:</label>
            <input type="text" class="form-control" style="border-radius: 0;" name="student_naam" placeholder="Naam">
            <br><br><i class="material-icons prefix tiny">mode_edit</i>
            <label>E-mailadres:</label>
            <input type="text" class="form-control" style="border-radius: 0;" name="student_email" placeholder="Emailadres">
            <br>

            <input type="submit" name="NewStudentSubmit" class="btn btn-success" value="Versturen">
            <a href="#!" class="modal-action modal-close waves-effect waves-green btn btn-success ">Sluiten</a>

        </form>
    </div>
</div>
<?php
if (isset($_POST['NewStudentSubmit'])) {
    if (!empty($_POST['student_naam'] && $_POST['student_email'] && $_POST['klas_option'])) {
        //echo "gezet";   
        $student_name = $_POST['student_naam'];
        $student_email = $_POST['student_email'];
        $klas_option = $_POST['klas_option'];
        $add_student_sql = "INSERT INTO student (student_naam, student_emailadres, klas_id) VALUES ('" . $student_name . "', '" . $student_email . "','" . $klas_option . "')";
        if ($conn->query($add_student_sql) === TRUE) {
            echo "";
        } else {
            echo "FOUTMELDING! Probeer opnieuw";
        }
    }
}
?>