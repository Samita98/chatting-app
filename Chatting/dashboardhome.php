    <?php
include 'connection.php';
    include 'dashboardnavbar.php';

   

$sql="select count('u_id') from tbl_users";
$sql1="select count('status') from tbl_users where status='1'";

$result1=mysqli_query($conn,$sql1);
$row1=mysqli_fetch_array($result1);

$result=mysqli_query($conn,$sql);
$row=mysqli_fetch_array($result);

mysqli_close($conn);
 
            
  

?>
<!DOCTYPE html>
<html>
	<head>
		<style type="text/css">
            .tt
            {
                display: flex;
            }
            .ppp 
            {
                margin-left: 330px;
                margin-top: 100px;
                width: 20%;
                background-color: #D8C8DE;
                color: #1e272e;
                border:1px solid #F8EFBA;
                border-radius: 22px;
                box-shadow: 5px 10px 18px #888888;

                
            }
            .ppp td,th
            {
                
                padding: 10px 10px;
                text-align: center;
                font-size: 30px;
                font-family: sans-serif;
                font-weight: bold;
            }
            .ppp th
            {
                text-decoration: underline;
            }
            .ppp td
            {
                font-size: 60px;
            }
          
		</style>

	</head>
	<body>
        <div class="tt">
            <table class="ppp">
                <tr>
                    <th>
                         Number of User
                    </th>
                </tr>
                <tr>
                    <td> <?php echo "$row[0]";
            ?></td>
                </tr>
               
            </table>
           <table class="ppp">
               <tr>
                   <th>Active Users</th>
               </tr>
               <tr>
                   <td> <?php echo "$row1[0]";?></td>
               </tr>
           </table>
            
        </div>
	</body>
</html>
