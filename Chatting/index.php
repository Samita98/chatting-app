<?php
session_start();
include 'connection.php';
include 'function.php';
$serverName="localhost";

if($_GET)
{
    $u_id=$_GET['u_id'];
    if(findUser($u_id))
    {
        $userdetail=findUserDetail($u_id);

    }
}
?>

    

<!DOCTYPE html>
<html>

<head>


<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/23e469355a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="index1.css"/>

</head>

<body>

    <h2>Rounded Images</h2>

    <div class="card" style="width: 40rem;">
        <div id="row1" class="user1">
            <div class="imgs">
                <img src="<?=$userdetail['user_image']?>" alt="Avatar" style="width:100px">
            </div>
            <div class="text1">
                <p class="colname"><?=$userdetail['fullname']?></p>
                <p class="colname1"><?=$userdetail['user_id']==$u_id?'Active Now' :'Not Active'?></p>
            </div>
            <div class="logout">
                <a href="http://<?=$serverName?>/chatting/Logout.php?u_id=<?=$userdetail['user_id']?>">Log out</a>
            </div>
        </div>
        <div class="lining">
            <hr>
        </div>
        
        <div class="row2">
            <ul style="list-style: none;">
                <li><input id="search_text" type="text" placeholder="search name to chat" name="search_text" /></li>
                <li class="searchbtn">
                    <a href="Search.php">
                        <h3><i class="fas fa-search"></i></h3>
                    </a>
                </li>
            </ul>
        </div>
        <div class="col">
            <div class="row3" id="userlist">
                
            </div>
        </div>

    </div>
<p style="font-size:100px;"> version 1.0</p>
<table>
      <tr>
          <th>fullname</th>
      </tr>
      <?php foreach($_SESSION['userlist'] as $item ){ ?>
        <tr>
        <td><?=$item['fullname']?></td>
        </tr>
      
      
      
      
      <?php } ?>
    </table>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="js/jquery-3.6.0.js"></script>

<?php
echo "<script>
var u_id=".$userdetail['user_id'].";
</script>"?>
 <script src="js/main.js"></script>


 
</body>

</html>









<!DOCTYPE html>
<html>
    <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    </head>
    <body>
      <form method="POST" action="http://localhost/chatting/insert.php">
        <input type="text" name="from_id" placeholder="enter from_id" required/>
        <input type="text" name="message" placeholder="enter messages" required/>
        <input type="text" name="to_id" placeholder="enter to_id" required/>
        <button type="submit">Submit</button>
      </form>
    </body>

    
   
    
</html>
//nachahinya 
<a href="chatarea.php?touserid=<?=$row['u_id']?>&&fromuserid=<?=$u_id?>">
//     <div class="immg">
//         <img src="<?=$row['user_image']?>" alt="Avatar" style="width:100px">
//     </div>
//      <div class="text2">
//         <p class="colname2"><?=$row['full_name']?></p>
//          <p class="colnam3"><?=findUser($row['u_id'])==$row['u_id']?"Active Now" :"Not Active"?></p>
//      </div>
// </a>   $user = array(
                        "full_name" => $row['full_name'],
                        "address" => $row['address'],
                        "phone" => $row['phone'],
                        "user_image" =>$row['user_image'],



                        <?php
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
                        
                
                    );
                    } 
                    else
                    {
                        
                    }
                }
    ?>







<div class="rightSide" id="chatarea">
            <div class="header">
                <div class="imgText" id="userdata">
                    <div class="userimg">
                        <img id="personimg" src="" alt="" class="cover">
                    </div>
                    <h4><span id="personname"></span><br><span>hello</span></h4>
                </div>
                <ul class="nav_icons">
                    <li>
                    <div class="logout">
                        <a href="http://<?=$_serverName?>/chatting/Logout.php?u_id=<?=$userdetail['user_id']?>">Log out</a>
                    </div>
                    </li>
                    <li>
                        <ion-icon name="ellipsis-vertical"></ion-icon>
                    </li>
                </ul>
            </div>

            <!-- CHAT-BOX -->
            <div class="chatbox">
                <div class="message my_msg">
                    <p>Hi <br><span>12:18</span></p>
                </div>
                <div class="message friend_msg">
                    <p>Hey <br><span>12:18</span></p>
                </div>
                <div class="message my_msg">
                    <p>hello <br><span>12:15<ion-icon name="checkmark-done-outline"></ion-icon></span></p>
                </div>
                <div class="message friend_msg">
                    <p>how u doing?? <br><span>12:15</span></p>
                </div>
                <div class="message my_msg">
                    <p>Lorem ipsum dolor sit amet <br><span>12:15</span></p>
                </div>
                <div class="message friend_msg">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. <br><span>12:15</span></p>
                </div>
                <div class="message my_msg">
                    <p>Lorem ipsum dolor sit amet consectetur <br><span>12:15</span></p>
                </div>
                <div class="message friend_msg">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.<br><span>12:15</span></p>
                </div>
                <div class="message my_msg">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.<br><span>12:15</span></p>
                </div>
                <div class="message friend_msg">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.<br><span>12:15</span></p>
                </div>
                <div class="message my_msg">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.<br><span>12:15</span></p>
                </div>
                <div class="message friend_msg">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.<br><span>12:15</span></p>
                </div>
                <div class="message my_msg">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.<br><span>12:15</span></p>
                </div>
                <div class="message friend_msg">
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.<br><span>12:15</span></p>
                </div>

                <!-- CHAT INPUT -->
                <div class="chat_input">
                    <ion-icon name="happy-outline"></ion-icon>
                    <ion-icon name="attach-outline"></ion-icon>
                    <!-- <ion-icon name="happy-outline"></ion-icon> -->
                    <input type="text" placeholder="Type a message">
                    <ion-icon name="send-outline"></ion-icon>
                </div>
            </div>
            <div class="center" id="simpledata">

            </div>
            <div class="center" id="simpledata2">
            
            </div>
            
        </div>


        <a class="linkright" id="<?=$row['u_id']?>_<?=$u_id?>" href="index3.php?touserid=<?=$row['u_id']?>&&fromuserid=<?=$u_id?>">
                <div class="block active" id="content">
                
                    <div class="imgBox">
                        <img id="userimgg_<?=$row['u_id']?>_<?=$u_id?>" src="<?=$row['user_image']?>" class="cover" alt="Avatar" style="width:100px">
                    </div>
                    <div class="details">
                        <div class="listHead">
                            <h4 id="textname_<?=$row['u_id']?>_<?=$u_id?>"><?=$row['full_name']?></h4>
                        </div>
                        <div class="message_p">
                            <p><?=findUser($row['u_id'])==$row['u_id']?"Active Now" :"Not Active"?></p>
                        </div>
                    </div>
                  
                </div>
            </a> 
            <script>
        var touserid=0;
        var fromuserid=0;
    </script>


//activeuser
<?php foreach($_SESSION['userlist'] as $item ){ ?>
        <tr>
            <td><?=$item['fullname']?></td>
            <td><img src="<?=$item['user_image']?>"></td>
        </tr>
      <?php } ?>