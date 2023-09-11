<?php
    include "connection.php";
    $serverName="localhost";
   
    if($_GET){
        $u_id = $_GET['u_id'];// Get the user ID from the GET request parameter
        $sql = "DELETE  FROM tbl_users  WHERE u_id = $u_id";// Construct an SQL query to delete a user by their ID
        // echo $sql;
        if(mysqli_query($conn, $sql)){// Execute the SQL query to delete the user
            header('Location:http://'.$serverName.'/chatting/userfetch.php');// Redirect to "userfetch.php" after successful deletion
            exit();
        }
        else
        {
            echo "Error deleting record: " . $conn->error;// Print an error message if deletion fails
        }
        
    }
    mysqli_close($conn);
?>