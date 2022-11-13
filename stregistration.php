<?php

 // start the session
 session_start();
 // include stdb.php
 include_once("stdb.php");
 
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="stylying/signagain1.css">
     <title>Registration Page</title>
 </head>
 <body>
    <form method="post" action="stprocess.php" enctype="multipart/form-data">
        <div class="theimage"><img src="images/coding.jpg" alt="" id="jpgg"></div>
        <div class="body">
            <div class="h1learn">
                <h2>Sign Up Form</h2>
            </div>
            <?php
                if ( isset($_SESSION['user_exist'])) {
                    $already_exist = $_SESSION['user_exist'];
                    echo "<div class='alert alert-danger mb-2'>".$already_exist.
                    "</div>";
                    unset($_SESSION['user_exist']);
                    // session_destroy();
                }
                if (isset($_SESSION['errors']) ) {
                    $errors = $_SESSION['errors'];
                    foreach($errors as $error) {
                    echo "<p 
                    style='background-color:#057588;color:white;
                    padding-left:33px;font-weight:bolder;width:65%'>".$error.
                    "</p>";
                }     
                    // reset session variable on page refresh
                    unset($_SESSION['errors']);
                     //session_destroy();
                }else if ( isset($_SESSION['success'])) {
                    $success = $_SESSION['success'];
                    echo "<div class='alert alert-success'>".$success.
                    "</div>";
                    unset($_SESSION['success']);
                    // session_destroy();
                }
            ?>
            <div class="form-body">
                <label for="">First Name</label> <br>
                <input type="text" name="firstname" value = "<?php if(isset($_SESSION['firstname'])) echo $_SESSION['firstname'];?>"> <br>
                <label for="">Last Name</label> <br>
                <input type="text" name="lastname" value= "<?php if(isset($_SESSION['lastname'])) echo $_SESSION['lastname'];?>">
                <label for=""> <br>
                    <input type="radio" name="gender" value="Male" 
                    <?php if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Male') {echo "checked";} ?>/> Male
                </label>
                <label>
                    <input type="radio" name="gender" value="Female"
                    <?php if(isset($_SESSION['gender']) && $_SESSION['gender'] == 'Female') {echo "checked";} ?>/> Female
                </label> <br>
                <label for="">Username</label> <br>
                <input type="text" name="username" value= "<?php if(isset($_SESSION['username'])) echo $_SESSION['username'];?>"> <br>
                <label for="">Phone</label> <br>
                <input type="text" name="phone" value=" <?php if(isset($_SESSION['phone'])) echo $_SESSION['phone'];?>"> <br>
                <label for="">Email</label> <br>
                <input type="text" name="email" value="<?php if(isset($_SESSION['email'])) echo $_SESSION['email']; ?>"> <br>
                <label for="">Password</label> <br>
                <input type="password" name="password" > <br>
                <label for="">Re-type Password</label> <br>
                <input type="password" name="pass2" > <br>
                <label>Your Photo</label> <br>
                <input type="file" name="photo" value="<?php if(isset($_SESSION['filename'])) echo $_SESSION['filename']; ?>"> <br>
                <div class="form-body-1"> <br>
                    <input type="submit" name="stsignup" value="Register"> <br>
                </div> <br>
                <div class="form-body-2">
                    <label>Already have an account?</label>
                    <a href="stlogin.php">Login</a>
                </div> <br>
            </div>
        </div>
    </form>
    <div class="bbbody">
    <footer>
        <ul class="icons">
            <li><a href="#"><ion-icon name="logo-whatsapp"></ion-icon></a></li>
            <li><a href="#"><ion-icon name="logo-linkedin"></ion-icon></a></li>
            <li><a href="#"><ion-icon name="logo-facebook"></ion-icon></a></li>
            <li><a href="#"><ion-icon name="logo-instagram"></ion-icon></a></li>
        </ul>
        <ul class="menu">
                <li><a href="index.php">Home</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Partners</a></li>
                <li><a href="#">Specialties</a></li>
                <li><a href="#">Contact Us</a></li>
        </ul>
            <div class="footer-copyright">
                <p>Copyright @ 2022 All Rights Reserved.</p>
            </div>
    </footer>
    </div>
 </body>
 </html>