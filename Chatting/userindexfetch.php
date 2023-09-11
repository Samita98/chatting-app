<?php
session_start();
include 'connection.php';
include 'function.php'; 

    $u_id=$_GET['u_id'];// Get the user ID from the URL parameter
    $sql="select * from tbl_users where u_id!=$u_id ";// Query to select all users except the one with the provided ID
    $query=mysqli_query($conn,$sql);// Execute the SQL query and get the result

    
   

    if(mysqli_num_rows($query)>0)
    {
        $touserid=0;
        while($row=mysqli_fetch_array($query))
        { 
             // Loop through the retrieved users and display their information
            ?>
            <a class="linkright"  href="index3.php?touserid=<?=$row['u_id']?>&&fromuserid=<?=$u_id?>">
                <div class="block active" id="content">
                
                    <div class="imgBox">
                        <img src="images/<?=$row['user_image']?>" class="cover" alt="Avatar" class="cover">
                    </div>
                    <div class="details">
                        <div class="listHead">
                            <h4><?=$row['full_name']?></h4>
                        </div>
                        <div class="message_p">
                            <p><?=$row['status']=='1'?"Active Now" :"Not Active"?></p>
                        </div>
                    </div>
                  
                </div>
            </a> 
           
        <?php

        }
        
    }
     

?>

  
   

