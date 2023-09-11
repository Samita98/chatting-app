<?php
session_start();
    include 'connection.php';
    include 'function.php';
    if($_GET)
    {
        $touser_id=$_GET['touserid'];
        $fromuser_id=$_GET['fromuserid'];
        $sql="Select * from tbl_users where u_id=".$touser_id;
        $result=mysqli_query($conn,$sql);
        $row=mysqli_fetch_assoc($result);

        // $row=mysqli_fetch_assoc($result);
    	if (mysqli_num_rows($result)>0) {
          
            $user = array(
             "full_name" => $row['full_name'],
             "address" => $row['address'],
             "phone" => $row['phone'],
             "user_image" =>$row['user_image'],
             "status"=>$row['status'],           
    
        );
  	    } 
    }
  

?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="style4.css">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/23e469355a.js" crossorigin="anonymous"></script>
    
    </head>
    <body>
        <div class="container">
            <div class="rightSide" id="chatarea">
                <div class="header2">
                <div class="img-arrow">
                            <a href="index2.php?u_id=<?=$fromuser_id?>"> <h4><i class="fa-solid fa-arrow-left-long"></i></h4></a>
                        </div>
                    <div class="imgText" id="userdata">
                        <div class="userimg">
                            <img src="images/<?=$user['user_image']?>" alt="" class="cover">
                        </div>
                        <h4><?=$user['full_name']?><br><span><?=$user['status']=='1'?'Active Now' :'Not Active'?> </span></h4>
                    </div>
                </div>

                <!-- CHAT-BOX -->
                <div id="chatbox">
                                      
                
                </div>
                <!-- CHAT INPUT -->
                <div class="chat_input">
                    
                        <ion-icon name="happy-outline"></ion-icon>
                        <ion-icon name="attach-outline"></ion-icon>
                        <input type="hidden" name="fromuser_id" id="fromuser_id" value="<?=$fromuser_id?>">
                        <input type="hidden" name="touser_id" id="touser_id" value="<?=$touser_id?>">
                        <!-- <ion-icon name="happy-outline"></ion-icon> -->
                        <input type="text" id="messages" placeholder="Type a message">
                        
                        <ion-icon name="send-outline" id="send_msg_btn"></ion-icon>
                    
                    </div>
            </div>

        </div>
    
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
        <script src="js/jquery-3.6.0.js"></script>
        <script src="js/sendmessage.js"></script>
        <?php
        echo "<script>
        var fromuser_id=".$fromuser_id.";
        var touser_id=".$touser_id.";
        </script>"?>
    </body>
</html>


    