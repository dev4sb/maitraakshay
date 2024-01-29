<?php 

include("connection.php");


$first_name = $_POST["newFirstName"];
$last_name = $_POST["newLastName"];
$email = $_POST["newEmail"];
$password = $_POST["newPassword"];
$confirmpassword = $_POST["newConfirmPassword"];
$hobby = $_POST["hobbies"];
if($hobby){

    $hobbies = implode(",", $hobby);
}
else{
    $hobbies = "";
}
$gender = $_POST["gender"];   
$description = $_POST["description"];

$query = "insert into user_data(`firstname`,`lastname`,`email`,`password`,`confirmpassword`,`hobbies`,`gender`,`description`) values ('$first_name','$last_name','$email','$password','$confirmpassword','$hobbies','$gender','$description')";

$result = mysqli_query($conn,$query);



?>