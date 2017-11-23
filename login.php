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
        while ($row = $result->fetch_assoc()){
            $hashed_password = $row['user_password'];
        }
        
        if (password_verify($password, $hashed_password)){
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
    </head>
    <body>

        <form method="POST" id="login_form">
            <label for="email">E-mail</label>
            <input name="email" type="email" class="w3-input" id="email" placeholder="E-mail">
            <label for="inputPassword">Wachtwoord</label>
            <input name="password" type="password" class="w3-input" id="pass" placeholder="Wachtwoord">
            <br>
            <input id="button" type="submit" name="submit" class="btn btn-primary" style="" value="Login">
        </form>

<?php
if (!empty($error)) {
    ?>
            <div class="alert alert-danger" id="login_errors"><?php echo $error; ?></div>
            <?php
        }
        ?>

    </body>
</html>
