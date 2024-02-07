<?php
// Connection to MySQL database
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
    $currentPIN = $_POST["currentPIN"];
    $newPIN = $_POST["newPIN"];
    $confirmNewPIN = $_POST["confirmNewPIN"];


    $checkPINSql = "SELECT pin FROM accounts WHERE card_number = $card";
    $checkPINResult = $conn->query($checkPINSql);

    if ($checkPINResult->num_rows > 0) {
        $row = $checkPINResult->fetch_assoc();
        $storedPIN = $row["pin"];

        if ($currentPIN == $storedPIN) {
            if ($newPIN == $confirmNewPIN) {
                $updatePINSql = "UPDATE accounts SET pin = '$newPIN' WHERE card_number = $card";
                $conn->query($updatePINSql);

                echo "PIN changed successfully.";
            } else {
                echo "New PIN and confirm new PIN do not match.";
            }
        } else {
            echo "Incorrect current PIN.";
        }
    } else {
        echo "Error fetching account information.";
    }
}

$conn->close();
?>
