<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "atm_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $card = $_POST["card"];
    $pin = $_POST["pin"];

    $sql = "SELECT * FROM accounts WHERE card_number = $card AND pin = $pin";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "success";
    } else {
        echo "failure";
    }
}

$conn->close();
?>
