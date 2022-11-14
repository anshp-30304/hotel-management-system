<?php
session_start();
$email = $_SESSION['email'];
$to_email = $email;
$subject = "Form xyz hotel management system";
$body = "Hi , Your hotel booking reservation has been accepted";
$headers = "From: drive2122123@gmail.com";

if (mail($to_email, $subject, $body, $headers))

{
    echo "Email successfully sent to $to_email...";
}

else

{
    echo '<script>alert("mail not sent")</script>';
}
?>