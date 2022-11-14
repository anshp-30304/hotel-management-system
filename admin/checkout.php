<?php

include "db.php";

$lid = $_GET['sid'];
echo $lid;

$query="DELETE FROM `roombook` WHERE id = '$lid'";
$sql = mysqli_query($con,$query);
if ($sql){
    header("refresh:1;url=index.php");
    echo '<script>alert("Checked out")</script>';
}
?>