<?php
session_start();
    include 'connection.php';
    include 'function.php';
    if($_GET)
    {
        $touser_id=$_GET['touserid'];
        $fromuser_id=$_GET['fromuserid'];
        $sql="Select * from user where u_id=".$touser_id;
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
    }
  

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/23e469355a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="indexstyle2.css"/>

</head>

<body>
    <div class="card" >
        <div class="card-body">
            <div class="container">
                <div class="row shadow-sm p-3 mb-5 bg-body rounded">
                    <div class="col col-lg-2 col-md-4 img-arrow">
                        <a href="index.php?u_id=<?=$fromuser_id?>"> <h2><i class="fa-solid fa-arrow-left-long"></i></h2></a>
                    </div>
                    <div class="col-md-1">
                    <img src="<?=$user['user_image']?>" alt="Avatar" style="width:100px">
                    </div>
                    <div class="col-md-1">
                        <div class="col-naming">
                            <?=$user['full_name']?>
                        </div>
                        <div class="col-naming2">
                        <?=findUser($touser_id)==$touser_id?'Active Now' :'Not Active'?> 
                        </div>
                    </div>
                </div>
                <div class="chatarea" id="chatbox">

                </div>
            </div>
        </div>
        <form class="type-area">
            <input type="hidden" name="fromuser_id" id="fromuser_id" value="<?=$fromuser_id?>">
            <input type="hidden" name="touser_id" id="touser_id" value="<?=$touser_id?>">
            <input type="text" name="messages" id="messages" placeholder="type a message">
            <button type="submit" id="send_msg_btn"><i class="fab fa-telegram-plane"></i></button>
        </form> 
    </div>


    <script src="js/jquery-3.6.0.js"></script>
    <script src="js/sendmessage.js"></script>
<?php
echo "<script>
var fromuser_id=".$fromuser_id.";
var touser_id=".$touser_id.";
</script>"?>



</body>

</html>