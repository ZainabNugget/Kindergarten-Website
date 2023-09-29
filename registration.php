<?php //register.php
//check the path to connection.php is correct – this is pointing one level up from
//htdocs. When you place it on Knuth check how many levels up it is from this
//script.
require ("/Applications/XAMPP/mysql_connect.php");
require_once ("session.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// name (firstName)
// email
// password
// childname
// group

function pass_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = strip_tags($data);
  return $data;
}
$error= "";
if($_SERVER['REQUEST_METHOD'] == 'POST'){

  if(isset($_POST['name']) && !empty($_POST['name'])){
      $name = pass_input($_POST['name']);
  } else {
    $error .= "<p class='error'>Please enter valid name!</p>";
  }

  if(isset($_POST['email']) && !empty($_POST['email'])){
    $email = pass_input($_POST['email']);
} else {
    $error .= "<p class='error'>Please enter valid email!</p>";
}

if(isset($_POST['password']) && !empty($_POST['password'])){
  if(strlen($_POST['password']) < 6){
      $error .= "<p class='error'>Your password should be more than 6 characters!</p>";
  } else {
    $password = pass_input($_POST['password']);
  }
} else {
 echo "<p class='error'>Please enter valid password!</p>";
}

if(isset($_POST['childname']) && !empty($_POST['childname'])){
  $childName = pass_input($_POST['childname']);
} else {
 $error .= "<p class='error'>Please enter valid name!</p>";
}

$group = $_POST['group'];
//mysql query to find if email exists

if(strlen($error) == 0){

    $searchEmail = "SELECT `email` FROM `users` WHERE email = '$email'; ";
    $result = mysqli_query($db_connection, $searchEmail);

    $searchUser = "SELECT '*' FROM `users` WHERE email = '$email';";
    $result4 = mysqli_query($db_connection, $searchUser);
    if(mysqli_num_rows($result) > 0){ //email found
        $error .=  "<p class='error'>Email already registered!</p>";

        if($result4){
          $insertChild = "INSERT INTO `child`(`name`, `group`, `email`) VALUES ('$childName','$group','$email');";
           $result5 = mysqli_query($db_connection, $insertChild);
        
          if($result5){
            echo "inserted new child";
          }
        }


    } else { //email not found
      $insertQuery = "INSERT INTO `users`(`email`, `name`, `password`) VALUES ('$email','$name','$password');";
      $result2 = mysqli_query($db_connection, $insertQuery);
      if($result2){
          echo "Inserted";
      }
      $insertChild = "INSERT INTO `child`(`name`, `group`, `email`) VALUES ('$childName','$group','$email');";
      $result3 = mysqli_query($db_connection, $insertChild);
      if($result3){
        echo "Inserted child";
    }
    }
    
    }

   

}







?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
	<title>Sign Up</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>
<style>
  body {
                background-image: url("images/background.png");
                background-size: cover;
                height:80vh;
          }
  </style>

<body>
<?php
	include("header.php");
?>	

<section class="vh-100 gradient-custom" style="margin-bottom: 4%">
  <div class="container py-5 h-100">
    <div class="row justify-content-center align-items-center h-100">
      <div class="col-12 col-lg-9 col-xl-7">
        <div class="card shadow-2-strong card-registration" style="border-radius: 15px;">
          <div class="card-body p-4 p-md-5">
            <h3 class="mb-4 pb-2 pb-md-0 mb-md-5">Registration Form</h3>
				<?php echo $error; ?>
				<?php//echo $success; ?>
        <!-- <?php// echo $_SERVER['PHP_SELF']; ?> -->
            <form  method="post" action="registration.php" novalidate>
			
              <div class="row">
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input type="text" id="firstName" name="name" class="form-control form-control-lg" required />
                    <label class="form-label" for="firstName">First Name</label>
                  </div>

                </div>
                <div class="col-md-6 mb-4">

                  <div class="form-outline">
                    <input type="text" id="lastName" name="" class="form-control form-control-lg" />
                    <label class="form-label" for="lastName">Last Name</label>
                  </div>

                </div>
              </div>

              <div class="row">
                <div class="col-md-6 mb-4 pb-2">

                  <div class="form-outline">
                    <input type="email" id="emailAddress" name="email" class="form-control form-control-lg" />
                    <label class="form-label" for="emailAddress">Email</label>
                  </div>

                </div>
                <div class="col-md-6 mb-4 pb-2">

                  <div class="form-outline">
                    <input type="tel" name="password" class="form-control form-control-lg" />
                    <label class="form-label" for="phoneNumber">Password</label>
                  </div>

                </div>
              </div>

			  <div class="row">
                <div class="col-md-6 mb-4 d-flex align-items-center">

				      <div class="form-outline">
                    <input type="text" name="childname" id="childname" class="form-control form-control-lg" />
                    <label class="form-label" for="childname">Child Name</label>
                  </div>

                </div>
                <div class="col-6" style="">

              <select class="select form-control-lg" name="group">
                <option value="meow" disabled>Choose option</option>
                <option value="1">1-Day (€250)</option>
                <option value="3">3-Day (€500)</option>
                <option value="5">5-Day (€750)</option>
              </select>
              <label class="form-label select-label">Choose option</label>


              </div>

              <div class="row">
                <div class="col-12 d-flex align-items-center" style="">

                  <select class="select form-control-lg" name="group">
                    <option value="1" disabled>Choose option</option>
                    <option value="Baby">Baby</option>
                    <option value="Wobbler">Wobbler</option>
                    <option value="Toddler">Toddler</option>
					          <option value="Preschool">Preschool</option>
                  </select>
                  <label class="form-label select-label">Choose option</label>

                </div>
                <div class="mt-4 pt-2" style="">
                <input class="btn btn-primary btn-lg"  type="submit" name="submit" value="Submit" />
              </div>
              </div>
              </div>
              </div> 

			  

              

            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<?php
	include("footer.php");
?>	
</body>

</html>