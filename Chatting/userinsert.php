<?php
    include 'connection.php';// Include a file for database connection
    $serverName="localhost";
    
    if($_POST)
    {
        $fullname = $_POST['full_name'];
         $address = $_POST['address'];
         $phone = $_POST['phone'];
         $date_of_birth = $_POST['date_of_birth'];
         $user_image=$_FILES['file']['name'];
        $email = $_POST['email'];
        $password =$_POST['password'];
   // Encryption parameters
        $ciphering = "AES-128-CTR"; 
        $iv_length = openssl_cipher_iv_length($ciphering); 
        $options = 0; 
        $encryption_iv = '1234567891011121';
        $encryption_key = "a44afb0b6808d662";

        $encryptedpswd = openssl_encrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);

        $folder="images/".$user_image;
       

        $count=0;
          // Validation checks for user input
        if (empty($fullname)) {
        echo"<script>alert('You forgot to enter your first name!'); window.history.back(); fullname.focus();</script>";
        
        $count++;
        }
        
        else if (empty($date_of_birth)) {
        echo"<script>alert('You forgot to enter your date of birth!');window.history.back();date_of_birth.focus();</script>";
        $count++;
        
        }
        else if (empty($phone)) {
            echo"<script>alert('You forgot to enter your phone number!');window.history.back();phone.focus();</script>";
            $count++;
            
            }
         else if(strlen($phone)!=10)
        {
             echo"<script>alert('enter a validate phone number!');
            location.href='http://'.$serverName.'/chatting/Registration.php';
             phone.focus();
            </script>";
        $count++;

        }

        else if (empty($email)) {
        echo"<script>alert('You forgot to enter your email!');window.history.back();
        date_of_birth.focus();</script>";
        
        $count++;
        }
        

       
        else if (empty($password)) {
       echo"<script>alert('You forgot to enter your password!');window.history.back();
       password.focus();</script>";
        
                $count++;
        }
         else if(strlen($password)!=6)
        {
             echo"<script>alert('enter a validate password!');
            location.href='http://'.$serverName.'/chatting/Registration.php';
             password.focus();
            </script>";
        $count++;

        }
        if($count==0)        
            {
                // Check if the email is already registered
                    $sql =("SELECT * FROM tbl_users where email='$email' ")  or die("failed to query database".mysqli_error());
                       
                       $result=mysqli_query($conn,$sql);
                       
                       $row=mysqli_fetch_array($result);
                      if($row['email']==$email)
                       {
                       echo"<script>alert('Account has been already Registered!!!' );</script>";
                        header('location:http://'.$serverName.'/chatting/Registration.php');


                       }
                       else
                       {
                            // Insert user data into the database
                            $sql = "INSERT into tbl_users (full_name,
                            address,phone,date_of_birth,email,user_image,password) VALUES ('$fullname','$address','$phone','$date_of_birth','$email','$user_image','$encryptedpswd')";
                            if(mysqli_query($conn, $sql))
                            {
                                 // Upload user's image
                                if(move_uploaded_file($_FILES["file"]["tmp_name"],$folder))
                                {
                                    echo"image is successfully uploaded!!!!";
                                }
                                else{
                                    echo"image is not uploaded!!";
                                }
                                
                             
                             header("location:http://".$serverName."/chatting/Login.php");
                             
                            }
                            else
                             {
                                echo"data is not inserted succesfully";
                            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                            header("Location:http://".$serverName."/chatting/Registration.php");
                            }
                        }
                
               }
             

        }
        
   
?>