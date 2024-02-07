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
    $amount = $_POST["amount"];

    if (!isset($card) || !isset($amount) || empty($card) || !is_numeric($amount)) {
        echo "Invalid input. Please provide amount.";
        exit; 
    }

    $sql = "SELECT * FROM accounts WHERE card_number = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $card);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $balance = (float) $row["balance"];
        $customerName = $row["customer_name"];
        $pin = $row["pin"];

        if (!is_numeric($amount) || $amount <= 0) {
            echo "Invalid amount. Please provide a valid positive amount.";
            exit;
        }

        $newBalance = $balance + (float) $amount;

        $updateSql = "UPDATE accounts SET balance = ? WHERE card_number = ?";
        $updateStmt = $conn->prepare($updateSql);
        $updateStmt->bind_param("ds", $newBalance, $card);
        $updateStmt->execute();

        echo "Deposit successful. New balance: $newBalance";
    } else {
        echo "Error fetching account information";
    }

    $stmt->close();
    $updateStmt->close();
}

$conn->close();
?>
