<?php
session_start();
include("connection.php");
$id = $_GET['id'];
$query = "UPDATE tbl_appointment SET status = 'cancelled' WHERE id = $id";
$result = mysqli_query($connection,$query);
if($result){
    echo "<script>alert('Appointment Cancelled Successfully');window.location.href = 'appointment.php'</script>";
}
?>