<?php
    //including the configuration file.
    include 'connection.php';
    
    $serverName="localhost";
    // //If something has been posted from the form
    if($_POST){
        // print_r($_POST);
       $fullname = $_POST['full_name'];
       $password=$_POST['password'];
       $id = $_POST['id'];
        $sql = "UPDATE tbl_admins SET full_name = '$fullname',
         password = '$password' WHERE id = '$id'";
        if(mysqli_query($conn, $sql)){
            echo "Record updated successfully.";
            header('Location: http://'.$serverName.'/chatting/adminfetch.php');
            mysqli_close($conn);
            
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    if($_GET){
        $id = $_GET['id'];
        $sql = "SELECT * FROM tbl_admins WHERE id = '$id'";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $admin = array(
                    "id" => $row['id'],
                    "fullname" => $row['full_name'],
                    "password" => $row['password'],
                    
                );
            }
        } 
          else {
          echo "No records found!!";
          exit;
        }
        
    }
    mysqli_close($conn);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>
      Fieldset and label example
    </title>
  </head>
  <body>
    <script>
        <script>
         function validation()
         {
          
            var full_name=document.forms['meroform']['full_name'];
            if(full_name.value=="")
            {
              alert('enter the fullname');
              full_name.focus();
              return false;
            }
            elseif(password.value=="")
            {
              alert('enter the password');
              password.focus();
              return false;
            }
            else
            {
              return true;
            }
         }
       </script>
  </head>
  <body>
    <form  name="meroform" id="myform" method="POST">
      <fieldset style="width:300px; height: 300px; background-color: beige;">
         <h1>Admin form</h1>
            <p>Admin_Name:</p>
           <input type="hidden" name="id" value="<?=$admin['id']?>" />
              <input
                type="text"
                name="full_name"
                id="full_name"
                value = "<?php echo $admin['fullname']?>"
                required
              /><br>
           <p>Password:</p>
           <input
                type="password"
                name="password"
                id="password"
                value = "<?=$admin['password']?>"
                required
              /><br>
           <button   id="sub" onclick="return validation();" >Submit</button>
        
      </fieldset>
     
    </form>
  </body>

  <style>
    #myform
    {
     margin-left: 500px;
     margin-top: 100px;
     

    
     
    }
    #myform h1
    {
      text-align: center;
      font-weight: bold;
      font-family: sans-serif;
    } 
    #myform p
    {
      font-size: 20px;
      font-weight: bold;
      font-family: sans-serif;
      margin-left:  13px;
     
    
    }
   input 
    {
      width: 270px;
      height: 30px;
      margin-top : -140px;
      margin-left: 40px;
      font-size: 20px;
      border: 3px solid black;
      border-radius: 44px;
      text-align: center;
      
      
    }
    
    input:hover
    {
      border-color: #ffc400ec; 
    }
    #sub
    {
      margin-top: 30px;
      margin-left: 100px;
      width: 120px;
      height: 40px;
      font-weight: bold;
      font-size: 20px;
      color: black;
      border: 3px solid black ;
      border-radius: 40px;
   
    }
    #sub:hover
    {
      background-color: black;
      color: white;
    }
    
  </style>
</html>
