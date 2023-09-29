<?php
require ("/Applications/XAMPP/mysql_connect.php");
require_once ("session.php");
$success="";
$error = "";

function pass_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = strip_tags($data);
  return $data;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

	$name = $_POST["name"];
	$email = $_POST["email"];
	$address = $_POST["address"];
	$city = $_POST["city"];
	$feedback = $_POST["feedback"];
	$to = "cubsdaycare@gmail.com";
	$headers = "From: " . $name . " <" . $email . ">\r\n";
	
if(isset($_POST['name']) && !empty($_POST['name'])){
    $name = pass_input($_POST['name']);
} else {
  $error .= "<p class='error'>Please enter valid name!</p>";
}

if(isset($_POST['email']) && !empty($_POST['email'])){
  if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $error .= "Invalid email format";
  } else {
    $email = pass_input($_POST['email']);
  }
} else {
$error .= "<p class='error'>Please enter valid email!</p>";
}

if(isset($_POST['address']) && !empty($_POST['address'])){
  $address =pass_input($_POST['address']);
} else {
$error .= "<p class='error'>Please enter valid address!</p>";
}

if(isset($_POST['city']) && !empty($_POST['city'])){
  $city = pass_input($_POST['city']);
} else {
$error .= "<p class='error'>Please enter valid city!</p>";
}


if(isset($_POST['feedback']) && !empty($_POST['feedback'])){
  $feedback = pass_input($_POST['feedback']);
} else {
$error .= "<p class='error'>Please enter valid feedback!</p>";
}

if(empty($error)){

  $checkEmail = "SELECT `email` FROM `contact`;";
  $result1 = mysqli_query($db_connection, $checkEmail);

  if(mysqli_num_rows($result1)>0){
      $error .=  "<p class='error'>You have already entered feedback with that email!</p>";
  } else {

  $insertFeedback = "INSERT INTO `contact`(`email`, `feedback`) VALUES ('$email','$feedback');";
  $result = mysqli_query($db_connection, $insertFeedback);

  if($result){
      echo "Succes";
  }

  if (mail($to, $subject, $message, $headers)) {
		$success .= "<p class='alert alert-success' role='alert'>Thank you for your message. We will get back to you as soon as possible.</p>";
	} else {
		echo "<p>Sorry, something went wrong. Please try again later.</p>";
	}
}
} 

}
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

	<title>Contact Us</title>
</head>
<style>
   body {
                background-image: url("images/background.png");
                background-size: cover;
                height: 150vh;
          }
  </style>

<body>
	<?php include("header.php");?>
<div class="container" style=padding:1%>
	<div class="container border bg-light" style=padding:1%>
  <?php echo $success; ?>
  <?php echo $error; ?>

<form class="row g-3" action="contact.php" method="post" novalidate>
  <div class="col-md-6">
    <label for="name" class="form-label">Name</label>
    <input type="name" class="form-control" id="name" name="name" required>
  </div>
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Email</label>
    <input type="email" class="form-control" id="inputEmail4" name="email" required>
  </div>

  <div class="col-12">
    <label for="inputAddress" class="form-label">Address</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" name="address" required>
  </div>

  <div class="col-12">
    <label for="inputAddress2" class="form-label">Address 2</label>
    <input type="text" class="form-control" id="inputAddress2" placeholder="Optional">
  </div>

  <div class="col-md-6">
    <label for="inputCity" class="form-label">City</label>
    <input type="text" class="form-control" id="inputCity" name="city" required>
  </div>

  <div class="col-md-2">
    <label for="inputZip" class="form-label">Zip</label>
    <input type="text" name="phoneNumber" class="form-control" id="inputZip" placeholder="Optional">
  </div>

  <div class="form-group">
  <label for="feedback">Feedback:</label>
  <textarea class="form-control" rows="5" id="feedback" placeholder="..." name="feedback" required></textarea>
</div> 

  <div class="col-12">
    <div class="form-check">
    </div>
  
  <div class="col-12" style=margin-bottom:1%>
    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
</div>
<div class="container border" style="padding:1%">
	<h2>Contact Information</h2>
	<p>Mailing Address: 72 Roberts Lane, Dublin 9</p>
	<p>Phone Number: 01 777 2367</p>
	<p>Email Address: cubsdaycare@gmail.com</p>
</div>
</div>
	</div>
	</div>
</div>
<div>
<?php include("footer.php");?>

</body>


</html>
