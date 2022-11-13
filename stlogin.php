<!DOCTYPE html>
<html lang="en">
    <?php
      session_start();
      include_once("stdb.php");
      if(isset($_POST['login'])) {
        $user = remove_script($_POST['username']);
        $pass = remove_script($_POST['pass']);

        // check if fields are empty
        $login_error = "";
        $login_success = "";
        if(empty($user)) {
            $user_error = "Pls enter your username";
        } 
        if(empty($pass)) {
            $pass_error = "Pls enter your password";
        }

        // hash the password
        // $hashed_pass = md5($pass);
        // access the database if they are not empty

        if(!empty($user) && !empty($pass)) {
            // create the sql statement
            $sql = "select * from student_info where username = '$user' and 
            password = '$pass'";
            // run the query and store in a resultset object
            $result = mysqli_query($conn,$sql);

            // check if there is a returned record

            if(mysqli_num_rows($result) == 1) {
                $row = mysqli_fetch_assoc($result);
                $_SESSION['student_id'] =  $row['student_id'];
                // redirect to the user dashboard page.
                header("location:dashboard.php");
            } else {
                $login_error = "Your username or password is incorrect";
            }
        }
      }

      function remove_script($data) {
        global $conn;
        $result = mysqli_real_escape_string($conn,$data);
        return $result;
    }
    ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN PAGE</title>
    <link rel="stylesheet" href="bs4/css/bootstrap.min.css" />
    <style>
       
        .col-sm-6,.form-control{
            display: inline-block;
        }
        label {
            color: white;
            font-weight: bolder;
        }
        .btn {
            background-color: #057588;
            color: #fff;
        }
</style>
</head>
<body>
    <div class="container mt-5">
        <div class="row mt-5">
        <div class="col-md-8 mx-auto mt-5 ">
            <form action=""  class="p-4 bg-info" method="post">
            <h2 class="text-center text-white">Login Form</h2>
            <?php
if(isset($user_error)) {
    echo "<p 
            style='background-color:#057588;color:white;
            padding-left:33px;font-weight:bolder;width:65%'>".$user_error.
            "</p>";
}
if(isset($pass_error)) {
    echo "<p 
            style='background-color:#057588;color:white;
            padding-left:33px;font-weight:bolder;width:65%'>".$pass_error.
            "</p>";
}
            if(isset($login_error) && !empty($login_error)) {
            echo "<p 
                style='background-color:#057588;color:white;
             padding-left:33px;font-weight:bolder;width:65%'>".$login_error.
                "</p>";
            }
            if(isset($login_success) && !empty($login_success)) {
    echo "<p 
        style='background-color:#057588;color:white;
        padding-left:33px;font-weight:bolder;width:65%'>".$login_success.
        "</p>";
    }
            if(isset($_SESSION['unauthorised'])) {
                $unauthorised = $_SESSION['unauthorised'];
                echo "<p 
                style='background-color:#057588;color:white;
            padding-left:33px;font-weight:bolder;width:65%'>".$unauthorised.
                "</p>";
                unset($_SESSION['unathorised']);
                session_destroy();
            }
            ?>
        <div class="form-group">
                    <label  class="col-sm-2">
                        User Name
                    </label>
                    <div class="col-sm-6">
                <input type="text" class="form-control" name="username" 
                value = "<?php
                if(isset($_POST['username'])) echo $_POST['username'];
                ?>"
                >
                    </div>
                </div>   
                <div class="form-group">
                    <label  class=" col-sm-2">
                        Password
                    </label>
                    <div class="col-sm-6">
                <input type="password" class="form-control" name="pass" 
                value = "<?php
                if(isset($_POST['pass'])) echo $_POST['pass'];
                ?>"
                >
                    </div>
                </div>
                <div class="form-group mx-auto w-25">
                    <input type="submit" class="btn btn-block" name="login"
                        value="Login">
                </div>
    <p class="text-white">New member? <a href="stregistration.php"
                 class="text-white font-italic">click here</a></p>
            </form>
        </div>
        </div>
    </div>
</body>
</html>