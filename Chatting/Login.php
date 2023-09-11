<?php
	 // Start a PHP session
    session_start();   
     
    // Define the database server name (localhost)  
    $serverName="localhost";
    ?> 
    <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <!-- Include the Font Awesome icons -->
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
      <!-- Link to an external CSS file (style2.css) for styling -->
    <link rel="stylesheet" href="style2.css" />
    <title>Sign in & Sign up Form</title>
</head>

<body>
     <!-- Container for the forms and panels -->
    <div class="container">
         <!-- Container for sign-in and sign-up forms -->
        <div class="forms-container">
            <div class="signin-signup">
                  <!-- Sign-in form -->
                <form method="post" action="http://<?=$serverName?>/chatting/LoginCheck.php" class="sign-in-form">
                    <h2 class="title">Sign in</h2>
                      <!-- Input field for email -->
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="text" placeholder="samita@gmailcom" name="email">
                    </div>
                      <!-- Input field for password -->
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" placeholder="password" name="password">
                    </div>
                    <!-- Submit button for signing in -->
                    <input type="submit" value="Log In" class="btn solid" />
                </form>
                    <!-- Sign-up form -->
                <form method="post" action="http://<?=$serverName?>/chatting/userinsert.php" enctype="multipart/form-data" class="sign-up-form">
                    <h2 class="title">Sign up</h2>
                     <!-- Input field for full name -->
                    <div class="input-field">
                        <i class="fas fa-user"></i>
                       <input type="text" name="full_name" placeholder="fullname" ></br>
                    </div>
                    <!-- Input field for email -->
                    <div class="input-field">
                        <i class="fas fa-envelope"></i>
                        <input type="text"  placeholder="samitas@gmail.com" name="email" ></br>
                    </div>
                    <!-- Input field for address -->
                    <div class="input-field">
                        <i class="fas fa-address-book"></i>
                        <input type="text" name="address" placeholder="address"></br>
                    </div>
                     <!-- Input field for phone number -->
                    <div class="input-field">
                        <i class="fas fa-phone-alt"></i>
                        <input type="number" name="phone" placeholder="phone number"></br>
                    </div>
                     <!-- Input field for date of birth -->
                    <div class="input-field">
                        <i class="fas fa-calendar"></i>
                        <input type="date" name="date_of_birth"></br>
                    </div>
                     <!-- Input field for profile image -->
                    <div class="input-field">
                        <i class="fas fa-file-image"></i>
                        <input type="file" name="file" value="" id="img"/>
                    </div>
                       <!-- Input field for password -->
                    <div class="input-field">
                        <i class="fas fa-lock"></i>
                        <input type="password" name="password" placeholder="password"></br>
                    </div>
                    <input type="Submit" name="submit" class="btn" value="Sign Up"><!-- Submit button for signing up -->
                </form>
            </div>
        </div>
        <!-- Container for the sign-in and sign-up panels -->
        <div class="panels-container">
            <div class="panel left-panel">    <!-- Left panel for signing up -->
                <div class="content">
                    <h3>New here ?</h3>
                    <p> </p>
 <!-- Button to switch to the sign-up form -->
                    <button class="btn transparent" id="sign-up-btn">
              Sign up
            </button>
                <!-- </div>
                <img src="firstimage.png" class="image" alt="" />
            </div>  -->
            <div class="panel right-panel"> <!-- Right panel for signing in -->
                <div class="content">
                    <h3>One of us ?</h3>
                    <p>Register </p>
 <!-- Button to switch to the sign-in form -->
                    <button class="btn transparent" id="sign-in-btn">
              Sign in
            </button>
                <!-- </div>
                <img src="firstimage.png" class="image" alt="" />
            </div> -->
        </div>
    </div> 

    <script src="js/app.js"></script>   <!-- Include an external JavaScript file (app.js) for interaction -->
</body>

</html>