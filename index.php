<?php
include("check.php");
include("connect.php");
include("modalAddStudent.php");
include("ModalAddKerntaak.php");
include("ModalAddWerkproces.php");
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
                <li class="collection-item"><button data-target="ModalAddKerntaak" class="btn modal-trigger">Add Kerntaak</button></li>
                <li class="collection-item"><button data-target="ModalAddWerkproces" class="btn modal-trigger">Add Werkproces</button></li>
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
      
        <script type="text/javascript">
            $(document).ready(function () {
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                $('.modal-trigger').leanModal();
                $('select').material_select();
            });
        </script>
    </body>
</html>
