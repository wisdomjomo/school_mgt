<?php
// start a session
session_start();
// connect to the database
include_once("stdb.php");
$errors = [];
$file_error = "";
// check if the register button is clicked
if(isset($_POST['stsignup'])) {
    // create a function that eliminates script from fields

    // use remove_script function to remove scripts from fields
    $username = remove_script($_POST['username']);
    $firstname = remove_script($_POST['firstname']);
    $lastname = remove_script($_POST['lastname']);
    $password = remove_script($_POST['password']);
    $pass2 = remove_script($_POST['pass2']);
    $gender = remove_script($_POST['gender']);
    $email = remove_script($_POST['email']);
    $phone = remove_script($_POST['phone']);

    // check if any of the fields is empty and create appropriate error message
    if(empty($firstname)) {
        $errors[] = "Pls enter your first name";   
    } else $_SESSION['firstname'] = $firstname;
    if(empty($lastname)) {
        $errors[] = "Pls enter your last name";   
    } else $_SESSION['lastname'] = $lastname;
    if(empty($gender)) {
        $errors[] = "Pls select a gender";
    } else $_SESSION['gender'] = $gender;
    if(empty($username)) {
        $errors[] = "Pls enter a username";
    } else $_SESSION['gender'] = $username;
    if(empty($phone)) {
        $errors[] = "Pls enter your phone number";
    } else $_SESSION['phone'] = $phone;
    if(!empty($email) && !filter_var($email,FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Please enter a valid email";
    }
    if(empty($password)) {
        $errors[] = "Pls enter your password";
    } else $_SESSION['password'] = $password;
    if(empty($pass2)) {
        $errors[] = "Pls retype your password";
    }
	if(!empty($password) && strlen($password) < 6) {
		
		$errors[] = "Password must be minimum of 6 characters";
	}
	if(!empty($password) && $password != $pass2) {
		
		$errors[] = "Password and Confirm Password do not  match";
	}

    // check if the image is selected

    if(empty($_FILES['photo']['name'])) {
        $errors[] = "Pls select a photo";
    }


        // check if all is well 
   

        $file_upload_error = false;

        // collect the data from the $_FILES global variable
        $file_name = $_FILES['photo']['name'];
        $tmp_name = $_FILES['photo']['tmp_name'];
        $file_error = $_FILES['photo']['error'];
        $file_size = $_FILES['photo']['size'];
        $file_type = $_FILES['photo']['type'];
    
        $fileExt = explode('.',$file_name);
        $fileActualExt = strtolower(end($fileExt));
        $allowed = ['jpg','jpeg','png'];
    
        $_SESSION['filename'] = $file_name;
        // check for correct file 
        $upload_ok = false;
        if(in_array($fileActualExt,$allowed)) {
            if($file_error === 0) {
                if($file_size <= 300000) {
                    $fileNameNew = uniqid('',true).".".$fileActualExt;
                    $upload_ok= true;
                   
                } else {
                    $errors[] = "The file size is too big. required <= 100kb";
                    $file_upload_error = true;
                }
            }else {
                $errors[] = "An error occured while uploading photo";
                $file_upload_error = true;
            }
        } else {
            if(!empty($_FILES['photo']['name'])) {
            $errors[] = "File type is not supported";
            $file_upload_error =true;
            }
        }
        // check if there is an error during upload
     if(count($errors) == 0 && $file_upload_error === false) {
         // check if there is a user with an already existing username
    $sql = "select * from student_info where username ='$username' and email ='$email'";
         // execute the query
         $result = mysqli_query($conn,$sql);
         // check if there is a record 
         if(mysqli_num_rows($result) > 0 ) {
             $_SESSION['user_exist'] = "The username or email already exist.";
             header("location:stregistration.php");
         } else {
             if($upload_ok) {
                $fileNameNew = $file_name;
                $file_dest = 'upload/'.$fileNameNew;
                move_uploaded_file($tmp_name, $file_dest);
             }
             // hash the password
            //  $hashed_pass = md5($password);
             // enter data into table
             $date = date('Y-m-d H:i:s');
             $sql = "INSERT INTO student_info values (null,'$firstname','$lastname','$gender','$username', '$phone','$email','$password','$file_dest', '$date')";
             // run the query against the table
             if(mysqli_query($conn,$sql)) {
                $_SESSION['success'] = "You have successfully registered.";
                 header("location:stlogin.php");
             }else {
  $_SESSION['register_error'] = "Error registering you".mysqli_error($conn);
                 header("location:stregistration.php");
             }
         }
     } else {
         $_SESSION['errors'] = $errors;
         $_SESSION['upload_errors']  = $file_error;
         header("location:stregistration.php");
     }
}
function remove_script($data) {
      global $conn;
    $result = mysqli_real_escape_string($conn,$data);
    return $result;
}
?>