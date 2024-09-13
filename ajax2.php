<?php
include "newconnection.php"; // Make sure this file establishes a database connection


    global $conn;
    if ($_SERVER["REQUEST_METHOD"] == "POST") 
{
    $username=$_POST['username'];
    $password=$_POST['password'];
    $phoneno=$_POST['phoneno'];
} 
$check=mysqli_query($con,"select distinct * from ajaxlogin where username='$username' , passsword='$password',phoneno='$phoneno");
  
$checkrows=mysqli_num_rows($check);

if($checkrows>0) 
{
$mainData = array(
    'result' => array(
        'status' => array(
            'statusCode' => "1",
            'errorMessage' => "customer already exits",
        )
    )
);
echo json_encode($mainData);   
} else
{

    $sql = "INSERT INTO ajaxlogin (username,password,phoneno) VALUES('$username','$password','$phoneno')";
    $result = mysqli_query($con, $sql);
    
    if ($result) {
        $mainData = array(
            'result' => array(
                'status' => array(
                    'statusCode' => "0",
                    'statusMessage' => "inserted"
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
                    'errorMessage' => "not inserted"
                )
            )
        );
        echo json_encode($data);
        exit();
    }
}
?>
