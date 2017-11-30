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
           <link type="text/css" rel="stylesheet" href="stylesheet.css">
        <link type="text/css" rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
        <link type="text/css" rel="stylesheet" media="screen,projection" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/css/materialize.min.css" />
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/materialize/0.97.5/js/materialize.min.js"></script>
    </head>
    <body>
      
        <div class="container">
        <div class="z-depth-5 grey lighten-4 row" style="display: inline-block; padding: 32px 48px 0px 48px; border: 1px solid #EEE;">

            <form class="col s12" method="post" id="login_form">
            <div class='row'>
              <div class='col s12'>
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <label for="email">E-Mail</label>
                <input name="email" type="email" class="w3-input" id="email" placeholder="E-mail">
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <label for="inputPassword">Wachtwoord</label>
                <input name="password" type="password" class="w3-input" id="pass" placeholder="Wachtwoord">
              </div>
              <label style='float: right;'>
								<a class='pink-text' href='#!'><b>Forgot Password?</b></a>
							</label>
            </div>

            <br />
            <center>
              <div class='row'>
                  <button id="button" type='submit' name='submit' value="Login" class='col s12 btn btn-large waves-effect indigo'>Login</button>
              </div>
            </center>
          </form>
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





