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


    $sql = "SELECT balance FROM accounts WHERE card_number = $card";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $balance = $row["balance"];

        echo "Your current balance is: $balance";
    } else {
        echo "Error fetching account information";
    }
}

$conn->close();
?>
