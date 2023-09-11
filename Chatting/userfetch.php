<?php
  include "connection.php";
   include "dashboardnavbar.php";
   $serverName="localhost";
   // Query to retrieve user information from the database
  $sql = "SELECT * FROM tbl_users";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      $i = 0;
      while($row = mysqli_fetch_assoc($result))
       {
        $tbl_users[$i] = array(
          "u_id" => $row['u_id'],
          "fullname"=>$row['full_name'],
          "address"=>$row['address'],
          "phone"=>$row['phone'],
          "email"=>$row['email'],
          "image"=>$row["user_image"],
          "date_of_birth"=>$row['date_of_birth'],
          "password"=>$row['password'],
        );
        $i++;
       
      }
  
    } 
    // $userinfo=$_SESSION['arayname'];
    // print_r($_SESSION['userlist']);
  mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
  <head>
     <link rel="stylesheet" type="text/css" href="userfetch.css">
      <script src="https://kit.fontawesome.com/0acf56a1e1.js" crossorigin="anonymous"></script> 
  </head>
  <body>
  <table id="example" class="display" >
   <thead>
            <tr>
                <th>S.N.</th>
                <th>Full Name</th>
                <th>Address</th>
                <th>Phone Number</th>
                <th>Email</th>
                <th>Date OF Birth</th>
                <th>Password</th>
                <th>Image</th>
                <th>Update</th>
                <th>Delete</th>
            </tr>
   </thead>     
        
    <tbody>
    <?php foreach($tbl_users as $index =>$user){ ?>
    <tr>
            <td><?=$index + 1?></td>
            <td><?=$user['fullname']?></td>
            <td><?=$user['address']?></td>
            <td><?=$user['phone']?></td>
            <td><?=$user['email']?></td>
            <td><?=$user['date_of_birth']?></td>
            <td><?=$user['password']?></td>
            <td><img src="images/<?=$user['image']?>"></td>
            <td>
                <a href="http://<?=$serverName?>/chatting/user_update.php?u_id=<?=$user['u_id']?>"><i class="fas fa-upload"></i></a>
            </td>
            <td>
                <a href="http://<?=$serverName?>/chatting/user_delete.php?u_id=<?=$user['u_id']?>"><i class="fas fa-envelope-open-text"></i></a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
    </table>
  </body>
  <link rel="stylesheet" href=" https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
          // Initialize DataTable for table with id 'example'
            $('#example').DataTable();
        });
    </script>
</html>
