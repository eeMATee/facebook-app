
<?php 

require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/register_style.css">
    <script
			  src="https://code.jquery.com/jquery-3.5.1.min.js"
			  integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
              crossorigin="anonymous">
    </script>

    <title>Welcome !!</title>
</head>
<body>

    <?php   // cancelig after wrong registration going back to log in page
        if(isset($_POST['register_button'])) {
            echo '  
                <script>
                    $(document).ready(function(){
                        $("#first").hide();
                        $("#second").show();
                    });              
                </script>
            ';
        }
    ?>

    <div id="wrapper">

        <div class="login_box">

        <div class="login_header">
            <h2>FaceShit</h2>
            Login or sign up below!
        </div>
        
<!----------------------- LOGIN FORM ------------------------------>
        <div id="first">
            <form action="register.php" method="POST">
                <input type="email" name="log_email" placeholder="Email adress" value="<?php
                    if(isset($_SESSION['log_email'])) {
                        echo $_SESSION['log_email'];

                         // If isset then echo to value session value
                    }
                ?>" require ><br>
                <input type="password" name="log_password" placeholder="Password">
                <br>


                <input type="submit" name="login_button" value="Log in">
                <br>
                        <?php
                        if(in_array("Email or Password incorret!<br>", $error_array)) {
                                echo "Email or Password incorret!<br>";
                                unset($error_array["Email or Password incorret!<br>"]);
                            }
                      ?>
                <a href="#" id="signup" class="signup">Need an account? Register hier!</a>

            </form>
        </div>

            

<!------------------ REGISTRATION FORM -------------------------->
            <div id="second">
                <form action="register.php" method="POST">

                        <!-- First name -->
                    <input type="text" name="reg_fname" placeholder="First Name" value="<?php
                        if(isset($_SESSION['reg_fname'])) {
                            echo $_SESSION['reg_fname'];    // If isset then echo to value session value
                        }
                    ?>" required> 
                    <br>
                    <?php   if(in_array("Yours first name should have between 2 and 25 characters<br>", $error_array))
                                echo "Yours first name should have between 2 and 25 characters<br>"; ?>


                        <!-- Last name -->
                    <input type="text" name="reg_lname" placeholder="Last Name" value="<?php
                        if(isset($_SESSION['reg_lname'])) {
                            echo $_SESSION['reg_lname'];    // If isset then echo to value session value
                        }
                    ?>" required> 
                    <br>
                    <?php   if(in_array("Yours last name should have between 2 and 25 characters<br>", $error_array))
                                echo "Yours last name should have between 2 and 25 characters<br>"; ?>



                        <!-- Email -->
                    <input type="email" name="reg_email" placeholder="Email" value="<?php
                        if(isset($_SESSION['reg_email'])) {
                            echo $_SESSION['reg_email'];    // If isset then echo to value session value
                        }
                    ?>" required> 
                    <br>
                    <input type="email" name="reg_email2" placeholder="Confirm Email" value="<?php
                        if(isset($_SESSION['reg_email2'])) {
                            echo $_SESSION['reg_email2'];    // If isset then echo to value session value
                        }
                    ?>" required> 
                    <br>
                    <?php   if(in_array("Email aredy registreted!<br>", $error_array))
                                echo "Email aredy registreted!<br>";
                            else if(in_array("Invalid email format<br>", $error_array))
                                echo "Invalid email format<br>";                  
                            else if(in_array("Emails don't match<br>", $error_array))
                                echo "Emails don't match<br>"; 
                    ?>                    

                        <!-- Passwords -->
                    <input type="password" name="reg_pass" placeholder="Passowrd" required> 
                    <br>
                    <input type="password" name="reg_pass2" placeholder="Confirm Passowrd" required> 
                    <br>
                    <?php   if(in_array("Passwords are not the same!<br>", $error_array))
                                echo "Passwords are not the same!<br>";
                            else if(in_array("Your passowrd isn't correct. Please use only a to z   and 0 to 9<br>", $error_array))
                                echo "Your passowrd isn't correct. Please use only a to z and 0 to 9<br>";                  
                            else if(in_array("Password should be between 5 and 30 characters long<br>", $error_array))
                                echo "Password should be between 5 and 30 characters long<br>"; 
                    ?>  

                        <!-- Submit button -->
                    <input type="submit" name="register_button" value="Register">
                    <br>
                    <?php   if(in_array("<span style='color: #14c800'>You are all set! Go and log in!</span><br>", $error_array))
                                echo "<span style='color: #14c800'>You are all set! Go and log in!</span><br>";
                    ?>
                    <a href="#" id="signin" class="signin">Already have an account? Sign in here!</a>


                </form> 
            </div>


         </div>
    </div>
                    
    <script src="./assets/js/register.js"></script>
</html>