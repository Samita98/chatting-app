<?php
include 'connection.php';
session_start();
$serverName="localhost";
if(!isset( $_SESSION['admin']))
{
	header('location:http://'.$serverName.'/chatting/Login.php');
}
else{
    $id=$_SESSION['admin_id'];
    $sql="Select * from tbl_admins where id='$id'";
    $result=mysqli_query($conn,$sql);
     $row=mysqli_fetch_assoc($result);
}
 
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
        <title>Dashboard</title>
        <link rel="stylesheet" href="style1.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.0-2/css/all.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
    </head>
    <body>

        <!--wrapper start-->
        <div class="wrapper">
            <!--header menu start-->
            <div class="header">
                <div class="header-menu">
                    <div class="title">Realtime Chat Application</div>
                    <div class="sidebar-btn">
                        <i class="fas fa-bars"></i>
                    </div>
                    <ul>
                        
                        <li><a href="http://<?=$serverName?>/chatting/sessiondestroyer.php"><i class="fas fa-power-off"></i></a></li>
                    </ul>
                </div>
            </div>
            <!--header menu end-->
            <!--sidebar start-->
            <div class="sidebar">
                <div class="sidebar-menu">
                    <center class="profile">
                        <img src="images/<?=$row['admin_image']?>" alt="">
                        <p><?=$row['full_name']?></p>
                    </center>
                    <li class="item">
                        <a href="http://<?=$serverName?>/chatting/dashboardhome.php" class="menu-btn">
                            <i class="fas fa-desktop"></i><span>Home</span>
                        </a>
                    </li>
                    <li class="item" id="profile">
                        <a href="http://<?=$serverName?>/chatting/userfetch.php" class="menu-btn">
                            <i class="fas fa-user-circle"></i><span>User Info </span>
                        </a>
                    </li>
                    <li class="item" id="profile">
                        <a href="http://<?=$serverName?>/chatting/activeuserdisplay.php" class="menu-btn">
                            <i class="fas fa-user-circle"></i><span>Active User </span>
                        </a>
                    </li>
                    <li class="item" id="profile">
                        <a href="http://<?=$serverName?>/chatting/adminfetch.php" class="menu-btn">
                            <i class="fas fa-user-circle"></i><span>Admin Info </span>
                        </a>
                    </li>
                    <li class="item" id="messages">
                        <a href="http://<?=$serverName?>/chatting/messagefetchdata.php" class="menu-btn">
                            <i class="fas fa-envelope"></i><span>Messages Info</span>
                        </a>
                    </li>
                </div>
            </div>
            
        </div>
        <!--wrapper end-->

        <script type="text/javascript">
        $(document).ready(function(){
            $(".sidebar-btn").click(function(){
                $(".wrapper").toggleClass("collapse");
            });
        });
        </script>

    </body>
</html>
      
