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
    </head>

    <body>
        <?php
        include("navbar.php");
        ?>
        <div class="row beoordeling">
            <form method="POST">
                <div name="cohort_beoordeling" class="col s12 m3 l2">
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
                <div name="klas_beoordeling" class="col s12 m3 l2">
                    <select name="klas_option_beoordeling" class="hide">

                    </select>
                </div>
                <div name="student_beoordeling" class="col s12 m3 l2">
                    <select name="student_option_beoordeling" class="hide">

                    </select>
                </div>
                <div name="kerntaak_beoordeling" class="col s12 m3 l2">
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

                <div class="col s12 m6 l4" style="float: right;">
                    <input type="submit" name="submit_beoordeling" class="btn btn-success" value="Versturen" style="border-radius: 10;">
                    <input type="submit" name="sluiten" class="btn btn-success data-dismiss" value="Annuleren">
                </div>

                <div class="col s12 m12 l12">
                    <table id="show_beoordeling" class="">
                        <thead>
                            <tr>
                                <th>Werkproces</th>
                                <th>Criterium</th> 
                                <th>Normeringen:</th>
                                <th></th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody name="tbody">
                        <td>Werkproces 1</td>
                        <td>Criterium 1</td>
                        <td>Normering 1</td>
                        <td>Normering 2</td>
                        <td>Normering 3</td>
                        <td>Normering 4</td>

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

                // Onchange studentoptie beoordeling
                $("select[name=student_option_beoordeling]").on('change', function () {
//                   $("select[name=cohort_option_beoordeling]").addClass("hide");
//                   $("select[name=cohort_option_beoordeling]").material_select();
//                   $("select[name=klas_option_beoordeling]").addClass("hide");
//                   $("select[name=klas_option_beoordeling]").material_select();
                    $("select[name=kerntaak_option_beoordeling]").removeClass("hide");
                    $("select[name=kerntaak_option_beoordeling]").material_select();
                });

                //Show werkproces/criterium en normeringen
                $("select[name=kerntaak_option_beoordeling]").on('change', function () {
                    //console.log('kerntaak selected');
                    kerntaak_id = this.value;
                    //console.log(kerntaak_id);

                    $("tbody[name=tbody]").empty();

                    // ophalen van informatie, met ajax
                    $.ajax({
                        type: 'GET',
                        url: 'json_show_werkproces.php',
                        data: {id: kerntaak_id},
                        dataType: 'json',
                        success: function (data) {
                            //alert(data);
                            $.each(data, function (index, element) {
                                //console.log(element.name);
                                $("#show_beoordeling").find('tbody')
                                        .append($('<tr>'
                                                ).append($('<td>', {
                                            value: element.id,
                                            text: element.name}
                                        ))
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

                                        });

                                    }
                                });
                            });

                        }
                    });



                });
            });
        </script>
    </body>
</html>