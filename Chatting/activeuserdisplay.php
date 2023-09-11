<?php
  include "connection.php";
   include "dashboardnavbar.php";
  $sql = "SELECT * FROM tbl_users WHERE status='1'";
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
  <!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css"> -->
  
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.css" />
  
     <link rel="stylesheet" type="text/css" href="userfetch.css">
      <script src="https://kit.fontawesome.com/0acf56a1e1.js" crossorigin="anonymous"></script>
     
  </head>
  <body>
  <table id="example" class="display" style="width:100%">
  <thead>
  <tr>
          <th>fullname</th>
          <th>User image</th>
      </tr>

  </thead>
      <tbody>
      <?php foreach($tbl_users as $index=> $users ){ ?>
        <tr>
            <td><?=$users['fullname']?></td>
            <td><img src="images/<?=$users['image']?>"></td>
        </tr>
      <?php } ?>
      </tbody>
    </table>
  </body>
  <!-- <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.11.5/datatables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap4.min.js">
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });
    </script>
</html>
