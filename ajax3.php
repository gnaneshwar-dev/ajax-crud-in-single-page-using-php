<?php
include("newconnection.php");

$sql = "SELECT * FROM ajaxlogin";
$result = mysqli_query($conn, $sql);
$Data = array();

if (mysqli_num_rows($result) > 0) 
{
    while ($row = mysqli_fetch_assoc($result)) 
    {
        $Data[] = $row;
    }
    echo json_encode($Data);
} 
else 
{
    echo json_encode(array()); 
}

?>

