<?php
include("connection.php");
$id = $_POST['id'];
$query = "UPDATE tbl_notification SET status = 'seen' WHERE p_id = $id";
$result = mysqli_query($connection,$query);
?>