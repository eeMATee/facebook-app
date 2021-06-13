<?php

require 'config/config.php';

    if(isset($_POST['login_button'])) {
        

        // Sanitazing Email
        $email = filter_var($_POST['log_email'], FILTER_SANITIZE_EMAIL);
        // Store email into sessoin
        $_SESSION['log_email'] = $email;
        $password = md5($_POST['log_password']);

        $login_query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
        $check_database_query = mysqli_query($con, $login_query);

        $rows = mysqli_num_rows($check_database_query);

        if($rows == 1) {
                // all returned values from 1 row will give array with values from DB
                $row = mysqli_fetch_array($check_database_query);
                $username_row = $row['username'];
                $_SESSION['username'] = $username_row;

               
                
                // checking if user is loged out (user_closed DB)
                $user_closed = mysqli_query($con, "SELECT * FROM users WHERE email='$email' AND user_closed='yes'");

                if(mysqli_num_rows($user_closed) == 1) {
                    $update_query_status = "UPDATE users SET user_closed='no' WHERE email='$email'";
                    $reopen_account = mysqli_query($con, $update_query_status);
                    }


                // after loged in sets session variable and sends to index.php  
                header("Location: index.php"); 
                exit();

            } else {
                array_push($error_array, "Email or Password incorret!<br>");
       }
    }

?>