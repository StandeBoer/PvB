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

            <input type="submit" name="NewStudentSubmit" class="btn btn-success" value="Versturen">
            <input type="submit" name="sluiten" class="btn btn-success data-dismiss" value="Annuleren">

        </form>
        <!-- Hier nog de cohort en klas id's toevoegen!!!!!!!!!!!!! -->
        <?php
//        if (isset($_POST['NewStudentSubmit'])) {
//            if (!empty($_POST['student_naam'] && $_POST['student_email'])) {
//                $student_name = $_POST['student_naam'];
//                $student_email = $_POST['student_email'];
//                $cohort_option = $_POST['cohort_option'];
//                $klas_option = $_POST['klas_option'];
//                $add_student_sql = "INSERT INTO student (student_naam, student_emailadres, cohort_id, klas_id) VALUES ('" . $student_name . "', '" . $student_email . "', '" . $cohort_option . "', '" . $klas_option . "')";
//                if ($conn->query($add_student_sql) === TRUE) {
//                    echo "";
//                } else {
//                    echo "FOUTMELDING! Probeer opnieuw";
//                }
//            }
//        }
//        
//        
//        if (isset($_POST['NewStudentSubmit'])) {
////            echo 'hoi <br>';
//            if (isset($_POST['student_naam'])) {
////                echo 'kerntaak gezet <br>';
//                if (isset($_POST['werkproces_criterium_option'])) {
//                    $werkproces_id = $_POST['werkproces_criterium_option'];
////                    echo $r;
////                    echo 'werkproces gezet<br>';
//                    if (isset($_POST['criterium_oms'])) {
//                        $criterium_omschrijving = $_POST['criterium_oms'];
////                        echo $criterium_omschrijving;
//                        $add_criterium = "INSERT INTO werkproces_criterium (werkproces_criterium_naam, werkproces_id) VALUES ('" . $criterium_omschrijving . "','" . $werkproces_id . "')";
//                        if ($conn->query($add_criterium) === TRUE) {
////                            echo "Klas is toegevoegd";
//                        } else {
////                            echo "FOUTMELDING! Probeer opnieuw";
//                        }
//                    }
//                }
//            }
//        }
//        
        
        ?>


    </div>
</div>