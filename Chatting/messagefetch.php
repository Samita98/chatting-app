<?php
  include "connection.php";
 include "dashboardnavbar.php";
 $serverName="localhost";
 // SQL query to select all messages from the tbl_message table, ordered by msg_id
$sql1= "SELECT * FROM tbl_message ORDER BY msg_id ASC"; 
 $result1= mysqli_query($conn, $sql1);
  if (mysqli_num_rows($result1) > 0) {
      $i = 0;
      // Loop through the results and store them in an array
      while($row = mysqli_fetch_assoc($result1))
       {
        $usermessage[$i] = array(
          "msg_id" => $row['msg_id'],
          "fromuser_id"=>$row['fromuser_id'],
          "messages"=>$row['messages'],
          "touser_id"=>$row['touser_id'],
          "date"=>$row['date'],
        );
        $i++;
       
      }
  
    } 

// SQL query to join tbl_message and tbl_users on touser_id, ordered by msg_id
$sql2="SELECT * FROM tbl_message INNER JOIN tbl_users ON tbl_message.touser_id=tbl_users.u_id ORDER BY msg_id ASC";

$result2= mysqli_query($conn, $sql2);
 
if (mysqli_num_rows($result2) > 0 ) {
    $i = 0;
    
    // Loop through the results and store user information in an array
    while($row2 = mysqli_fetch_assoc($result2)) {
      $userinfo[$i] = array($row2['full_name']);
      $i++;
      
    }
} 
// print_r($userinfo);

// SQL query to join tbl_message and tbl_users on fromuser_id, ordered by msg_id
$sql3="SELECT * FROM tbl_message INNER JOIN tbl_users ON tbl_message.fromuser_id=tbl_users.u_id ORDER BY msg_id ASC";

$result3= mysqli_query($conn, $sql3);
 
if (mysqli_num_rows($result3) > 0 ) {
    // output data of each row
    $i = 0;
    // Looping through the results
    while($row3 = mysqli_fetch_assoc($result3)) {
      $userinfo1[$i] = array($row3['full_name']);
      $i++;
     
    }
} 
// print_r($userinfo1);
  mysqli_close($conn);
?>
