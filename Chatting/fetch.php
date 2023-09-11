<?php
  include "connection.php";
  include 'function.php';
$key=null;
// $resulting=appendUserId($from_id,$to_id);
function decrypthis($data,$key,$resulting)
{
    $ciphering = "AES-128-CTR"; 
        
    $options = 0; 
    $decryption_iv = '1234567891011121';
    $decryption_key = $resulting;
    $key=openssl_decrypt($data,$ciphering, $decryption_key, $options, $decryption_iv);
    return $key;
}



       

  $sql = "SELECT * FROM tbl_msg";
  $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
      $i = 0;
      while($row = mysqli_fetch_assoc($result)) {
        $admins[$i] = array(
          "id" => $row['id'],
          "from_id"=>$row['from_id'],
          "message"=>decrypthis($row['message'],$key,appendUserId($row['from_id'],$row['to_id'])),
          "to_id"=>$row['to_id'],
          
        );
        $i++;
      }
  }
?>

<!DOCTYPE html>
<html>
  <head>
     
  </head>
  <body>
   
    
    <table >
        <tr>
            <th>S.N.</th>
            <th>from_id</th>
            <th>messages</th>
            <th>to_id</th>
            <th>delete</th>
           
        </tr>
        <?php foreach($admins as $index =>$admin){ ?>
        <tr>
            <td><?=$index + 1?></td>
            <td><?=$admin['from_id']?></td>
            <td><?=$admin['message']?></td>
            <td><?=$admin['to_id']?></td>
            <td><button id="<?=$admin['id']?>" class="delete_icon">delete</button></td>
            
        </tr>
        <?php } ?>
    </table>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="js/jquery-3.6.0.js"></script>
         <script>
        $(document).ready(function() {
            $(".delete_icon").click(function() {
                var id=$(this).attr('id');
                if(confirm("Are you sure you want to delete this chat?"))
                {
                  $.ajax({
                    url:"deletemessage.php",
                    method:"POST",
                    data:{
                      id:id
                    }
                  })
                }
               
            });
            
        });
        
    </script>

  </body>
  <style type="text/css">
    
     table,tr,th,td
    {
      margin-top: 60px;
      border:1px solid black;
    }
    table  a
       {
        color: black;
       }
  </style>
</html>
