<?php
    include('connection.php');
    $id = $_GET['id'];
    $query = "UPDATE tbl_patient SET status = 'activate' WHERE id = $id";
    $result = mysqli_query($connection,$query);
    if($result){
        echo "<script>alert('Patient Activate Successfully');window.location.href = 'patients.php'</script>";
    }
?>