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


    $balanceSql = "SELECT balance FROM accounts WHERE card_number = $card";
    $balanceResult = $conn->query($balanceSql);

    if ($balanceResult->num_rows > 0) {
        $row = $balanceResult->fetch_assoc();
        $balance = $row["balance"];

        $fileContent = "Balance: $" . $balance;

        echo $fileContent;
    } else {
        echo "No balance found for the selected card.";
    }
}

$conn->close();
?>
