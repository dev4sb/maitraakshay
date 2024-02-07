<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "atm_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function withdrawMoney($conn, $card, $amount) {
    $stmt = $conn->prepare("SELECT balance FROM accounts WHERE card_number = ?");
    $stmt->bind_param("s", $card);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if (isset($row["balance"])) {
            $balance = (float) $row["balance"];

            if (!is_numeric($amount) || $amount <= 0) {
                return "Invalid amount. Please provide a valid positive amount.";
            }

            if ($balance >= $amount) {
                $newBalance = $balance - (float) $amount;

                $stmt = $conn->prepare("UPDATE accounts SET balance = ? WHERE card_number = ?");
                $stmt->bind_param("ds", $newBalance, $card);
                $stmt->execute();

                return "Withdrawal successful. New balance: $newBalance";
            } else {
                return "Insufficient funds for withdrawal.";
            }
        } else {
            return "Error: 'balance' key not found in the result set.";
        }
    } else {
        return "Error fetching account information";
    }

    $stmt->close();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $card = $_POST["card"];
    $amount = $_POST["amount"];

    $withdrawalResult = withdrawMoney($conn, $card, $amount);

    echo $withdrawalResult;
}

$conn->close();

?>
