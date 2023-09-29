<?php
    //this page is for the ADMIN
    //We can add child details to the database
    // :)
    require_once("session.php");
    if (!isset($_SESSION["email"]) || $_SESSION["email"] == false) {
        header("location: login.php");
        exit;
    }

    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    require("/Applications/XAMPP/mysql_connect.php");

    function pass_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = strip_tags($data);
        $data = htmlentities($data);
        return $data;
     }

//we can use get to get the child user :)
    
    if($_SERVER['REQUEST_METHOD'] == "POST" ){

        if(!isset($_POST['breakfast']) || empty($_POST['breakfast'])) {
            $errors[] = 'Please enter breakfast details';
        } else{
            $breakfast = pass_input($_POST['breakfast']);  
        }

        if(!isset($_POST['lunch']) || empty($_POST['lunch'])) {
            $errors[] = 'Please enter lunch details';
        } else{
            $lunch = pass_input($_POST['lunch']);  
        }

        if(!isset($_POST['activities']) || empty($_POST['activities'])) {
            $errors[] = 'Please enter activites details';
        } else{
            $activites = pass_input($_POST['activities']);  
        }

        if(!empty($errors)){
            echo "Errors exist!";
        } else {
            echo "No errors Exist!";
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
    <title>Edit Details</title>
</head>
<body>
    <!-- Get the child -->
    <div style="width:50%; padding-left:15%"> 
        <h2>Children</h2>
        <!-- Fetches the child id of the children that are registered -->
        <?php 
         $day_details_select_childID = "SELECT child_id FROM child;"; //get all the children in the database
         $result = mysqli_query($db_connection, $day_details_select_childID);

        $children = array();
        while($row = mysqli_fetch_array($result)){
            $children[] = $row['child_id'];
        }
        ?>
        <!-- Place child id's it in a drop down menu so the admin can change day details :) -->
        <!-- Then we get the child id and display the information :) -->
        <div class="container">
        <form method="get" action="day_details_edit.php">
        <select type="dropdown" name='child'>
        <option value='null'>--Select a Child ID--</option>
        <?php
        foreach ($children as $key) {
            echo "<option>$key</option>";
        }
        ?>
        </select>
        <button type="submit">Filter</button>
        </form>
        <?php
            if(isset($_GET['child'])){
            $child_id = $_GET['child'];   
            $day_details_select_dates = "SELECT 'date' FROM day_details WHERE child_id = $child_id;"; //get all the children in the database
            $result = mysqli_query($db_connection, $day_details_select_dates);
            
            if(mysqli_num_rows($result) == 0){ //if no such car exists, row = 0
                echo "<div><p>No such information exists!</p></div>";
            } else {
                // while($row = mysqli_fetch_array($result)){
                //     $date =  $row['id'];
                //     echo $date;
                // }
                while($row = mysqli_fetch_array($result)){
                    $information = $row;
                    // $date = $row[0];
                    // $breakfast = $row[1];
                    // $lunch = $row[2];
                    // $activities = $row[3];
                   
                }
            }
           
        }
        // foreach ($information as $key) {
        //     echo $key . "<br />";
        // }
        // echo $date;
        // echo $breakfast;
        // echo $lunch;
        // echo $activities;
        
        ?>
        
    </div>
    <!-- Display the information -->
    <div style="width:50%; padding-left:15%">
        <form method="post" action="day_details_edit.php">
        <h2>Edit existing information</h2>
        <ul class='list'>
            <h2 class='bold'>Breakfast</h2>
            <p><?php echo "Hello"; ?></p>
            <hr>
            <div class="hidden"></div>
            <textarea style="width: 40vw; height: 20vh" type="textarea" name="breakfast" placeholder="Place your text here."></textarea>
            <h2 class='bold'>Lunch</h2>
            <div class="hidden"></div>
            <hr><textarea style="width: 40vw; height: 20vh" type="textarea" name="lunch" placeholder="Place your text here."></textarea>
            <h2 class='bold'>Activites</h2>
            <div class="hidden"></div>
            <hr><textarea style="width: 40vw; height: 20vh" type="textarea" name="activities" placeholder="Place your text here."></textarea>
        </ul>
        <input type="submit" value="Edit Details">
        </form>
    </div>
    </div>
    <div id="container ">
<?php include("footer.php");?>
</div>
</body>
</html>