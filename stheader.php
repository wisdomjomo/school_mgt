
<?php

session_start();
include_once("stdb.php");
if(!isset($_SESSION['student_id'])) {
    $_SESSION['unauthorised'] = "You are not authorised for this action";
    // redirect to the login page
    header("location:stlogin.php");
} else {
    $student_id = $_SESSION['student_id'];
    // create a sql statement to query by
    $sql = "select * from  student_info where student_id = '$student_id'";
    // execute query against the table
    $result = mysqli_query($conn,$sql);
    // check if there is at least a record that matches the query
    if(mysqli_num_rows($result) == 1) {
       $row = mysqli_fetch_assoc($result);
       // collect all necessary data from the result set

       $username = $row['username'];
       $firstname = $row['firstname'];
       $lastname = $row['lastname'];
       $gender = $row['gender'];
       $date = $row['date'];
       $email = $row['email'];
       $phone = $row['phone'];
       $photo = $row['photo'];
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php echo $username ?></title>
   <link rel="stylesheet" href="stylying/account1.css"/>
</head>
<body>
<div class="wholebody">
        <div class="quaterbody">
            <div class="onee" style="color:white;"><?php echo $username; ?></div>
            <div class="oneee"><img style="width: 80px; height: 80px; border-radius: 50%;margin-top: 40px;" src="<?php echo $photo; ?>" alt="" id="img"></div>
            <div class="one"><a href="dashboard.php">Dashboard</a></div>
            <div class="one"><a href="stenroll.php">Course</a></div>
            <div class="one"><a href="stprofile.php">Profile</a></div>
            <div class="one"><a href="stlogout.php">Logout</a></div>
        </div>
</body>
</html>