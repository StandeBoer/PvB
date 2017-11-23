<?php
include("check.php");
include("connect.php");
include("modalAddStudent.php");
include("navbar.php");
?>


<html>
    <head>
        <meta charset="UTF-8">
        <title>MiniProeve</title>
        <link type="text/css" rel="stylesheet" href="stylesheet.css">
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link type="text/css" rel="stylesheet" media="screen,projection" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css" />
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
    </head>

    <body> 
        <div class="sideMenu">
            <!--         Button voor de modal voor het toevoegen van een student -->
            <ul class="collection">
                <li class="collection-item"><button data-target="ModalAddStudent" class="btn modal-trigger">Add Student</button></li>
                <li class="collection-item"><button data-target="ModalAddStudent" class="btn modal-trigger">Add Student</button></li>
            </ul>
        </div>
        
                <!-- CODE VOOR COHORT TOEVOEGEN BACK-END -->
        <?php 
        $get_cohort = "SELECT * FROM cohort";
        $result_get_cohort = $conn->query($get_cohort);
        if ($result_get_cohort->num_rows > 0) {
            echo "Wij hebben de volgende jaren in het systeem staan:<br>";
            while ($row_get_cohort = $result_get_cohort->fetch_assoc()) {
                echo $row_get_cohort['cohort_jaar'] . '<br>';
            }
        } else {
            echo "<h4> Er zijn 0 resultaten</h4>";
        }
        ?>
        <form method="POST">
            <label>Cohort jaar:</label>
            <input type="text" class="form-control" style="border-radius: 0;" name="cohort_jaar" placeholder="Cohortjaar" required>
            <br>
            <input type="submit" name="new_cohort_submit" class="btn btn-success" value="Versturen" style="border-radius: 0;">
        </form>
        <?php 
        if (isset($_POST['new_cohort_submit'])){
            if (!empty($_POST['cohort_jaar'])){
                $cohort_jaar = $_POST['cohort_jaar'];
                $add_cohort_sql = "INSERT INTO cohort(cohort_jaar) VALUES ('" . $cohort_jaar . "')";
                echo "<meta http-equiv='refresh' content='0'>";
                if ($conn->query($add_cohort_sql) === TRUE) {
                    echo "Cohort is toegevoegd";
                } else {
                    echo "FOUTMELDING! Probeer opnieuw";
                }
            }
        }
        
        ?>
        <!--EINDE CODE VOOR COHORT TOEVOEGEN BACKEND -->
                <br><br><br>
                
                
                
        <!-- CODE VOOR KLAS TOEVOEGEN BACK-END -->
        <?php 
        $get_klas = "SELECT * FROM klas";
        $result_get_klas = $conn->query($get_klas);
        if ($result_get_klas->num_rows > 0) {
            echo "Wij hebben de volgende klassen in het systeem staan:<br>";
            while ($row_get_klas = $result_get_klas->fetch_assoc()) {
                echo $row_get_klas['klas_naam'] . '<br>';
            }
        } else {
            echo "<h4> Er zijn 0 klassen</h4>";
        }
        ?>
        <form method="POST">
            <label>Klas</label>
            <input type="text" class="form-control" style="border-radius: 0;" name="klas_naam" placeholder="Klas" required>
            <br>
            <input type="submit" name="new_klas_submit" class="btn btn-success" value="Versturen" style="border-radius: 0;">
        </form>
        <?php 
        if (isset($_POST['new_klas_submit'])){
            if (!empty($_POST['klas_naam'])){
                $klas = $_POST['klas_naam'];
                $add_klas_sql = "INSERT INTO klas(klas_naam) VALUES ('" . $klas . "')";
                echo "<meta http-equiv='refresh' content='0'>";
                if ($conn->query($add_klas_sql) === TRUE) {
                    echo "Klas is toegevoegd";
                    
                } else {
                    echo "FOUTMELDING! Probeer opnieuw";
                }
            }
        }
        
        ?>
        <!--EINDE CODE VOOR KLAS TOEVOEGEN BACKEND -->
        
        
        
        <br><br>
        <!-- CODE VOOR STUDENT TOEVOEGEN BACK-END -->
        <form method="POST">
            <label>Student naam:</label>
            <input type="text" class="form-control" style="border-radius: 0;" name="student_naam" placeholder="Naam" required>
            <br>
            <label>Student e-mailadres:</label>
            <input type="text" class="form-control" style="border-radius: 0;" name="student_email" placeholder="Emailadres" required>
            <input type="submit" name="new_student_submit" class="btn btn-success" value="Versturen" style="border-radius: 0;">
        </form>
        <?php
        if (isset($_POST['new_student_submit'])) {
            if (!empty($_POST['student_naam'] && $_POST['student_email'])) {
                $student_name = $_POST['student_naam'];
                $student_email = $_POST['student_email'];
                $current_date = date('Y');
                $add_student_sql = "INSERT INTO student (student_naam, student_emailadres, student_jaar) VALUES ('" . $student_name . "', '" . $student_email . "', '" . $current_date . "')";
                echo "<meta http-equiv='refresh' content='0'>";
                if ($conn->query($add_student_sql) === TRUE) {
                    echo "Student is toegevoegd";
                } else {
                    echo "FOUTMELDING! Probeer opnieuw";
                }
            }
        }
        ?>
        <!--EINDE CODE VOOR STUDENT TOEVOEGEN BACKEND -->
        <br><br><br>
        <!-- CODE VOOR STUDENT TOEVOEGEN BACK-END -->
        <form method="POST">
            <label>Om een kerntaak toe te voegen dient u hieronder de naam van de kerntaak aan te geven:</label>
            <input type="text" class="form-control" style="border-radius: 0;" name="kerntaak_naam" placeholder="Kerntaak naam" required>
            <input type="submit" name="new_kerntaak_submit" class="btn btn-success" value="Versturen" style="border-radius: 0;">
        </form>
        <?php
        if (isset($_POST['new_kerntaak_submit'])) {
            if (!empty($_POST['kerntaak_naam'])) {
                $kerntaak_name = $_POST['kerntaak_naam'];
                $add_kerntaak_sql = "INSERT INTO kerntaak(kerntaak_naam) VALUES ('" . $kerntaak_name . "')";
                echo "<meta http-equiv='refresh' content='0'>";
                if ($conn->query($add_kerntaak_sql) === TRUE) {
                    echo "Kerntaak is toegevoegd";
                } else {
                    echo "FOUTMELDING! Probeer opnieuw";
                }
            }
        }
        ?>
        <!--EINDE CODE VOOR KERNTAAK TOEVOEGEN BACKEND -->
        <br><br><br>
        <!--START CODE VOOR WERKPROCES TOEVOEGEN BACKEND + KOPPELING NAAR KERNTAAK TOE -->
        <form method="POST">
            <label>Om een werkproces toe te voegen selecteerd u eerst de kerntaak en daarna vult u het werkproces in:</label>
            <br>
        <?php
        $error = '';
        $get_kerntaak = "SELECT * FROM kerntaak";
        $result_kerntaak = $conn->query($get_kerntaak);
        if ($result_kerntaak->num_rows > 0) {
            ?>
            <select name="kerntaak_option" required>
                <option selected="selected" disabled>Kies een kerntaak</option>
            <?php
            while ($row_kerntaak = $result_kerntaak->fetch_assoc()) {
                ?>
                <option value="<?php echo $row_kerntaak["kerntaak_id"]?>"><?php echo $row_kerntaak["kerntaak_naam"]?></option>
                <?php  
            }
            ?>
            </select>
        <?php
        }
        ?>
            <br><br>
            <input type="text" class="form-control" style="border-radius: 0;" name="werkproces_naam" placeholder="Werkproces naam" required>
            <input type="submit" name="new_werkproces_naam" class="btn btn-success" value="Versturen" style="border-radius: 0;">
        </form>
        <?php
        if (isset($_POST['new_werkproces_naam'])){
            if (isset($_POST['kerntaak_option'])){
                if (isset($_POST['werkproces_naam'])){
                    $kerntaak_id = $_POST['kerntaak_option'];
                    $werkproces_naam = $_POST['werkproces_naam'];
                    $add_werkproces_sql = "INSERT INTO werkproces(werkproces_naam, kerntaak_id) VALUES ('" . $werkproces_naam . "', '" . $kerntaak_id . "')"; 
                    echo "<meta http-equiv='refresh' content='0'>";
                    if ($conn->query($add_werkproces_sql) === TRUE) {
                        echo "Werkproces is toegevoegd";
                    } else {
                        echo "FOUTMELDING! Probeer opnieuw";
                    }
                }
            }  else {
            $error = 'Foutmelding, selecteer een kerntaak';
            }
        }
        
        if (!empty($error)){
            echo $error;
        }
        ?>       
        <!--EINDE CODE VOOR WERKPROCES TOEVOEGEN BACKEND + KOPPELING NAAR KERNTAAK TOE -->

        <script type="text/javascript">
            $(document).ready(function () {
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                $('.modal-trigger').leanModal();
            });
        </script>
    </body>
</html>
