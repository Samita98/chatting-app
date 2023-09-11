<?php
include 'connection.php';
include 'function.php';
if($_GET)// Check if there is a GET request
{
    $fromuser_id=$_GET['fromuser_id'];// Get the 'fromuser_id' from the GET parameters
    $touser_id=$_GET['touser_id'];// Get the 'touser_id' from the GET parameters
    $output="";// Initialize an empty variable to store the output
    $key=null;// Initialize a key variable to null
    $_SESSION['chat_message']="This message has been deleted!!!"; // Set a session message

    // Function to decrypt the messages
    function decrypthis($data,$key,$resulting)
    {
        $ciphering = "AES-128-CTR"; // Set the encryption method
            
        $options = 0; // Set encryption options
        $decryption_iv = '1234567891011121';// Set the decryption initialization vector
        $decryption_key = $resulting; // Set the decryption key
        $key=openssl_decrypt($data,$ciphering, $decryption_key, $options, $decryption_iv); // Decrypt the data
        return $key; // Return the decrypted data
    }
     // SQL query to retrieve chat messages
    $sql="Select * from tbl_message WHERE (fromuser_id=$fromuser_id && touser_id=$touser_id) 
    OR (fromuser_id=$touser_id && touser_id=$fromuser_id) ORDER BY msg_id ASC";
    
    $result=mysqli_query($conn,$sql);// Execute the SQL query

    if(mysqli_num_rows($result)>0)// Check if there are rows in the result
    {
        while($row=mysqli_fetch_array($result))// Loop through the rows
        { 
           if($row['fromuser_id']==$fromuser_id)// Check if the message is from the current user
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
                if($row['delete_status']=='2')// Check if the message is deleted
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
   
         
echo $output;// Output the chat messages
echo "<script>
        var touser_id=".$touser_id.";
        var fromuser_id=".$fromuser_id.";
        </script>";

}

    ?>
    <script>
        $(document).ready(function() {
            $(".delete_icon").click(function() {
                var msg_id=$(this).attr('id');// Get the message ID when the delete icon is clicked
                if(confirm("Are you sure you want to delete this chat?"))// Confirm deletion
                {
                    $.ajax({
                    url:"deletemessage.php",
                    method:"POST",
                    data:{
                      msg_id:msg_id
                    },
                    success: function(data) {
                   displayDeleteMessage();// Display deleted message
                
                    }
                  });
                //     

                }
               
            });
            function displayDeleteMessage()// Function to display deleted message
            {
                var xhttp = new XMLHttpRequest();// Create an XMLHttpRequest object
                // // xhttp.responseType = 'json';
                xhttp.onreadystatechange = function() {// Define a function to handle the response
                    if (this.readyState == 4 && this.status == 200) {
                        $('#chatbox').html(xhttp.response);// Update the chatbox with the deleted message
                    }
                };
                xhttp.open("GET", "viewdeletemessage.php?fromuser_id=" + fromuser_id + "&& touser_id=" + touser_id, true); // Send a GET request to view deleted messages
                xhttp.send();// Send the request

            }
            
        });
       
               
    </script>
