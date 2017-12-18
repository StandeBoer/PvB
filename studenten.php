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
        include("ModalAddStudent.php");
        include("ModalEditStudent.php");
        include("ModalDeleteStudent.php");
        ?>
        <div class="row" style="margin-bottom: auto;">
            <div class="col s12 m4 l3" style="background-color: gray; height: 100%;">
                <br>
                <?php
                $get_cohort = "SELECT * FROM cohort";
                $result_cohort = $conn->query($get_cohort);
                if ($result_cohort->num_rows > 0) {
                    ?>
                    <select name="selected_cohort" required>
                        <option selected="selected" disabled>Kies een cohort</option>
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
                <select name="selected_klas" class="hide">

                </select>
            </div>
            <div class="col s12 m8 l9">
                <h4>Overzicht studenten <a data-target="ModalAddStudent" class="btn-floating btn-small waves-effect waves-light green btn modal-trigger"><i class="material-icons" >add</i></a></h5>
                    <table id="show_student" class="hide">
                        <thead>
                            <tr>
                                <th>Studentnaam</th>
                                <th>Emailadres</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody name="tbody">

                        </tbody>
                    </table>
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

                //Student toevoegen modal klas afhankelijk van cohort
                $("select[name=cohort_option]").on('change', function () {
                    modal_cohort_id = this.value;
                    //alert(modal_cohort_id);

                    $("select[name=klas_option]").empty().append($('<option>', {
                        value: 0,
                        text: "Kies een klas",
                    }));

                    // ophalen van informatie, met ajax
                    $.ajax({
                        type: 'GET',
                        url: 'json_show_klas.php',
                        data: {id: modal_cohort_id},
                        dataType: 'json',
                        success: function (data) {
                            //console.log(data);
                            $.each(data, function (index, element) {
                                //console.log(element.klas_name);
                                $("select[name=klas_option]").append($('<option>', {
                                    value: element.klas_id,
                                    text: element.klas_name
                                }));
                            });
                            $("select[name=klas_option]").removeClass("hide");
                            $("select[name=klas_option]").material_select();
                        }
                    });

                });

                // Show klas sidemenu
                $("select[name=selected_cohort]").on('change', function () {
                    cohort_id = this.value;
                    //alert(cohort_id);

                    $("select[name=selected_klas]").empty().append($('<option>', {
                        value: 0,
                        text: "Kies een klas",
                    }));

                    // ophalen van informatie, met ajax
                    $.ajax({
                        type: 'GET',
                        url: 'json_show_klas.php',
                        data: {id: cohort_id},
                        dataType: 'json',
                        success: function (data) {
                            //alert(data);
                            $("select[name=selected_klas]").removeClass("hide");
                            $.each(data, function (index, element) {
                                //console.log(element.name);
                                $("select[name=selected_klas]").append($('<option>', {
                                    value: element.klas_id,
                                    text: element.klas_name
                                }));
                            });
                            $("select[name=selected_klas]").material_select();

                        }
                    });
                });

                // Show student table
                $("select[name=selected_klas]").on('change', function () {
                    klas_id = this.value;
                    //alert(klas_id);

                    $("tbody[name=tbody]").empty();

                    // ophalen van informatie, met ajax
                    $.ajax({
                    type: 'GET',
                            url: 'json_show_student.php',
                            data: {id: klas_id},
                            dataType: 'json',
                            success: function (data) {
                                //alert(data);
                                $.each(data, function (index, element) {
                                    $("#show_student").find('tbody')
                                            .append($('<tr>', {id: element.student_id}
                                            ).append($('<td>', {
                                                text: element.student_name},
                                            )).append($('<td>', {
                                                text: element.student_email},
                                            )).append($(
                                                    '<td><button data-target="ModalEditStudent" class="EditStudent btn-floating btn-large waves-effect waves-light yellow btn modal-trigger"><i class="material-icons" >edit</i></button>'
                                                    )).append($(
                                                    '<td><button data-target="ModalDeleteStudent" class="DeleteStudent btn-floating btn-large waves-effect waves-light red btn modal-trigger"><i class="material-icons">delete</i></button>'
                                                    ))

                                                    );
                                    $("#show_student").removeClass("hide");
                                    $(".modal-trigger").leanModal();
                                });

                                // Edit button
                                $(".EditStudent").on('click', function () {
                                    // waarde van het geselecteerde id ophalen
                                    id_student = $(this).parent().parent().attr('id');
                                    //console.log(id_student);

                                    // Velden leeg maken
                                    document.getElementById("student_id").value = "";
                                    document.getElementById("student_naam").value = "";
                                    document.getElementById("student_email").value = "";

                                    // ophalen van informatie, met ajax om naam/omschrijving kerntaak op te halen
                                    $.ajax({
                                        type: 'GET',
                                        url: 'json_edit_student.php',
                                        data: {id: id_student},
                                        dataType: 'json',
                                        success: function (data) {
                                            $("#student_id").val(data.id);
                                            $("#student_naam").val(data.name);
                                            $("#student_naam").removeClass("hide");
                                            $("#student_email").val(data.email);
                                            $("#student_email").removeClass("hide");
                                        },
                                        error: function () {
                                            console.log('error');
                                        }
                                    });
                                });

                                // DELETE BUTTON
                                $(".DeleteStudent").on('click', function () {
                                    // ophalen van het id
                                    var student_id = $(this).parent().parent().attr('id');
                                    console.log(student_id);
                                    // link aanpassen
                                    $("#delhref").attr("href", "delete_student.php?id=" + student_id);
                                });
                            }
                    });
                });

            });
        </script>
    </body>
</html>
