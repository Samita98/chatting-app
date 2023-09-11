<?php
session_start();
include 'connection.php';
include'function.php';
$serverName="localhost";
if(!isset($_SESSION['userlist'])){
    $_SESSION['userlist']=array();
}
// Initialize an empty array to store user data
$userdata=array();
if($_POST)
{
   // Retrieve data from the POST request
    $email = $_POST['email'];
    $password = $_POST['password'];
     // Encryption setup
    $ciphering = "AES-128-CTR"; 
        $iv_length = openssl_cipher_iv_length($ciphering); 
        $options = 0; 
        $encryption_iv = '1234567891011121';//IVs should be unique and unpredictable for each encryption operation.
        $encryption_key = "a44afb0b6808d662";// is used for encryption. Keys should be kept secret and not hardcoded in the code. 
 // Encrypt the password
        $encryptedpswd = openssl_encrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);

 }
 if(empty($email) && empty($password))
 {
       header('location:http://'.$serverName.'/chatting/Login.php');

 }
 elseif (filter_var($email, FILTER_VALIDATE_EMAIL)) 
 {
      $sql =("SELECT * FROM tbl_users where email='$email' and password='$encryptedpswd'")  or die("failed to query database".mysqli_error());
        
           
           $result=mysqli_query($conn,$sql);
           
           $row=mysqli_fetch_array($result);

          if($row['email']==$email && $row['password']==$encryptedpswd)
           {
            $updateStatus="UPDATE tbl_users set status='1' where u_id =".$row['u_id'];
            mysqli_query($conn,$updateStatus);
                echo"<script>alert('Log In seccessfully!!!' );</script>";
                
                
                $userdata=array("fullname"=>$row['full_name'],
              "address"=>$row['address'],
                "email"=>$email,
              "user_id"=>$row['u_id'],
            "user_image"=>$row['user_image'],
          "status"=>$row['status']);

              
              if(!findUser($row['u_id']))
                {
                  array_push($_SESSION['userlist'],$userdata);
                }
           
            header('location:http://'.$serverName.'/chatting/index2.php?u_id='.$row['u_id']);
                           

           }
           else
           {
            
            echo "<script> alert('failed to login'); </script>";
            header('location:http://'.$serverName.'/chatting/Login.php');
            exit();
           }
   
 }
 
           
        else
        {

           $sql2 ="SELECT * FROM tbl_admins where full_name='$email' and password='$encryptedpswd'";
          
            
           $result2=mysqli_query($conn,$sql2);
          
            $row2=mysqli_fetch_array($result2);
            
            $admin  = Array('name' => $row2['full_name'],'password' => $row2['password'],'id' => $row2['id']);
           
            if($admin['name'] == $email && $admin['password']  == $encryptedpswd)
            {  
              $_SESSION['admin']=$email;
              $_SESSION['admin_id']=$admin['id'];
              header('location:http://'.$serverName.'/chatting/dashboardnavbar.php');
              exit();
            }
            else
               {
                echo "<script> alert('failed to login'); </script>";
                // header('location:http://localhost/chatting/Login.php');
                echo"error";
                exit();
               }

          }
 
 

   


   
?>
