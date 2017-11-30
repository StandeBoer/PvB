<html>
    <head>
<link type="text/css" rel="stylesheet" href="stylesheet.css">
<link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link type="text/css" rel="stylesheet" media="screen,projection" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css" />
</head>
</html>
<?php
include("connect.php");
$selected_kerntaak_id = $_GET["id"];
$get_werkproces_criterium = "SELECT * FROM werkproces WHERE kerntaak_id = '" . $selected_kerntaak_id . "'";
$result_werkproces_criterium = $conn->query($get_werkproces_criterium);
if ($result_werkproces_criterium->num_rows > 0) {
    ?>
    <form method="POST">
        <br>
        <select name = "kerntaak_criterium_option" id="kerntaak_criterium_option"style="display: block;" required>
            <option selected = "selected" disabled>Kies een werkproces</option>
            <?php
            while ($row_werkproces_criterium = $result_werkproces_criterium->fetch_assoc()) {
                ?>
                <option value="<?php echo $row_werkproces_criterium['werkproces_id'] ?>"><?php echo $row_werkproces_criterium['werkproces_id'] . ' - ' . $row_werkproces_criterium["werkproces_naam"] ?></option>
                <?php
            }
            ?>
        </select>
    </form>
    <?php
} else {
    echo 'Deze kerntaak heeft nog geen werkproces(sen)<br><br>';
}
?>


<script type="text/javascript">
    $(document).ready(function () {
        // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
        $('.modal-trigger').leanModal();
        $('select').material_select();
    });
</script>