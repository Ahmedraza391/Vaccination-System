<?php
    include('connection.php');
    $id = $_GET['id'];
    $query = "UPDATE tbl_vaccine SET status = 'available' WHERE id = $id";
    $result = mysqli_query($connection,$query);
    if($result){
        echo "<script>alert('Vaccine Availabled Successfully');window.location.href = 'view_vaccine.php'</script>";
    }
?>