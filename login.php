<?php
session_start();
include("connect.php"); //Establishing connection with our database

if (isset($_SESSION['email'])) {
    header("location:index.php");
}

$error = ""; //Variable for storing our errors.
if (isset($_POST["submit"])) {
    if (empty($_POST["email"]) || empty($_POST["password"])) {
        $error = "Both fields are required.";
    } else {
// Define $username and $password
        $email = $_POST['email'];
        $password = $_POST['password'];

// To protect from MySQL injection
        $email = stripslashes($email);
        $password = stripslashes($password);
        $email = mysqli_real_escape_string($conn, $email);
        $password = mysqli_real_escape_string($conn, $password);
//        $password = md5($password);

        $sql = "SELECT user_password FROM users WHERE user_emailadres='$email'";
        $result = mysqli_query($conn, $sql);
        $hashed_password = "";

        //print_r($row_storedpassword);
        while ($row = $result->fetch_assoc()) {
            $hashed_password = $row['user_password'];
        }

        if (password_verify($password, $hashed_password)) {
            $_SESSION['email'] = $email; // Initializing Session
            header("location: index.php"); // Redirecting To Other Page
            //echo 'password is valid';
        } else {
            $error = "Incorrect username or password.";
        }
    }
}
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


        <div class="container">
            <div class="row">
                <div style="text-align: center; margin-top: 100px;"><h2><b>Proeve van Bekwaamheid</b></h2></div>
                <div class="col-md-8" style="float: none; margin-left: auto; margin-right: auto; margin-top: 75px;">


                    <div>Inloggen</div>
                    <div>
                        <form method="post" id="login_form">
                            <div>
                                <label for="email">E-mail</label>
                                <input name="email" class="form-control" id="email" placeholder="E-mail" type="email">
                            </div>
                            <div>
                                <label for="inputPassword">Wachtwoord</label>
                                <input name="password" class="w3-input" id="pass" placeholder="Wachtwoord" type="password">
                            </div>
                            <button id="button" name="submit" class="btn btn-primary" style="float: right" value="Login" type="submit">Login</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
        <?php
        if (!empty($error)) {
            ?>
            <div class="alert alert-danger" id="login_errors"><?php echo $error; ?></div>
            <?php
        }
        ?>

    </body>
</html>





