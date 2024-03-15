<?php
if(isset($_POST['bk_appointment'])){
    $pid = $_POST['pid'];
    $hid = $_POST['hid'];
    $date = $_POST['date'];
    $time = $_POST['time'];
    $vid = $_POST['vid'];
    // this query is for validate patient for appointment already exists
    $exsisting_query = "SELECT * FROM tbl_appointment WHERE pid = '$pid' and hid = '$hid' and date = '$date' and time = '$time'";
    $exsisting_result = mysqli_query($connection,$exsisting_query);
    $exsisting_numm = mysqli_num_rows($exsisting_result);
    if($exsisting_numm > 0){
        echo "
        <script>
            alert('Appointment Already Exists')
            window.location.href = 'appointment.php';    
        </script>";
    }
    else{
        // this query is for check vaccine
        $check_vaccine = "SELECT * FROM tbl_appointment WHERE vid = '$vid' and pid = $pid";
        $exsisting_vaccine = mysqli_query($connection,$check_vaccine);
        $exsisting_vaccine_numm = mysqli_num_rows($exsisting_vaccine);
        if(empty($exsisting_vaccine_numm)|| $exsisting_vaccine_numm > 0){
            // this query is for patient appointment result
            $check_status = mysqli_query($connection,"SELECT * FROM tbl_appointment ORDER BY id DESC");
            $check_result = mysqli_fetch_assoc($check_status);
            if($check_result['status'] != 'pending'){
                $insert_query = "INSERT INTO tbl_appointment(pid,hid,date,time,vid)VALUES('$pid','$hid','$date','$time','$vid')";
                $insert_result = mysqli_query($connection,$insert_query); 
                if($insert_result){
                    echo "<script>alert('Appointment Booked Successfully');window.location.href = 'appointment.php'</script>";
                }
            }
            // continue from tbl_appointment mai pendig wala kam
            else{
                echo "
                <script>
                    alert('Please Wait More Your Request Is In Under Process ')
                    window.location.href = 'appointment.php';    
                </script>";    
            }
        }else{
            echo "
            <script>
                alert('Please Select Same Vaccine')
                window.location.href = 'appointment.php';    
            </script>";
        }
    }
}
?>