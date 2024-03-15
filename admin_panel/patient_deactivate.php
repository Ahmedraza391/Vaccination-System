<?php
    include('connection.php');
    $id = $_GET['id'];
    $query = "UPDATE tbl_patient SET status = 'deactivate' WHERE id = $id";
    $result = mysqli_query($connection,$query);
    if($result){
        echo "<script>alert('Patient Deactivate Successfully');window.location.href = 'patients.php'</script>";
    }
?>