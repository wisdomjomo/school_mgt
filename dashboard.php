<?php
include_once('stheader.php')
?>
<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title><?php echo "$username | dashboard"; ?></title>
   <link rel="stylesheet" href="stylying/account1.css"/>
</head>
<body>
        <div class="halfbody">
            <div>
                <?php
                echo "<h3 class='h3'>Welcome, <span>$username</span></h3>";
                ?>
                <p class="p">
                    We have lots of courses for you!
                </p>
                <div class="view">
                    <a href="stenroll.php"><button>View your enroll course</button></a>
                </div>
            </div>
            <div class="img"><img src="images/look.jpg" alt="" id="img"></div>
        </div>
    </div>
</body>
</html>