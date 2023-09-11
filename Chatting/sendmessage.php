<?php
include 'connection.php';
include 'function.php';
if($_POST)
{
    $fromuser=$_POST['fromuser_id'];
    $message=$_POST['messages'];
    $touser=$_POST['touser_id'];
    //Generate a resulting key using the appendUserId function
    $resulting=appendUserId($fromuser,$touser);
    // Encryption setup
        $ciphering = "AES-128-CTR"; //Specifies the encryption algorithm and mode (AES-128-CTR).
        $options = 0; // Encryption options, set to 0.
        $encryption_iv = '1234567891011121'; //The initialization vector (IV) for encryption.
        $encryption_key = $resulting;//The key derived from the appendUserId function.
          // Encrypt the message
        $encryptedmsg = openssl_encrypt($message, $ciphering, $encryption_key, $options, $encryption_iv);//The message is encrypted using the openssl_encrypt function with the specified encryption parameters.


           // Insert the encrypted message into the database if it's not empty
    if(!empty($message))
    {
        $sql=mysqli_query($conn,"INSERT into tbl_message(fromuser_id,messages,touser_id) values('$fromuser',' $encryptedmsg','$touser')");
    }
    else{
        echo"message is empty";
    }
  
}
?>
