<?php
require_once('solvemedialib.php');
require('connect.php');
ob_start();
session_start();
//include the Solve Media library
include('head.php');
?>

        <div id="content" class="content">
            <?php
if($_POST)
{
	require_once("solvemedialib.php");
	$privkey="arSuUTJHqxu1uarsXvuO6UyluliVw9Dq";
	$hashkey="6CKg17T7.VmCnXxRZ3ARYmCEBP0Oit6-";
	$solvemedia_response = solvemedia_check_answer($privkey,
		$_SERVER["REMOTE_ADDR"],
		$_POST["adcopy_challenge"],
		$_POST["adcopy_response"],
		$hashkey);
	//if (!$solvemedia_response->is_valid) {
		//handle incorrect answer
	//	print "Error: ".$solvemedia_response->error;
	//}
	//else {
		//process form here
		if(isset($_POST['username'])&&isset($_POST['password']))
		{
			$username=mysqli_real_escape_string($con, $_POST['username']);
			$password=mysqli_real_escape_string($con, $_POST['password']);

			if(!empty($username)&&!empty($password))
			{
				$password=md5($password);
				$str="SELECT username, password FROM rpadmin WHERE username='$username'";
				$result = mysqli_query($con, $str);
				if (!$result) {
  					printf("Error: %s\n", mysqli_error($con));
    					exit();
				   }
				if(mysqli_num_rows($result)==1)
				{
					
					$row=mysqli_fetch_array($result);
					if($username===$row['username'] && $password===$row['password'])
					{
						$_SESSION['username']=$row['username'];
						echo 'Logged In';
						header('location:adminhome.php');
					}
				}
			}
		}
	//}
}?>

            <form action="index.php" method="post" name="signup">
                <table cellpadding="5" cellspacing="5" align="center" style="color:#CCC;">
                    
                    <tr>
                        <td><label for="username">*Username :</label></td>

                        <td><input type="text" name="username" id="username" pe="text" required="required" tabindex="1" accesskey="u"/></td>

                        <td></td>
                    </tr>

                    <tr>
                        <td><label for="password">*Password :</label></td>

                        <td><input type="password" name="password" id="password" required="required" tabindex="2" accesskey="up"/></td>

                        <td></td>
                    </tr>
                    <tr>
                        <td colspan="2">
                        <script type="text/javascript">
	var ACPuzzleOptions = {
                tabindex:   3,
				lang:	    'en'
	};
  </script><?php //echo solvemedia_get_html("qjmGRXOO9Bq7AfRhBy22ue7pPkcBCGIH"); //outputs the widget
?></td>
                    </tr>

                    <tr>
                        <td colspan="2">&nbsp;</td>
                    </tr>

                    <tr>
                        <td colspan="2" align="center"><input type="submit" value="LOGIN" tabindex="4"/></td>
                    </tr>
                </table>
            </form>

            <div id="footer" class="footer">
                <h5 style="color:white;">@TEAM ECLECTIKA | All Rights Are Reserved.</h5>
            </div>
        </div>
    </div>
</body>
</html>
