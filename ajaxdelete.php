<?php
include "newconnection.php";
$emp_id = $_POST['emp_id'];
$sql = "DELETE from ajaxlogin  WHERE emp_id=$emp_id";

$result = mysqli_query($con, $sql);
    
    if ($result) {
        $mainData = array(
            'result' => array(
                'status' => array(
                    'statusCode' => "0",
                    'statusMessage' => "data deleted"
                )
            )
        );
        echo json_encode($mainData);              
        exit();
    } else {
        $data = array(
            'result' => array(
                'status' => array(
                    'statusCode' => "1",
                    'errorMessage' => "not deleted"
                )
            )
        );
        echo json_encode($data);
        exit();
    }

?>