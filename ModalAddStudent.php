<div id="ModalAddStudent" class="modal">
    <div class="modal-header" style="padding-left: 24px;">
        <h5>Student toevoegen</h5>
    </div>
    <div class="modal-content">

        <form method="POST">
            <i class="material-icons prefix tiny">mode_edit</i><label>Naam student:</label>
            <input type="text" class="form-control" style="border-radius: 0;" name="student_naam" placeholder="Naam">
            <br><i class="material-icons prefix tiny">mode_edit</i>
            <label>E-mailadres:</label>
            <input type="text" class="form-control" style="border-radius: 0;" name="student_email" placeholder="Emailadres">

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
                        <option value="<?php echo $row_cohort["cohort_id"] ?>"><?php echo $row_cohort["cohort_id"] . ' - ' . $row_cohort["cohort_jaar"] ?></option>
                        <?php
                    }
                    ?>
                </select>
                <?php
            }
            ?>
            
            <?php
            $error = '';
            $get_klas = "SELECT * FROM klas";
            $result_klas = $conn->query($get_klas);
            if ($result_klas->num_rows > 0) {
                ?>
                <select name="klas_option" required>
                    <option selected="selected" disabled>Kies een Klas</option>
                    <?php
                    while ($row_klas = $result_klas->fetch_assoc()) {
                        ?>
                        <option value="<?php echo $row_klas["klas_id"] ?>"><?php echo $row_klas["klas_id"] . ' - ' . $row_klas["klas_naam"] ?></option>
                        <?php
                    }
                    ?>
                </select>
                <?php
            }
            ?>

            <input type="submit" name="NewStudentSubmit" class="btn btn-success" value="Versturen" style="border-radius: 0;">
            <input type="submit" name="sluiten" class="btn btn-success data-dismiss" value="Annuleren">


        </form>

        <!-- Hier nog de cohort en klas id's toevoegen!!!!!!!!!!!!! -->

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