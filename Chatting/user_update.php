<?php
       include 'connection.php';
       $serverName="localhost";
    if($_POST){
         // Retrieve form data from POST request
       $fullname = $_POST['full_name'];
        $address = $_POST['address'];
         $phone = $_POST['phone'];
         $date_of_birth = $_POST['date_of_birth'];
        $email = $_POST['email'];
        $user_image=$_FILES['file']['name'];
        $password =$_POST['password'];
        $u_id = $_POST['u_id'];
// Encryption settings
        $ciphering = "AES-128-CTR"; 
        $iv_length = openssl_cipher_iv_length($ciphering); 
        $options = 0; 
        $encryption_iv = '1234567891011121';
        $encryption_key = "a44afb0b6808d662";
         // Encrypt the password
       $encryptedpswd = openssl_encrypt($password, $ciphering, $encryption_key, $options, $encryption_iv);
// Define the folder to store uploaded images
        $folder="images/".$user_image;
         // Construct an SQL query to update user information
        $sql = "UPDATE tbl_users SET full_name = '$fullname',
         address='$address',phone='$phone',date_of_birth='$date_of_birth',email='$email',user_image='$user_image',password='$encryptedpswd' WHERE u_id = $u_id";
        if(mysqli_query($conn, $sql)){
          // If the update is successful and the image is uploaded, display success messages
          if(move_uploaded_file($_FILES["file"]["tmp_name"],$folder))
            {
              echo"image is successfully uploaded!!!!";
            }
             else{
                   echo"image is not uploaded!!";
                  }
            echo "Record updated successfully.";
            header('Location: http://'.$serverName.'/chatting/userfetch.php');// Redirect to "userfetch.php" after successful update
            
            mysqli_close($conn);
            
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);// Print an error message if the update fails
          
        }
    }
    if($_GET){
        $u_id = $_GET['u_id'];
       // Construct an SQL query to select user information by user ID
        $sql = "SELECT * FROM tbl_users WHERE u_id = '$u_id'";
   
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while($row = mysqli_fetch_assoc($result)) {
                $tbl_user = array(
                    "u_id" => $row['u_id'],
                    "fullname" => $row['full_name'],
                    "address" => $row['address'],
                    "phone" => $row['phone'],
                    "date_of_birth" => $row['date_of_birth'],
                    "user_image"=>$row['user_image'],
                    "email"=>$row['email'],
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
         function validation()
         {
            var fullname=document.forms['meroform']['full_name'];
            var address=document.forms['meroform']['address'];
            var phone=document.forms['meroform']['phone'];
            var date_of_birth=document.forms['meroform']['date_of_birth'];
            var email=document.forms['meroform']['email'];
            var password=document.forms['meroform']['password'];
            if(fullname.value=="")
            {
              alert('enter the full name');
              return false;
            }
            else if(address.value=="")
            {
               alert('enter the address name');
              return false;
            }
             else if(is_numeric(phone.value))
            {
               alert('enter the validate phone');
              return false;
            }
            else if(phone.value.length!<=10)
            {
              alert('enter the validate number');
              return false;
            }
            else if(phone.value=="")
            {
               alert('enter the  phone');
              return false;
            }
            else if(email.value=="")
            {
               alert('enter theemail');
              return false;
            }
            else if(password.value=="")
            {
               alert('enter the password');
              return false;
            }
            else
            {
              return true;
            }
         }
       </script>
    <form name="meroform" id="myform" method="POST" enctype="multipart/form-data" >
      <fieldset style="width:400px; height: 680px; background-color: beige;">
         <h1>User Form</h1>
            <h2>Full Name:</h2>
           <input type="hidden" name="u_id" value="<?=$tbl_user['u_id']?>" />
              <input
                type="text"
                name="full_name"
                id="fullname"
                value = "<?=$tbl_user['fullname']?>"
                required
              /><br>
              <h2>Address:</h2>
             <input
                type="text"
                name="address"
                id="address"
                value = "<?=$tbl_user['address']?>"
                required
              /><br>
               <h2>Phone No:</h2>
             <input
                type="number"
                name="phone"
                id="phone"
                value = "<?=$tbl_user['phone']?>"
                required
              /><br>
              <h2>Date Of Birth:</h2>
              <input
                type="date"
                name="date_of_birth"
                id="date_of_birth"
                value = "<?=$tbl_user['date_of_birth']?>"
                required
              /><br>
              
               <h2>Email:</h2>
             <input
                type="text"
                name="email"
                id="email"
                value = "<?=$tbl_user['email']?>"
                required
              /><br>

              <h2>Image</h2>
              <input type="file"
               name="file"
                value= "<?=$tbl_user['user_image']?>"
                required/><br/>

               <h2>Password:</h2>

             <input
                type="password"
                name="password"
                id="password"
                value = "<?=$tbl_user['password']?>"
                required
              /><br>
          
           <button   id="sub"  onclick="return validation();">Submit</button>
        
      </fieldset>
     </form> 
  </body>

  <style>
    #myform
    {
     margin-left:450px;
     margin-top: 60px;
     

    
     
    }
    #myform h1
    {
      text-align: center;
      font-weight: bold;
      font-family: sans-serif;
    } 
    #myform h2
    {
      font-size: 20px;
      font-weight: bold;
      font-family: sans-serif;
      margin-left:  13px;
     
    
    }
   input 
    {
      width: 300px;
      height: 40px;
      margin-top : -140px;
      margin-left: 40px;
      font-size: 20px;
      border: 3px solid black;
      border-radius: 44px;
      text-align: center;
      
      
    }
    select
    {
      width: 298px;
      font-size: 25px;
      margin-top: -1000px;
      margin-left: 40px;
      text-align-last: center;

    }
    option
    {
      font-size: 25px;
      direction: ;
    }
    input:hover
    {
      border-color: #ffc400ec; 
    }
    #sub
    {
      margin-top: 30px;
      margin-left: 100px;
      width: 140px;
      height: 50px;
      font-weight: bold;
      font-size: 22px;
      color: black;
      border: 3px solid black ;
      border-radius: 40px;
   
    }
    #sub:hover
    {
      background-color: #ffc400ec;
    }
    
  </style>
</html>
