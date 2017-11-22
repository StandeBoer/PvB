<?php
session_start();
include("connect.php"); //Establishing connection with our database

if(isset($_SESSION['email'])){
    header("location:index.php");
}

$succes = ""; //Variable for storing our successes.
$error = ""; //Variable for storing our errors.

if (isset($_POST['submit'])){
    //echo 'submit';
    //echo 'Email: ' . $_POST['email'] . '<br>Password: ' . $_POST['password'] . '<br>Herhaal password:' . $_POST['herhaalpassword'];
    //echo password_hash($_POST['password'], PASSWORD_BCRYPT);
    if ($_POST['password'] == $_POST['herhaalpassword']){
        //echo '<br><br>Password en herhaal zijn hetzelfde';
        $email = $_POST['email'];
        $password = $_POST['password'];

        //echo $password;
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
        //echo $hashed_password;
        
        $sql = "INSERT INTO users (user_emailadres, user_password) VALUES ('" . $email . "', '" . $hashed_password . "')";
        if ($conn->query($sql) === TRUE) {
            $succes = "You added your account";
        } else {
            $error = "Something went wrong, try it again";
        }
    } else {
        $error = "Your password doesn't match, please try again";
        //echo '<br><br>Password en herhaal zijn NIET hetzelfde';
    } 
}
?>
<html>
    <head>
        <meta charset="UTF-8">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="stylesheet.css" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <title>MiniProeve</title>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <div style="text-align: center; margin-top: 100px;"><h2><b>Proeve van Bekwaamheid</b></h2></div>
                <div class="col-md-8" style="float: none; margin-left: auto; margin-right: auto; margin-top: 75px;">
                    <div class="panel panel-default">
                        <div class="panel-heading">Registratie</div>
                        <div class="panel-body">
                            <form method="POST" id="register_form">
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input name="email" type="email" class="form-control" id="email" placeholder="E-mail" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword">Wachtwoord</label>
                                    <input name="password" type="password" class="form-control" id="pass" placeholder="Wachtwoord" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputPassword2">Herhaal wachtwoord</label>
                                    <input name="herhaalpassword" type="password" class="form-control" id="herhaalpassword" placeholder="Herhaal wachtwoord" required>
                                </div>
                                <input id="button" type="submit" name="submit" class="btn btn-primary" style="float: right" value="Register">
                            </form>
                        </div>
                    </div>
                    <?php
                    if (!empty($error)){
                    ?>
                        <div class="alert alert-danger" id="login_errors"><?php echo $error; ?></div>
                    <?php
                    }
                    if (!empty($succes)){
                    ?>
                        <div class="alert alert-success" id="login_errors"><?php echo $succes; ?></div> 
                    <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </body>
</html>