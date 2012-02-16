<?php
error_reporting(0);
require_once 'inc/conn.php';
require_once ("inc/user.php"); 
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Đại siêu thị di động Mobimart</title>
    </head>
    <body style="padding: 0; margin: 0; text-align: center;">
        <?php
        $numberOfPos = 48;
        
        if (isset($_POST['btnSubmit'])) {
        	$pos = 'MOBILE '.$_POST['cboPos'];
            $link = $_POST['link'];
            $type = $_POST['type'];
            // Upload file to server:
            $info = pathinfo($_FILES["myFile"]['name']);
            $fileName =  time().'.'.$info['extension']; //basename($_FILES["myFile"]["name"]);
            $dir=dirname(__FILE__)."/celldata/";
            $file= $dir.$fileName;

            if (move_uploaded_file($_FILES["myFile"]["tmp_name"], $file))
            {
            	$sql = "SELECT count(*) FROM `banner_gateway` WHERE pos='$pos'";
            	$result = mysql_query($sql);
            	$total = mysql_fetch_row($result);
            	if ($total[0] > 0 ){
            		$sql = "SELECT id, file FROM `banner_gateway` WHERE pos='$pos'";
	            	$rs = mysql_query($sql);
	            	while ($row = mysql_fetch_assoc($rs)) {
						if(file_exists($dir.$row['file'])) {
						   @unlink($dir.$row['file']);
						}
					    mysql_query("DELETE FROM banner_gateway WHERE id=".$row["id"]);
					}
	                mysql_query(
	                    "INSERT INTO `banner_gateway` (`file`, `pos`, `link`, `type`) VALUES ('celldata/".$fileName."', '".$pos."', '".$link."', ".$type.");"
	                );
	                echo "<br /><font color='green'>Upload file success full !</font><br />";
            	}else{
            		mysql_query(
	                    "INSERT INTO `banner_gateway` (`file`, `pos`, `link`, `type`) VALUES ('celldata/".$fileName."', '".$pos."', '".$link."', ".$type.");"
	                );
	                echo "<br /><font color='green'>Upload file success full !</font><br />";
            	}
            }
            else
            {
                echo "<br /><font color='red'>Error uploading file. :|</font><br />";
            }
        }
        ?>
        <div style="width: 500px; margin: 0 auto; text-align: left; padding-top: 100px;">
        	<div style="background: #eee; border: 1px solid #ccc; border-radius:5px; -moz-border-radius:5px; -webkit-border-radius:5px; padding: 10px 20px; font-size:12px; font-family:Arial, Tahoma, Verdana;">
        		<?php
        		ob_start();
				session_start();
				
				$returnurl = urlencode(isset($_GET["returnurl"])?$_GET["returnurl"]:"");
				if($returnurl == "")
				    $returnurl = urlencode(isset($_POST["returnurl"])?$_POST["returnurl"]:"");
				
				$do = isset($_GET["do"])?$_GET["do"]:"";
				
				$do = strtolower($do);
				
				switch($do)
				{
				case "":
				    if (checkLoggedin())
				    {
				        echo '<h3 style="text-align:center; color:#666;">Bạn đã đăng nhập trong hệ thống - <a href ="admin_gateway.php?do=logout">logout</a></h3>';
				        ?>
				        <form action="" method="POST" enctype="multipart/form-data">
				            Cell: 
				            <br />
				            <select name="cboPos">
				            	<option value="0">Background page</option>
				                <?php 
				                for ($i=1; $i<=$numberOfPos; $i++) {
				                ?>
				                <option value="<?php echo($i); ?>">Cell <?php echo($i); ?></option>
				                <?php 
				                }
				                ?>
				            </select>
				            <br /><br />
				            Image, flash or video:<br />
				            <input type="file" name="myFile" />
				            <br /><br />
				            Link:<br />
				            <input type="text" name="link" />
				            <br /><br />
				            Type:<br />
				            <select name="type">
				            	<option value="0">Redirect</option>
				            	<option value="1">Popup</option>
				            </select>
				            <br /><br />
				            <input type="submit" name="btnSubmit" value="Submit" />
				        </form>
				        <?php
				    }
				    else
				    {
				        ?>
				        <form name="login1" action="admin_gateway.php?do=login" method="post" onsubmit="return aValidator();">
				        <table cellspacing="3">
				        <tr>
				            <td><b>Username:</b></td>
				            <td><input type="text" name="username"></td>
				            <td><b>Password:</b></td>
				            <td><input type="password" name="password"></td>
				        </tr>
				        <tr>
				            <td colspan="4" align="center"><input type="checkbox" name="remme">&nbsp;Ghi nhớ lần đăng nhập kế tiếp</td>
				        </tr>
				        <tr>
				            <td align="center" colspan="4"><input type="submit" name="submit" value="Đăng nhập"></td>
				        </tr>
				        </table>
				        </form>
				    <?
				    }
				    break;
				case "login":
				    $username = isset($_POST["username"])?$_POST["username"]:"";
				    $password = isset($_POST["password"])?$_POST["password"]:"";
				
				    if ($username=="" or $password=="" )
				    {
				        echo '<h3 style="text-align:center; color:red;">Tên đăng nhập hoặc mật khẩu không được để trống</h3>';
				        clearsessionscookies();
				        header("location: admin_gateway.php?returnurl=$returnurl");
				        ?>
				        <form name="login1" action="admin_gateway.php?do=login" method="post" onsubmit="return aValidator();">
				        <table cellspacing="3">
				        <tr>
				            <td><b>Username:</b></td>
				            <td><input type="text" name="username"></td>
				            <td><b>Password:</b></td>
				            <td><input type="password" name="password"></td>
				        </tr>
				        <tr>
				            <td colspan="4" align="center"><input type="checkbox" name="remme">&nbsp;Ghi nhớ lần đăng nhập kế tiếp</td>
				        </tr>
				        <tr>
				            <td align="center" colspan="4"><input type="submit" name="submit" value="Đăng nhập"></td>
				        </tr>
				        </table>
				        </form>
				        <?php
				    }
				    else
				    {
				        if(confirmuser($username,md5($password))) // As pointed out by asgard2005
				        {
				            createsessions($username,$password);
				            if ($returnurl<>"")
				                echo '<script>document.location.href="admin_gateway.php"; </script>';
				            else
				            {
				            	echo '<script>document.location.href="admin_gateway.php"; </script>';
				            }
				        }
				        else
				        {
				            echo '<h3 style="text-align:center; color:red;">Tên đăng nhập hoặc mật khẩu không đúng !</h3>';
				            clearsessionscookies();
				            header("location: admin_gateway.php?returnurl=$returnurl");
				            ?>
				            <form name="login1" action="admin_gateway.php?do=login" method="post" onsubmit="return aValidator();">
					        <table cellspacing="3">
					        <tr>
					            <td><b>Username:</b></td>
					            <td><input type="text" name="username"></td>
					            <td><b>Password:</b></td>
					            <td><input type="password" name="password"></td>
					        </tr>
					        <tr>
					            <td colspan="4" align="center"><input type="checkbox" name="remme">&nbsp;Ghi nhớ lần đăng nhập kế tiếp</td>
					        </tr>
					        <tr>
					            <td align="center" colspan="4"><input type="submit" name="submit" value="Đăng nhập"></td>
					        </tr>
					        </table>
					        </form>
				            <?php 
				        }
				    }
				    break;
				case "logout":
				    clearsessionscookies();
				    echo '<script>document.location.href="admin_gateway.php"; </script>';
				    break;
				}  
        		?>
        	</div>
        </div>
    </body>
</html>
