<?php
include "newconnection.php";
$emp_id=$_POST['emp_id'];
$username = $_POST["username"];
$password = $_POST["password"];
$phoneno = $_POST["phoneno"]; 

if (!empty($emp_id)) {
    $sql = "UPDATE `ajaxlogin`
	SET `username`='$username',
	`password`='$password',
	`phoneno`='$phoneno' WHERE emp_id=$emp_id";
} 
else
 {
    //$sql = "INSERT INTO ajaxlogin (username,password,phoneno) VALUES('$username','$password','$phoneno')";
    echo "it is not updated";
}

$result = mysqli_query($con, $sql);

if ($result) {
    $mainData = array(
        'result' => array(
            'status' => array(
                'statusCode' => "0",
                'statusMessage' => "Saved"
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
                'errorMessage' => "Not saved"
            )
        )
    );
    echo json_encode($data);
    exit();
}
?>
