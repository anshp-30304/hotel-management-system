<?php session_start(); ?>
<?php include('db.php'); 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
?>
<html>
<head>
<link rel="stylesheet" type="text/css" href="css/login_style.css">
</head>
<body>
<div class="form-wrapper" style="height: 430px;">
  
  <form action="#" method="post">
    <h3>Join us today</h3>
	
    <div class="form-item">
		<input type="text" name="user" pattern="^[a-zA-Z]+(([',. -][a-zA-Z ])?[a-zA-Z]*)*$"required="required" autocomplete="off" placeholder="Username" autofocus required></input>
    </div>

    
    <div class="form-item">
		<input type="text" name="Email-id" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"  required="required" placeholder="Email-id" autocomplete="off" autofocus required></input>
    </div>

    
    <div class="form-item">
		<input type="password" name="pass" required="required" placeholder="Password" autocomplete="off" required></input>
    </div>
    
    <div class="button-panel">
		<input type="submit" class="button" title="Sign-up" name="Sign-up" value="Sign-up"></input>
    </div>
  </form>
  
  <div class="reminder">
    <p>Already a member <a href="index.php">Go back to login</a></p>
  </div>
</div>
<?php
  function send_mail($u_email,$v_code)
  {
    require ("PHPMAiler/PHPMailer.php");
    require ("PHPMAiler/SMTP.php");
    require ("PHPMAiler/Exception.php");

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
  
    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'example@gmail.com';                     //SMTP username
        $mail->Password   = 'password';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom('example@gmail.com', 'Hotel management system');
        $mail->addAddress($u_email);     //Add a recipient
      
        
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'E-mail Verification form Hotel Management System';
        $mail->Body    = "Click here to <a href='http://localhost/hotel/verify.php?email=$u_email&code=$v_code'>Verify</a> Your email address";
    
        $mail->send();
        return TRUE;
    } catch (Exception $e) {
       return FALSE;
    }
  }

 
	if (isset($_POST['Sign-up']))
		{
      $v_code = bin2hex(random_bytes(16));
      $username= $_POST['user'];
      $password=$_POST['pass'];
      $u_email=$_POST['Email-id'];


      
      
      $user_email = "SELECT * FROM `login` WHERE `u_email` = '$u_email'";
      $result2 = mysqli_query($con,$user_email);
      $email_rows = mysqli_num_rows($result2);
      
     
      if($email_rows > 0){
        header("refresh:0;url=index.php");
        echo '<script>alert("user already existed")</script>';
      }
      else{
        $query = "INSERT INTO `login`(`id`, `usname`, `pass`, `u_type`, `u_email`, `v_code`, `is_active`) VALUES ('','$username','$password','1','$u_email','$v_code','0')";
        if($con->query($query) && send_mail($u_email, $v_code ))
        {
          header("refresh:1;url=index.php");
          echo '<script>alert("Registration Sucessfull please check you email id for verification")</script>';
        }
      }

		}
  ?>
</body>
</html>