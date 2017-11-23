<?php
include("check.php");
include("connect.php");
include("modalAddStudent.php");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="stylesheet.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <title>MiniProeve</title>
    </head>
    <body> 
        <!--         Button om uit te loggen -->
        <button><a href="logout.php" style="font-size:18px">Uitloggen</a></button>
        <br><br><br>
        <!-- CODE VOOR STUDENT TOEVOEGEN BACK-END -->
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
        <!--EINDE CODE VOOR STUDENT TOEVOEGEN BACKEND -->
        <br><br><br>
        <!-- CODE VOOR STUDENT TOEVOEGEN BACK-END -->
        <form method="POST">
            <label>Om een kerntaak toe te voegen dient u hieronder de naam van de kerntaak aan te geven:</label>
            <input type="text" class="form-control" style="border-radius: 0;" name="kerntaak_naam" placeholder="Kerntaak naam" required>
            <input type="submit" name="NewKerntaakSubmit" class="btn btn-success" value="Versturen" style="border-radius: 0;">
        </form>
        <?php
        if (isset($_POST['NewKerntaakSubmit'])) {
            if (!empty($_POST['kerntaak_naam'])) {
                $kerntaak_name = $_POST['kerntaak_naam'];
                $add_kerntaak = "INSERT INTO kerntaak(kerntaak_naam) VALUES ('" . $kerntaak_name . "')";
                if ($conn->query($add_kerntaak) === TRUE) {
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
        </form>
        <?php
        $get_kerntaak = "SELECT * FROM kerntaak";
        $result_kerntaak = $conn->query($get_kerntaak);
        if ($result_kerntaak->num_rows > 0) {
            ?>
            <select>
            <?php
            while ($row = $result_kerntaak->fetch_assoc()) {
                ?>
                <option value=""><?php echo $row["kerntaak_naam"]?></option>
                <?php
                echo "Kerntaaknaam: " . $row["kerntaak_naam"] . "<br>";
            }
            ?>
            </select>
        <?php
        } else {
            echo "0 results";
        }
        ?>
        <!--EINDE CODE VOOR WERKPROCES TOEVOEGEN BACKEND + KOPPELING NAAR KERNTAAK TOE -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
<!--
<html>
    <head>
        <meta charset="UTF-8">
        <title>MiniProeve</title>
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link type="text/css" rel="stylesheet" media="screen,projection" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css" />
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
    </head>
    <body>
         Button voor de modal voor het toevoegen van een student 
        <button data-target="ModalAddStudent" class="btn modal-trigger">Add Student</button>

       

         Button om uit te loggen 
        <button><a href="logout.php" style="font-size:18px">Uitloggen</a></button>


        <script type="text/javascript">
            $(document).ready(function() {
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                $('.modal-trigger').leanModal();
            });
        </script>
    </body>
</html>-->
