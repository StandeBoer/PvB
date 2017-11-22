<?php
include("check.php");
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
        <?php echo '<h1>Dit is de homepage</h1>'; ?>
        <!-- Button voor de modal voor het toevoegen van een student -->
        <button type="button" class="btn btn-sm" data-toggle="modal" data-target="#ModalAddStudent"><i class='fa fa-user fa-md'>Student toevoegen</i></button>
        
        
        <!-- Button om uit te loggen -->
        <button><a href="logout.php" style="font-size:18px">Uitloggen</a></button>

        
        
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
