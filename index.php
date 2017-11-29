<html>
    <head>
        <meta charset="UTF-8">
        <title>MiniProeve</title>
        <link type="text/css" rel="stylesheet" href="stylesheet.css">
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link type="text/css" rel="stylesheet" media="screen,projection" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css" />
    </head>
    <body> 
        <?php
        include("check.php");
        include("connect.php");
        include("navbar.php");
        include("ModalAddStudent.php");
        include("ModalAddKerntaak.php");
        include("ModalAddWerkproces.php");
        include("ModalAddCriterium.php");
        include("ModalAddCohort.php");
        include("ModalAddKlas.php");
        ?>
        <div class="row">
            <div class="col s12 m4 l3" style="background-color: gray; height: 100%;">
                <h2 style="text-align: center;">Welkom</h2>
                <?php
                $get_name = "SELECT user_first_name, user_last_name FROM users WHERE user_emailadres = '" . $_SESSION['email'] . "'";
                $result_get_name = $conn->query($get_name);
                if ($result_get_name->num_rows > 0) {
                    while ($row_get_name = $result_get_name->fetch_assoc()) {
                        ?>
                        <h4 style="text-align: center;"><?php echo $row_get_name['user_first_name'] . ' ' . $row_get_name['user_last_name']; ?></h4>    
                        <?php
                    }
                } else {
                    echo 'Not logged in';
                }
                ?>
                <!--         Button voor de modal voor het toevoegen van een student -->
                <ul class="collection">
                    <li class="collection-item"><button data-target="ModalAddStudent" class="btn modal-trigger">Add Student</button></li>
                    <li class="collection-item"><button data-target="ModalAddKerntaak" class="btn modal-trigger">Add Kerntaak</button></li>
                    <li class="collection-item"><button data-target="ModalAddWerkproces" class="btn modal-trigger">Add Werkproces</button></li>
                    <li class="collection-item"><button data-target="ModalAddCriterium" class="btn modal-trigger">Add Criterium</button></li>
                    <li class="collection-item"><button data-target="ModalAddCohort" class="btn modal-trigger">Add Cohort</button></li>
                    <li class="collection-item"><button data-target="ModalAddKlas" class="btn modal-trigger">Add Klas</button></li>
                </ul>
            </div>
            <div class="col s12 m8 l9">
                Hallo
            </div>
        </div>
        <!--EINDE CODE VOOR KLAS TOEVOEGEN BACKEND -->
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                $('.modal-trigger').leanModal();
                $('select').material_select();
            });
        </script>
    </body>
</html>
