<?php
    // This page is for Parents
    // They will be able to view the details for the child 
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require_once("session.php");
    if (!isset($_SESSION["email"]) || $_SESSION["email"] == false) {
        header("location: login.php");
        exit;
    }
    
    require("/Applications/XAMPP/mysql_connect.php");
    
    if (!isset($_GET['date']) || empty($_GET['date'])) {
        $errors[] =  "Choose Date!";
    } else{
        $date = $_GET['date'];
    }
    if(empty($errors)){

    $sql = "SELECT * FROM day_details WHERE date='$date';";
    $result = mysqli_query($db_connection, $sql);

    if(mysqli_num_rows($result) == 0){ //if no such car exists, row = 0
        echo "<div><p>No such information exists!</p></div>";
    } else {
        $found = TRUE;
        while($row = mysqli_fetch_array($result)){
            $date = $row[0];
            $breakfast = $row[1];
            $lunch = $row[2];
            $activities = $row[3];
        }
    }
} 
// MYSQL to create my table for day details (will be further improved)
// CREATE TABLE `s3088942`. (`date` DATE NOT NULL , `breakfast` TEXT NOT NULL , `lunch` TEXT NOT NULL , `activities` TEXT NOT NULL ) ENGINE = InnoDB; 
//$sql = "SELECT '*' FROM day_details WHERE 'date'='$date';";// SELECTS details based on the date

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@200;300&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
     integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- <link href="style.css" rel="stylesheet"> -->
    <title>Daily Activites</title>
</head>
<body>
<header>
            <?php
                include("header.php");
            ?>
            </header>
        <div class="container border m-3">
                <div>
                    <!-- include php code here -->
                        
                </div>
                <div class="container text-center  p-5 justify-content-center ">
                    <div class="row">
                            <div class="col-8">  
                                    <label>Welcome Parent</label>
                                    <div class="form-group">
                                    <p>Today is 'DATE' & 'TEMPERATURE</p>
                                    <hr>
                                        <form method="GET" action="#"> 
                                            <!-- GET the date from the filter  -->
                                        <label for="start" class="right">Select date:</label>
                                        <input type="date" name="date" value="YYYY-MM-DD" min="2022-01-01" max="2025-12-31">
                                        <input type="submit" value="Filter" > 
                                        </form>
                                    </div>
                               
                            </div>
                            <!-- <div class="col-3 row-3">
                            <aside class="">
                                <div id="" class="">
                                <h2>This is the side bar</h2>
                                <ul>
                                    <li>Link</li>
                                    <li>Link</li>
                                </ul>
                                    </div>
                            </aside> -->
                            </div>
                    </div>
                    <div class="row-cols-2">
                            <div class="co ">
                            <?php 
                            if(!empty($breakfast)||!empty($lunch)||!empty($activities)){
                                // if date found in the data base
                                if(isset($found) == TRUE){
                                    echo "
                                    <ul class='list'>
                                    <h2 class='bold'>Breakfast</h2>
                                    <hr>
                                    <li>$breakfast</li>                      
                                    <h2 class='bold'>Lunch</h2>
                                    <hr>
                                    <li>$lunch</li>
                                    <h2 class='bold'>Activites</h2>
                                    <hr>
                                    <li>$activities</li>
                                    </ul>
                                    ";
                                } 
                            } else {
                                echo "
                                No information provided, please choose a date!
                                ";
                            }

                        ?>
                            </div>
                    </div>
                </div>
            </div>
        </div>

<?php include("footer.php");?>
</body>
</html>