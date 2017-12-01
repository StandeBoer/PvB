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
        include("modalAddStudent.php");
        include("ModalAddKerntaak.php");
        include("ModalAddWerkproces.php");
        include("ModalDeleteKerntaak.php");
        include("ModalEditKerntaak.php");
        ?>
        <div class="row" style="margin-bottom: auto;">
            <div class="col s12 m4 l3" style="background-color: gray; height: 100%;">
                <br>
                <a class='dropdown-button btn' href='#' data-activates='dropdown1'>Selecteer cohort</a>
                <ul id='dropdown1' class='dropdown-content'>
                    <li><a href="#!"></a></li>
                    <li> 2014</li>
                    <li> 2015</li>
                    <li> 2016</li>
                </ul><br><br>
            </div>
            <div class="col s12 m8 l9">
                <h4>Studenten <a data-target="ModalAddStudent" class="btn-floating btn-small waves-effect waves-light green btn modal-trigger"><i class="material-icons" >add</i></a></h5>
                <table>
                    <thead>
                        <tr>
                            <th>Kerntaak</th>
                            <th>Naam</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $get_student_inhoud = "SELECT * FROM student";
                        $result_get_student_inhoud = $conn->query($get_student_inhoud);
                        if ($result_get_student_inhoud->num_rows > 0) {
                            while ($row_get_student_inhoud = $result_get_student_inhoud->fetch_assoc()) {
                                ?>
                                <tr>
                                    <td><?php echo $row_get_student_inhoud['student_naam']; ?></td>
                                    <td><?php echo $row_get_student_inhoud['student_emailadres']; ?></td>
                                    <td><a data-target="ModalEditKerntaak" class="btn-floating btn-large waves-effect waves-light yellow btn modal-trigger"><i class="material-icons" >edit</i></a></td>
                                    <td><a data-target="ModalDeleteKerntaak" class="btn-floating btn-large waves-effect waves-light red btn modal-trigger"><i class="material-icons">delete</i></a></td>
                                <tr>
                                    <?php
                                }
                            } else {
                                echo '0 results';
                            }
                            ?>
                    </tbody>
            </div>
        </div>
        <!--EINDE CODE VOOR KLAS TOEVOEGEN BACKEND -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                $('.modal-trigger').leanModal();
                $('select').material_select();
                $(".button-collapse").sideNav();
            });
        </script>
    </body>
</html>
