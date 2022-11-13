<?php
include_once('stheader.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php echo "$username | profile"; ?></title>
</head>
<body>
    <div class="profile">
        <h1 class="dis">Profile</h1>
        <div class="oneee"><img style="width: 100px; height: 100px; border-radius: 50%;" src="<?php echo $photo; ?>" alt="" id="img"></div>
        <div class="chechprofile">
            <div class="profile1">
                <label for="">First Name</label> <br>
                <?php echo "<h2>$firstname</h2>"; ?>
            </div>
            <div class="profile1">
                <label for="">Last Name</label> <br>
                <?php echo "<h2>$lastname</h2>"; ?>
            </div>
        </div>
        <div class="chechprofile">
            <div class="profile1">
                <label for="">Username</label> <br>
                <?php echo "<h2>$username</h2>"; ?>
            </div>
            <div class="profile1">
                <label for="">Email</label> <br>
                <?php echo "<h2>$email</h2>"; ?>
            </div>
        </div>
        <div class="chechprofile">
            <div class="profile1">
                <label for="">Gender</label> <br>
                <?php echo "<h2>$gender</h2>"; ?>
            </div>
            <div class="profile1">
                <label for="">Phone Number</label> <br>
                <?php echo "<h2>$phone</h2>"; ?>
            </div>
        </div>
        <div class="chechprofile">
            <div class="profile1">
                <label for="">Account created</label> <br>
                <?php echo "You created your account on <span>$date</span>"; ?>
            </div>
        </div>
    </div>
</body>
</html>