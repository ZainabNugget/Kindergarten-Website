<?php
require_once ("/Applications/XAMPP/mysql_connect.php");
require_once ("session.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
// Create sql query from users table
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	
    if (empty($email)) {
        $error .= '<p class="error">Please enter email.</p>';
    }
    // validate if password is empty
    if (empty($password)) {
        $error .= '<p class="error">Please enter your password.</p>';
    }
        if (empty($error)) {
        // prepare and execute the SELECT query
       
        $checkEmailPassword = "SELECT * FROM users WHERE email = '$email';";
       // $checkEmailPassword->bind_param("s", $email);
        $result = mysqli_query($db_connection, $checkEmailPassword);
        if (mysqli_num_rows($result) > 0) {
        // get the user data from the database
        // $row = $result->fetch_assoc();
        // verify the password
        $row = mysqli_fetch_array($result);
        if ($password == $row['password']) {
            $_SESSION["userid"] = $row['id'];
            $_SESSION["user"] = $row;
            $_SESSION['email'] = $row['email'];
            $_SESSION["name"] = $row['name'];
        // Redirect the user to welcome page
        if (isset($_SESSION['email']['role']) && $_SESSION['email']['role']=== 'admin') {
            header("Location: home.php");
            exit;
        }  else {
                header("Location: home.php");
                exit();
            }

        } else {
            $error .= '<p class="error">The password is not valid.</p>';
        }
        } else {
            $error .= '<p class="error">No User exist with that email address.</p>';
        }
        // $checkEmailPassword->close();
        }
        // Close connection
        mysqli_close($db_connection);
        // display errors (if any)
        if (!empty($error)) {
            display_error($error);
        }
        }
        function display_error($error) {
            echo '<div class="alert alert-danger">' . $error . '</div>';
        }
	
?>
<!DOCTYPE html>
<html>
    <head>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <title>Login</title>
    </head>
    <body>
    <?php include("header.php");?>
        <style>
          .container{
            margin-top: 5%;
            margin-bottom: 6%;
          }
          body {
                background-image: url("images/background.png");
                background-size: cover;
                height:80vh;
          }
            </style>
        <div id="container"class="container h-100">
            <div  class="mx-auto p-2 " style="width: 500px;">
            <h2>Login Form</h2>
            <div>
            <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <div class="form-floating mb-3">
                <input type="email" name="email" class="form-control" id="floatingInput" placeholder="name@example.com">
                <label for="floatingInput">Email address</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
                <label for="floatingPassword">Password</label>
            </div>
            <div class="form-group" style="padding-top: 2%">
                    <input type="submit" name="login" class="btn btn-success" value="Submit">
                    </div>
            </form>
            <p>Not Registered? <a href="registration.php">Register here!</a></p>
        </div>
    </div>
    </div>
    <div id="container">
<?php include("footer.php");?>
</div>
    </body>
</html>