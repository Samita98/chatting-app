<?php
    include "connection.php";
    
   $serverName="localhost";
    if($_GET){
        $id = $_GET['id'];
        $sql = "DELETE  FROM admin  WHERE id = $id";
        // echo $sql;
        
        if(mysqli_query($conn, $sql)){
            header('Location:http://'.$serverName.'/chatting/adminfetch.php');
            exit();
        }
        else
        {
            echo "Error deleting record: " . $conn->error;
        }
        
    }
    mysqli_close($conn);
?>