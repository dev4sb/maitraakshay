<?php 

include("connection.php");


$id = $_POST["id"];
if($id){

    $query = "delete from user_data where `id` = '$id'";
    $result = mysqli_query($conn,$query);
}

?>