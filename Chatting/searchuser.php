<?php
session_start();
include 'connection.php';
include 'function.php'; 

if(isset($_POST["input"]))
{
 $search = mysqli_real_escape_string($conn, $_POST["input"]);// Get the search input and escape it to prevent SQL injection
 $query = "SELECT * FROM tbl_users WHERE full_name LIKE '%".$search."%'"; // Construct a SQL query to search for users by name
}
else
{
 $query = "SELECT * FROM tbl_users ORDER BY u_id";// If no search input, retrieve all users and order them by u_id
}

$result = mysqli_query($conn, $query);// Execute the SQL query
if(mysqli_num_rows($result) > 0)// Check if there are results from the query
{
 while($row = mysqli_fetch_array($result))// Loop through the results
 {?>
 // Display user information as links to index3.php, passing user IDs as parameters
     <a class="linkright"  href="index3.php?touserid=<?=$row['u_id']?>&&fromuserid=<?=$u_id?>">
                <div class="block active" id="content">
                
                    <div class="imgBox">
                        <img  src="images/<?=$row['user_image']?>" class="cover" alt="Avatar" class="cover">
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
else
{?>
    <div class="block active"  id="content">
        <p>Data is not Found!!!!</p>
</div>
        <?php
}

?>
