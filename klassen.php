<?php
include("check.php");
include("connect.php");
?>
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
        include("navbar.php");
        include("modalAddKlas.php");
        include("modalAddCohort.php");
        ?>
        <div class="row" style="margin-bottom: auto;">
            <div class="col s12 m4 l3" style="background-color: gray; height: 100%;">
                <button data-target="ModalAddCohort" class="btn modal-trigger" style="min-width: 200px;">Add Cohort</button>

                <?php
                $error = '';
                $get_cohort = "SELECT * FROM cohort";
                $result_cohort = $conn->query($get_cohort);
                if ($result_cohort->num_rows > 0) {
                    ?>
                    <select name="selected_cohort" required>
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
            </div>
            <div class="col s12 m8 l9">
                <h4>Overzicht klassen <a data-target="ModalAddKlas" class="btn-floating btn-small waves-effect waves-light green btn modal-trigger"><i class="material-icons" >add</i></a></h4>
                <ul id="show_klas" class="hide">
                    <h6>Voor het geselecteerde cohort zijn de volgende klassen aangemaakt:</h6>
                    <li></li>
                </ul>
            </div>
        </div>
        <!--EINDE CODE VOOR KLAS TOEVOEGEN BACKEND -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
        <script type="text/javascript">
            $(document).ready(function () {
                // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
                $(".modal-trigger").leanModal();
                $("select").material_select();
                $(".button-collapse").sideNav();

                $("select[name=selected_cohort]").on('change', function () {

                    cohort_id = this.value;
                    //alert(cohort_id);

                    // ophalen van informatie, met ajax
                    $.ajax({
                        type: 'GET',
                        url: 'json_show_klas.php',
                        data: {id: cohort_id},
                        dataType: 'json',
                        success: function (data) {
                            //alert(data);
                            $.each(data, function (index, element) {
                                console.log(element.name);
                                $('#show_klas').append($('<li>', {
                                    value: element.id,
                                    text: element.name
                                }));
                                $("#show_klas").removeClass("hide");
                            });

                        }
                    });

                });
            });
        </script>
    </body>
</html>
