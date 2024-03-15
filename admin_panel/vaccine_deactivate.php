<?php
    include('connection.php');
    $id = $_GET['id'];
    $query = "UPDATE tbl_vaccine SET status = 'unavailable' WHERE id = $id";
    $result = mysqli_query($connection,$query);
    if($result){
        echo "<script>alert('Vaccine Unavailabled Successfully');window.location.href = 'view_vaccine.php'</script>";
    }
?>