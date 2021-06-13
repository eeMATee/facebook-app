<?php 

require 'config/config.php';
session_start();

        // Clearting SESSION values !! MAYBE WRONG PLACE TO CHECK !!
        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";
        unset($error_array);



// Declaring  variables 
$fname = "";    // First Name
$lname = "";    // Last Name
$em = "";   // Email
$em2 = "";  // Email Confirm
$password = "";     //Passowrd
$password2 = "";    //Password Confirm
$date = "";     // Date Sign Up
$error_array = array();  // Array of errors during registriation

if(isset($_POST['register_button'])) {

// Registration form values
    // First name
    $fname = strip_tags($_POST['reg_fname']); // remove html tags
    $fname = str_replace(' ', '', $fname);  // remove spaces
    $fname = ucfirst(strtolower($fname));  // lower casse letter then first capitalize
    $_SESSION['reg_fname'] = $fname;
    
    // Last name
    $lname = strip_tags($_POST['reg_lname']); // remove html tags
    $lname = str_replace(' ', '', $lname);  // remove spaces
    $lname = ucfirst(strtolower($lname));  // lower casse letter then first capitalize
    $_SESSION['reg_lname'] = $lname;

    // Email
    $em = strip_tags($_POST['reg_email']); // remove html tags
    $em = str_replace(' ', '', $em);  // remove spaces
    $em = ucfirst(strtolower($em));  // lower casse letter then first capitalize
    $_SESSION['reg_email'] = $em;

    // Email Confirm 
    $em2 = strip_tags($_POST['reg_email2']); // remove html tags
    $em2 = str_replace(' ', '', $em2);  // remove spaces
    $em2 = ucfirst(strtolower($em2));  // lower casse letter then first capitalize
    $_SESSION['reg_email2'] = $em2;

    // Password
    $password = strip_tags($_POST['reg_pass']); // remove html tags
    // Password Confirm
    $password2 = strip_tags($_POST['reg_pass2']); // remove html tags


    // Date
    $date = date("Y-m-d");      // Current date


        if($em == $em2) {
            // Check if email is in good form
            if(filter_var($em, FILTER_VALIDATE_EMAIL)) {
                // Email validation
                $em = filter_var($em, FILTER_VALIDATE_EMAIL);

                $query_email = "SELECT email FROM users WHERE email='$em'";

                // Check if email aready exist
                $e_check = mysqli_query($con, $query_email);
                // Count the number of returned rows
                $num_rows = mysqli_num_rows($e_check);
                if($num_rows > 0) {
                    array_push($error_array, "Email already registreted!<br>");
                }

            } else
            array_push($error_array, "Invalid email format<br>");
            

        } else
        array_push($error_array, "Emails don't match<br>");

// Values match check
    // First name check length
    if(strlen($fname) > 25 || strlen($fname) < 2) 
        array_push($error_array,  "Yours first name should have between 2 and 25 characters<br>");
    // Last name check length
    if(strlen($lname) > 25 || strlen($lname) < 2)
        array_push($error_array, "Yours last name should have between 2 and 25 characters<br>");

    // Password match check 
    if($password != $password2) {
        // Passord are not the same
        array_push($error_array, "Passwords are not the same!<br>");
    }
    else {
        $pattern = "#[^A-Za-z0-9]#";    // Chaarcters only avalible in password
        if(preg_match($pattern, $password)) {
            array_push($error_array, "Your passowrd isn't correct. Please use only a to z and 0 to 9<br>");
        }
    }
    // Lenth of password
    if(strlen($password) > 30 || strlen($password) < 5) {
        array_push($error_array, "Password should be between 5 and 30 characters long<br>");
    }




// Checking if error array is empty FINAL CHECK BEFORE REGISTRATON AND REGISTRATION
    if(empty($error_array)) {

        $password = md5($password); // Encrypt password before sending do DB

        // Generate user name by joining first name and last name
        $username = strtolower($fname . "_" . $lname);
        $username_query = "SELECT username FROM users WHERE username='$username'";
        $check_username = mysqli_query($con, $username_query);

        $i = 0;
        // if username already exist in DB add number to username
        while(mysqli_num_rows($check_username) !=0 ) {
            $i++;
            $username = $username . "_" . $i;
            $check_username = mysqli_query($con, $username_query); // repeats query if usernama with "i" is also in DB, while loop will loop till "i" will be not taken
        }

        // Profile picture assignment
        $rand = rand(1, 2);

        if($rand == 1)
            $profile_pic = "assets/images/profile_pics/defaults/default1.jpg";
        else if($rand == 2)
            $profile_pic = "assets/images/profile_pics/defaults/default2.jpg";


        $query_all = "INSERT INTO users VALUES('', '$fname', '$lname', '$username', '$em', '$password', '$date', '$profile_pic', '0', '0', 'yes', ',')";
        $query_final = mysqli_query($con, $query_all);
        // Message after completed registration
        array_push($error_array, "<span style='color: #14c800'>You are all set! Go and log in!</span><br>");

        // Clearting SESSION values
        $_SESSION['reg_fname'] = "";
        $_SESSION['reg_lname'] = "";
        $_SESSION['reg_email'] = "";
        $_SESSION['reg_email2'] = "";


    }   // End of if checkning errors array 
}

?>