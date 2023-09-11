<?php
  include "connection.php";
    include "dashboardnavbar.php";
    $serverName="localhost";

  $sql = "SELECT * FROM tbl_admins";
  
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      $i = 0;
      while($row = mysqli_fetch_assoc($result)) {
        $tbl_admins[$i] = array(
          "id" => $row['id'],
          "fullname"=>$row['full_name'],
          "admin_image"=>$row['admin_image'],
          "password"=>$row['password'],
        );
        $i++;
      }
  }




  if($_POST)
  {
     $fullname = $_POST['full_name'];
     $password = $_POST['password'];
     $admin_image=$_FILES['file']['name'];
     $ciphering = "AES-128-CTR"; 
        $iv_length = openssl_cipher_iv_length($ciphering); 
        $options = 0; 
        $encryption_iv = '1234567891011121';
        $encryption_key = "a44afb0b6808d662";

        $encryptedpswd = openssl_encrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);
        $folder="images/".$admin_image;

     $sql="insert into tbl_admins(full_name,admin_image,password)values('$fullname','$admin_image','$encryptedpswd')";
     if (mysqli_query($conn,$sql))
     {
      if(move_uploaded_file($_FILES["file"]["tmp_name"],$folder))
      {
          echo"image is successfully uploaded!!!!";
      }
      else{
          echo"image is not uploaded!!";
      }
       header('Location: http://'.$servername.'/chatting/adminfetch.php');
      }

  } 
  mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
  <head>
     
     <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>      <script src="https://kit.fontawesome.com/0acf56a1e1.js" crossorigin="anonymous"></script>
      <link rel="stylesheet" type="text/css" href="adminfetch.css">
  </head>
  <body>

    <div class="modal" tabindex="-1" id="modal_firm">
      <div class="modal-dialog" >
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Add Admin</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close"></button>
          </div>
          <div class="modal-body" id="modal-form">
            <form  name="meroform" id="myform" method="POST" action="adminfetch.php" enctype="multipart/form-data">
                        <p>Admin_Name:</p>
                        <input type="text" id="fullname" name="full_name" class="form-control">
                        <p>Image</p>
                        <input type="file" name="file" value=""/>
                        <p>Password:</p>
                        <input type="password" name="password" class="form-control">
                        <button type="submit" class="btn btn-primary" id="sub" onclick="return validation();" >Add data</button>
            </form>
          </div>
         
        </div>
      </div>
    </div>
    <button id="addadmin">Add Admin</button>
   
    
    <table >
        <tr>
            <th>S.N.</th>
            <th>Full_Name</th>
            <th>Image</th>
            <th>Password</th>
            <th>Update</th>
            <th>Delete</th>
        </tr>
        <?php foreach($tbl_admins as $index =>$admin){ ?>
        <tr>
            <td><?=$index + 1?></td>
            <td><?=$admin['fullname']?></td>
            <td><img src="images/<?=$admin['admin_image']?>"></td>
            <td><?=$admin['password']?></td>
            <td>
           
            <a href="http://<?=$serverName?>/chatting/admin_update.php?id=<?=$admin['id']?>" ><button type="button" class="btn btn-secondary">Edit</button></a>
            </td>
            <td>
            
                <a href="http://<?=$serverName?>/chatting/admin_delete.php?id=<?=$admin['id']?>"><button type="button" class="btn btn-danger">Delete</button></a>
            </td>
        </tr>
        <?php } ?>
    </table>
  </body>
  <script src="js/jquery-3.6.0.js"></script>
  <script src="js/myjQuery.js"></script>
</html>
