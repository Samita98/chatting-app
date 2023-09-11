<?php
session_start(); // Start a PHP session
// Include necessary PHP files for database connection and functions
include 'connection.php';
include 'function.php';
$serverName="localhost";
if($_GET)
{
    $userid=$_GET['u_id'];// Get the user ID from the GET request parameter
    $updateStatus="UPDATE tbl_users set status='0' where u_id =".$userid;// Update the user's status to '0' to deactivate the account
    mysqli_query($conn,$updateStatus);
 // Loop through the userlist stored in the session
    for($i=0;$i<count($_SESSION['userlist']);$i++)
    {
                // Check if the current user's ID matches the deactivated user's ID
            if($_SESSION['userlist'][$i]["user_id"]==$userid)
                {
                    // Unset (remove) the deactivated user from the userlist in the session
                    unset($_SESSION['userlist'][$i]);
                    // Unset (remove) the deactivated user from the userlist in the session
                    $_SESSION['userlist']=array_values(array_filter($_SESSION['userlist']));
                    
                }
    }
     // Redirect the user to the Login page after deactivation
    header('location:http://'.$serverName.'/chatting/Login.php');
        


}


?>