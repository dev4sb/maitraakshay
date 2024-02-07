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
    $optionsHtml = "<center><h2 style='background-color:rgba(192,192,192,0.3); color:white; width:800px; border-radius:8px;'>Hello, <br> Welcome to Axis ATM <br> Please Choose Your Options <hr> <br> <h4 style='coloor:black; background-color:rgba(192,192,192,0.3);'>Your Card Number<span style='font-size:30px; font-weight:700;'> $card</span></h4></h2>";
    $optionsHtml .= "<div class='d-grid' style='background-color:rgba(192,192,192,0.3); border-radius:10px;'><button onclick='checkBalance($card)' class='btn btn-outline-success btn-block'>Check Balance</button></div>";
    $optionsHtml .= "<div class='d-grid' style='background-color:rgba(192,192,192,0.3); border-radius:10px;'><button onclick='showWithdrawForm($card)' class='btn btn-outline-success btn-block'>Withdraw Money</button></div>";
    $optionsHtml .= "<div class='d-grid' style='background-color:rgba(192,192,192,0.3); border-radius:10px;'><button onclick='showDepositForm($card)' class='btn btn-outline-success'>Deposit Money</button></div>";
    $optionsHtml .= "<div class='d-grid' style='background-color:rgba(192,192,192,0.3); border-radius:10px;'><button onclick='showChangePINForm($card)' class='btn btn-outline-success'>Change PIN</button></div>";
    $optionsHtml .= "<div class='d-grid' style='background-color:rgba(192,192,192,0.3); border-radius:10px;'><button onclick='printStatement($card)' class='btn btn-outline-success'>Print Statement</button></div><br>";
    $optionsHtml .= "<button onclick='exitATM()' class='btn btn-outline-danger'>Exit</button>";
    echo $optionsHtml;
}

$conn->close();
?>
