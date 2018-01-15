<?php
include("check.php");
include("connect.php");
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>MiniProeve</title>
        <link type="text/css" rel="stylesheet" media="screen,projection" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css" />
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link type="text/css" rel="stylesheet" href="stylesheet.css">
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
        <style type="text/css">
            .sel {
                background-color: #0f9d58;
            }
        </style>
    </head>

    <body>
        <?php
        include("navbar.php");
        ?>
        <div class="row beoordeling">
            <form method="POST">
                <div name="cohort_beoordeling" class="col s12 m3 l3">
                    <?php
                    $get_cohort = "SELECT * FROM cohort";
                    $result_cohort = $conn->query($get_cohort);
                    if ($result_cohort->num_rows > 0) {
                        ?>
                        <select name="cohort_option_beoordeling" required>
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
                <div name="klas_beoordeling" class="col s12 m3 l3">
                    <select name="klas_option_beoordeling" class="">

                    </select>
                </div>
                <div name="student_beoordeling" class="col s12 m3 l3">
                    <select name="student_option_beoordeling" id="student_option_beoordeling" class="">

                    </select>
                </div>
                <div name="kerntaak_beoordeling" class="col s12 m3 l3">
                    <?php
                    $get_kerntaak = "SELECT * FROM kerntaak";
                    $result_kerntaak = $conn->query($get_kerntaak);
                    if ($result_kerntaak->num_rows > 0) {
                        ?>
                        <select name="kerntaak_option_beoordeling" class="">
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
                <div class="col s12 m12 l12">
                    <?php
                    $sel_kid = $_GET["kid"];
                    //echo $somevar;
                    ?>
                    <table class="table">
                        <thead>
                        <th>Werkprocessen</th>
                        <th>Criteria's</th>
                        <th>Normeringen:</th>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT a.werkproces_naam, b.werkproces_criterium_naam, b.werkproces_criterium_id FROM werkproces AS a INNER JOIN werkproces_criterium AS b ON a.werkproces_id = b.werkproces_id WHERE a.kerntaak_id = " . $sel_kid;
                            $result_sql = $conn->query($sql);
                            if ($result_sql->num_rows > 0) {
                                while ($row_sql = $result_sql->fetch_assoc()) {
                                    ?>
                                    <tr data-criterium="<?php echo $row_sql['werkproces_criterium_id']; ?>">
                                        <?php
                                        echo "<td>" . $row_sql['werkproces_naam'] . "</td>";
                                        echo "<td name='test'>" . $row_sql['werkproces_criterium_naam'] . "</td>";

                                        $sql_criterium = "SELECT a.criterium_normering_naam, a.criterium_normering_id FROM criterium_normering AS a INNER JOIN werkproces_criterium AS b ON a.werkproces_criterium_id = b.werkproces_criterium_id WHERE a.werkproces_criterium_id =  " . $row_sql["werkproces_criterium_id"];
                                        $result_sql_criterium = $conn->query($sql_criterium);
                                        if ($result_sql_criterium->num_rows > 0) {
                                            $i = 1;
                                            while ($row_sql_criterium = $result_sql_criterium->fetch_assoc()) {
                                                echo "<td class='selectable' data-normering='" . $row_sql_criterium['criterium_normering_id'] . "'>" . $row_sql_criterium['criterium_normering_id'] . ' ' . $row_sql_criterium['criterium_normering_naam'] . "</td>";
                                            }
                                        }
                                        ?>
                                        <td><a class="waves-light btn remove">Delete</a></td>
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                        <td></td>
                        </tbody>
                    </table>
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



                // Onchange cohortoptie beoordeling
                $("select[name=cohort_option_beoordeling]").on('change', function () {
                    beoordeling_cohort_id = this.value;
                    //alert(beoordeling_cohort_id);

                    $("select[name=klas_option_beoordeling]").empty().append($('<option>', {
                        value: 0,
                        text: "Kies een klas",
                    }));

                    $("select[name=student_option_beoordeling]").empty().append($('<option>', {
                        value: 0,
                        text: "Kies een student",
                    }));

                    // ophalen van informatie, met ajax
                    $.ajax({
                        type: 'GET',
                        url: 'json_show_klas.php',
                        data: {id: beoordeling_cohort_id},
                        dataType: 'json',
                        success: function (data) {
                            //alert('test');

                            $.each(data, function (index, element) {
                                //console.log(element.klas_name);
                                $("select[name=klas_option_beoordeling]").append($('<option>', {
                                    value: element.klas_id,
                                    text: element.klas_name
                                }));
                            });
                            $("select[name=klas_option_beoordeling]").removeClass("hide");
                            $("select[name=klas_option_beoordeling]").material_select();
                            $("select[name=student_option_beoordeling]").material_select();

                        }
                    });
                });

                // Onchange klasoptie beoordeling
                $("select[name=klas_option_beoordeling]").on('change', function () {
                    beoordeling_klas_id = this.value;
                    //alert(beoordeling_klas_id);

                    $("select[name=student_option_beoordeling]").empty().append($('<option>', {
                        value: 0,
                        text: "Kies een student",
                    }));

                    // ophalen van informatie, met ajax
                    $.ajax({
                        type: 'GET',
                        url: 'json_show_student.php',
                        data: {id: beoordeling_klas_id},
                        dataType: 'json',
                        success: function (data) {
                            //alert(data);
                            //$("select[name=student_option_beoordeling]").removeClass("hide");
                            $.each(data, function (index, element) {
                                $("select[name=student_option_beoordeling]").append($('<option>', {
                                    value: element.student_id,
                                    text: element.student_name
                                }));
                            });
                            $("select[name=student_option_beoordeling]").removeClass("hide");
                            $("select[name=student_option_beoordeling]").material_select();
                        },
                        error: function () {
                            console.log('error');
                            $("select[name=student_option_beoordeling]").empty().append($('<option>', {
                                value: 0,
                                text: "Kies een student",
                            }));
                            $("select[name=student_option_beoordeling]").material_select();
                        }
                    });
                });
                
                                // Onchange kerntaak beoordeling
                $("select[name=kerntaak_option_beoordeling]").on('change', function () {
                    var kerntaak_id = this.value;
                    //alert(kerntaak_id);
                    window.location.href = "beoordeling.php?kid=" + kerntaak_id;
                });

                // Onchange studentoptie beoordeling
                $("select[name=student_option_beoordeling]").on('change', function () {
                    // inlezen:
                    var student = $('#student_option_beoordeling').val();
                    $.ajax({
                        type: 'POST',
                        url: 'json_load_beoordeling.php',
                        data: {
                            student: student
                        },
                        dataType: 'json',
                        success: function (data) {
                            for (i in data) {
                                var normering = data[i]['criterium_normering_id'];
                                $("[data-normering='" + normering + "']").addClass("sel");
                            }
                        }
                    });
                });

                // Select Normering
                $('.selectable').click(function () {
                    $(this).closest('tr').find("td.sel").removeClass("sel");
                    $(this).addClass("sel");

                    // opslaan:
                    var criterium = $(this).closest('tr').data('criterium');
                    var normering = $(this).data('normering');
                    var student_id = $('#student_option_beoordeling').val();

                    console.log('[' + student_id + '] Criterium: ' + criterium + " - normering: " + normering);

                    $.ajax({
                        type: 'POST',
                        url: 'json_save_beoordeling.php',
                        data: {
                            criterium: criterium,
                            normering: normering,
                            student: student_id
                        },
                        dataType: 'text',
                        success: function (data) {
<<<<<<< HEAD
                            //alert(data);
                            $.each(data, function (index, element) {
                                //console.log(element.name);
                                $("#show_beoordeling").find('tbody')
                                        .append($('<tr>'
                                                ).append($('<td>', {
                                            value: element.id,
                                            text: element.name}
                                        )).append($('<td>', {
                                            value: element.id,
                                            text: element.name}
                                        ))lement.id,
                                            text
                                                );
// ophalen van informatie, met ajax
                                $.ajax({
                                    type: 'GET',
                                    url: 'json_show_criterium.php',
                                    data: {id: element.id},
                                    dataType: 'json',
                                    success: function (data) {
                                        //alert(data);
                                        $.each(data, function (index, element) {
                                            //console.log(element.name);
                                            $("#show_beoordeling").find('tbody').find('tr')
                                                    .append($('<td>', {
                                                        value: data.criterium_id,
                                                        text: data.criterium_naam}
                                                    ));
=======
                            alert(data);
                        }
                    }); // einde ajax
>>>>>>> 15a559c4fe0be1ac2557f27c889c970c82384767

                });

                // Remove Normering
                $('.remove').click(function () {
                    // opslaan:
                    var criterium = $(this).closest('tr').data('criterium');
                    var normering = $(this).closest('tr').find("td.sel").data('normering');
                    var student_id = $('#student_option_beoordeling').val();

                    console.log('[' + student_id + '] Criterium: ' + criterium + " - normering: " + normering);

                    $.ajax({
                        type: 'POST',
                        url: 'json_del_beoordeling.php',
                        data: {
                            criterium: criterium,
                            student: student_id
                        },
                        dataType: 'text',
                        success: function (data) {
                            alert(data);
                        }
                    }); // einde ajax

                    // remove class:
                    $(this).closest('tr').find("td.sel").removeClass("sel");

                });
            });
        </script>
    </body>
</html>