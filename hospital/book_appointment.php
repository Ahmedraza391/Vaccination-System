<?php
session_start();
include("connection.php");
$id = $_GET['id'];
$query = "UPDATE tbl_appointment SET status = 'booked' WHERE id = $id";
$result = mysqli_query($connection,$query);
if($result){
    echo "<script>alert('Appointment Booked Successfully');window.location.href = 'appointment.php'</script>";
}
?>