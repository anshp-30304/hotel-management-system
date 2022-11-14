<?php session_start(); ?>
<?php include('db.php'); ?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/login_style.css">
</head>
<body>
<div class="form-wrapper">
  
  <form action="#" method="post">
    <h3>Login here</h3>
	
    <div class="form-item">
		<input type="text" name="user" required="required" placeholder="Username" autofocus required></input>
    </div>
    
    <div class="form-item">
		<input type="password" name="pass" required="required" placeholder="Password" required></input>
    </div>
    
    <div class="button-panel">
		<input type="submit" class="button" title="Log In" name="login" value="Login"></input>
    </div>
  </form>
  <?php
if (isset($_POST['login']))
{
	$username = $_POST['user'];
	$password = $_POST['pass'];
	// $verified = "SELECT * FROM `login` WHERE `is_active` = 1";
	$query 	= "SELECT * FROM `login` WHERE `pass`='$password' and `usname`='$username'";
	$result = mysqli_query($con,$query);
	$values = mysqli_fetch_assoc($result);
	$rows = mysqli_num_rows($result);
			if($rows == 1)
			{
				if ($values['is_active'] == 1) 
				{			
					$_SESSION['us_name']  = $values['usname'];
					$_SESSION['us_email']  = $values['u_email'];
					$_SESSION['user_id']=$values['user_id'];
					header('location:home.php');
					}
				else
					{
						echo"
							<script>alert('User not verified');
							window.location.href='index.php';
							</script>
							"; 
					}
			}
			else
			{
				echo"
						<script>alert('Incorrect credentials');
						window.location.href='index.php';
						</script>
						"; 
			}
}
			
  ?>
  <div class="reminder">
    <p>Not a member? <a href="signup.php">Sign up now</a></p>
  </div>
  
</div>

</body>
</html>

<!-- 

$username = mysqli_real_escape_string($con, $_POST['user']);
			$password = mysqli_real_escape_string($con, $_POST['pass']);
			$query 		= "SELECT * FROM `login` WHERE  pass='$password' and usname='$username'";
			$result     = mysqli_query($con,$query);
			$row		= mysqli_fetch_array($result);

			if($result)
			{
				if ($row['is_active'] == 1) 
				{			
					$_SESSION['us_name']  = $row['usname'];
					$_SESSION['us_email']  = $row['u_email'];
					$_SESSION['user_id']=$row['user_id'];
					header('location:home.php');
					}
				else
					{
						echo"
							<script>alert('User already verified');
							window.location.href='index.php';
							</script>
							"; 
					}
			}
			else
			{
				echo 'Invalid Username and Password Combination';
			}
		}
 -->