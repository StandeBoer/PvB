<html>
    <head>
        <meta charset="UTF-8">
        <title>MiniProeve</title>
        <link type="text/css" rel="stylesheet" media="screen,projection" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css" />
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link type="text/css" rel="stylesheet" href="stylesheet.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
    </head>

    <body>
        <?php
        include("check.php");
        include("connect.php");
        include("navbar.php");
        ?>
        <div class="row" style="margin-bottom: auto; z-index: 999;">

            <form method="POST">
                <div class="col s12 m3 l2">

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
                                <option value="<?php echo $row_kerntaak["kerntaak_id"] ?>"><?php echo $row_kerntaak["kerntaak_naam"] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <?php
                    }
                    ?>
                </div>
                <div class="col s12 m3 l2">

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
                </div>
                <div class="col s12 m3 l2">

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
                </div>
                <div class="col s12 m3 l2">

                    <?php
                    $error = '';
                    $get_student = "SELECT * FROM student";
                    $result_student = $conn->query($get_student);
                    if ($result_student->num_rows > 0) {
                        ?>
                        <select name="student_option" required>
                            <option selected="selected" disabled>Kies een Student</option>
                            <?php
                            while ($row_student = $result_student->fetch_assoc()) {
                                ?>
                                <option value="<?php echo $row_student["student_naam"] ?>"><?php echo $row_student["student_naam"] ?></option>
                                <?php
                            }
                            ?>
                        </select>
                        <?php
                    }
                    ?>
                </div>
                <div class="col s12 m6 l4">
                    <input type="submit" name="new_werkproces_naam" class="btn btn-success" value="Versturen" style="border-radius: 10;">
                    <input type="submit" name="sluiten" class="btn btn-success data-dismiss" value="Annuleren">
                </div>
            </form>

        </div>

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