<?php
require ("/Applications/XAMPP/mysql_connect.php");
 require_once("session.php");
 if (!isset($_SESSION["email"]) || $_SESSION["email"] == false) {
    header("location: login.php");
    exit;
} else {
if($_SESSION['role'] == 'user'){
    header("location: login.php");
    exit;
}
}

$sql = "SELECT * FROM contact;";
$result = mysqli_query($db_connection, $sql);


if(mysqli_num_rows($result) == 0){ //if no such car exists, row = 0
    echo "<div><p>No such information exists!</p></div>";
} else {
    while($row = mysqli_fetch_array($result)){
        $email = $row['email'];
        $text = $row['feedback'];

        $feedback .= "<p class='card-text'>$email</p>";
        $feedback .= "<p class='card-text border-bottom'>$text; </p>";

    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <title>Document</title>
</head>
<style>
 body {
                background-image: url("images/background.png");
                background-size: cover;
                height:80vh;
          }
    </style>
<body>
    <?php include("header.php"); ?>
        
    <div class='container'>
    <div class='card  justify-content-center' style = ''>
            <div class='card-body'>
            <h5 class='card-title'>Card title</h5>
            <h6 class='card-subtitle mb-2 text-muted border-bottom'>Feedback</h6>
            <?php echo $feedback; ?>
            </div>
            </div>

        </div>

    <div style="margin-top:30%">
<?php include("footer.php"); ?>
        </div>
</body>
</html>