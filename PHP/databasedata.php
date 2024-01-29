<?php
include("connection.php");

$query = "select * from user_data";
$result = mysqli_query($conn, $query);
if (!$result) {
    die("Error" . mysqli_error($conn));
} 
else{
    $row = mysqli_fetch_assoc($result);
    $data = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
    echo json_encode($data);
}

?>