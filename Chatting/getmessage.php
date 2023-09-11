<?php
include 'connection.php';
include 'function.php';
if($_GET)
{
    $fromuser_id=$_GET['fromuser_id'];
    $touser_id=$_GET['touser_id'];
    $output="";
    $key=null;
    $_SESSION['chat_message']="This message has been deleted!!!";
    function decrypthis($data,$key,$resulting)
    {
        $ciphering = "AES-128-CTR"; //Specifies the encryption algorithm and mode, in this case, "AES-128-CTR."
            
        $options = 0; // Encryption options, set to 0.
        $decryption_iv = '1234567891011121'; //The initialization vector (IV) used in the decryption process. It should be unique for each message and should not be hardcoded.
        $decryption_key = $resulting;//The key used for decryption, derived from the $resulting parameter.
        $key=openssl_decrypt($data,$ciphering, $decryption_key, $options, $decryption_iv);
        //This function is used to perform decryption using OpenSSL. It takes the input data, encryption algorithm, decryption key, options, and IV as parameters and returns the decrypted output.
        return $key;
    }
    $sql="Select * from tbl_message WHERE (fromuser_id=$fromuser_id && touser_id=$touser_id) 
    OR (fromuser_id=$touser_id && touser_id=$fromuser_id) ORDER BY msg_id ASC";
    
    $result=mysqli_query($conn,$sql);

    if(mysqli_num_rows($result)>0)
    {
        while($row=mysqli_fetch_array($result))
        { 
           if($row['fromuser_id']==$fromuser_id)
           {
            if($row['delete_status']=='2')
            {
                $output .= '<div class="message my_msg">
                    <p>'.$_SESSION['chat_message'].'</p>
            
               </div>';

            }
            else{
                $output .= '<div class="message my_msg">
                                <div class="delete_icon" id="'.$row['msg_id'].'">
                                    <h3><ion-icon name="trash-outline"></ion-icon></h3>
                                </div>
                                <p>'.decrypthis($row['messages'],$key,appendUserId($row['fromuser_id'],$row['touser_id'])).'<br><span>'.$row['date'].'</span></p>
                            
                               </div>';
           

            }
               
           }
          else{
            if($row['delete_status']=='2')
            {
                $output .= '<div class="message friend_msg">
                            <p>'.$_SESSION['chat_message'].'</span></p>
                            
                        </div>';
            }
            else{
                $output .= '<div class="message friend_msg">
                            <p>'.decrypthis($row['messages'],$key,appendUserId($row['fromuser_id'],$row['touser_id'])).'<br><span>'.$row['date'].'</span></p>
                            <div class="delete_icon" id="'.$row['msg_id'].'">
                                <h3><ion-icon name="trash-outline"></ion-icon></h3>
                            </div>
                        </div>';
                
            }
            
             } 
             
               
        }
           
        
    }
   
         
echo $output;
echo "<script>
        var touser_id=".$touser_id.";
        var fromuser_id=".$fromuser_id.";
        </script>";

}
    ?>
     <script>
        $(document).ready(function() {
            $(".delete_icon").click(function() {
                var msg_id=$(this).attr('id');
                if(confirm("Are you sure you want to delete this chat?"))
                {
                    $.ajax({
                    url:"deletemessage.php",
                    method:"POST",
                    data:{
                      msg_id:msg_id
                    },
                    success: function(data) {
                   displayDeleteMessage();
                
                    }
                  });
                //     

                }
               
            });
            function displayDeleteMessage()
            {
                var xhttp = new XMLHttpRequest();
                // // xhttp.responseType = 'json';
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        $('#chatbox').html(xhttp.response);
                    }
                };
                xhttp.open("GET", "viewdeletemessage.php?fromuser_id=" + fromuser_id + "&& touser_id=" + touser_id, true);
                xhttp.send();

            }
           
               
            
        });
        
               
    </script>
