<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>ATM Machine</title>
    <link rel="icon" type="image/x-icon" href="../ATM/Images/background.jpg">
    <link href='https://fonts.googleapis.com/css?family=Jost' rel='stylesheet'>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        body {
            background: url('../ATM/Images/background.jpg') no-repeat center center fixed;
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100vw;
            font-family: 'Jost';
        }

        #atm-screen,
        #deposit-form,
        #pin-screen,
        #withdraw-form {
            background-color: rgba(192, 192, 192, 0.3);
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.9);
            padding: 20px;
            max-width: 550px;
            width: 100%;
            height: 350px;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
            white-space: nowrap;
            overflow: hidden;
            animation: type 4s steps(60, end);
        }

        @keyframes type {
            from {
                width: 0;
            }
        }

        #change-pin-form {
            background-color: rgba(192, 192, 192, 0.3);
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.9);
            padding: 20px;
            max-width: 550px;
            width: 100%;
            height: 450px;
            text-align: center;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }

        h2 {
            font-size: 45px;
            color: white;
            width: 30em;
            white-space: nowrap;
            overflow: hidden;
            animation: type 4s steps(60, end);
        }

        @keyframes type {
            from {
                width: 0;
            }
        }

        h4 {
            background-color: rgba(192, 192, 192, 0.1);
            border-radius: 5px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.9);
            width: 270px;
        }
    </style>
</head>

<body>
    <div id="atm-screen">
        <h2>Welcome To Axis Bank ATM
            <hr>
        </h2>
        <h4>Select Your Card
            <img src="../ATM/Images/creditcard.png" alt="" width="70px;" height="70px;">
        </h4>
        <select id="card-select" class="form-select round" required>
            <option selected disabled style="text-align: center;">Select Your ATM Card Details</option>
            <option value="1021254157">Ira Dutt</option>
            <option value="2012063554">Pankti Ahuja</option>
            <option value="2015263658">Devam Shah</option>
            <option value="1423032554">Paksh Maitra</option>
            <option value="1985742655">Zeenal Rathore</option>
        </select>
        <div id="error-message" style="color: red;"></div><br>
        <button class="btn btn-primary" onclick="verifyPin()">Select Card</button>
    </div>

    <div id="pin-screen" style="display: none;">
        <h2>Axis ATM Card
            <hr>
        </h2><br>
        <div id="card-name-message"></div>
        <h4>Enter Your PIN <span class="emojis"> &#129488; </span></h4>
        <input type="password" id="pin-input" class="form-control" placeholder="Enter your PIN"><br>
        <button class="btn btn-primary" onclick="validatePin()">Submit</button><br>
        <!-- <center><button onclick="goBack()" class="btn btn-danger">Back</button></center> -->
    </div>

    <div id="deposit-form" style="display: none;">
        <h2>Deposit Money
            <hr>
        </h2>
        <center>
            <h4>Enter deposit amount:</h4>
        </center>
        <br>
        <input type="number" id="deposit-amount" class="form-control" placeholder="Enter amount"><br>
        <center><button class="btn btn-primary" onclick="depositMoney()">Deposit</button></center><br>
        <center><button onclick="goBack()" class="btn btn-danger">Back</button></center>
    </div>

    <div id="withdraw-form" style="display: none;">
        <h2>Withdraw Money
            <hr>
        </h2>
        <h4>Enter withdrawal amount:</h4>
        <input type="number" name="amount" id="withdraw-amount" class="form-control" placeholder="Enter amount"><br>
        <!-- <div id="error-message" style="color: red;"></div> -->
        <button onclick="withdrawMoney()" class="btn btn-primary">Withdraw</button><br>
        <button onclick="goBack()" class="btn btn-danger">Back</button>
    </div>

    <div id="change-pin-form" style="display: none;">
        <h2>Change PIN
            <hr>
        </h2>
        <label for="current-pin">Current PIN:</label>
        <input type="password" id="current-pin" class="form-control" placeholder="Enter current PIN"><br>
        <label for="new-pin">New PIN:</label>
        <input type="password" id="new-pin" class="form-control" placeholder="Enter new PIN"><br>
        <label for="confirm-new-pin">Confirm New PIN:</label>
        <input type="password" id="confirm-new-pin" class="form-control" placeholder="Confirm new PIN">
        <button class="btn btn-primary" onclick="changePIN()">Change PIN</button><br>
        <button onclick="goBack()" class="btn btn-danger">Back</button>
    </div>

    <div id="options-screen" style="display: none;">
        <button onclick="checkBalance()">Check Balance</button>
        <button onclick="showWithdrawForm()">Withdraw Money</button>
        <button onclick="withdrawMoney()">Withdraw Money</button>
        <button onclick="showDepositForm()">Deposit Money</button>
        <button onclick="depositMoney()">Deposit Money</button>
        <button onclick="showChangePINForm()">Change Pin</button>
        <button onclick="changePIN()">Change Pin</button>
        <button onclick="printStatement()">Print Statement</button>
        <button onclick="exitATM()">Exit ATM</button>
    </div>


    <script>
        var selectedCard;

        function verifyPin() {
            selectedCard = $("#card-select").val();
            if (selectedCard === "" || selectedCard === null) {
                $("#error-message").text("Please select a card before proceeding.").hide().fadeIn();
                setTimeout(function() {
                    $("#error-message").fadeOut();
                }, 3000);
                return;
            }
            $("#atm-screen").hide();
            $("#pin-screen").show();
        }

        function validatePin() {
            var pin = $("#pin-input").val();

            $.ajax({
                url: 'atmvalidatepin.php',
                method: 'POST',
                data: {
                    card: selectedCard,
                    pin: pin
                },
                success: function(response) {
                    if (response === 'success') {
                        loadOptions();
                    } else {
                        alert('Invalid PIN. Try again.');
                    }
                }
            });
        }

        function loadOptions() {
            $.ajax({
                url: 'atmload.php',
                method: 'POST',
                data: {
                    card: selectedCard
                },
                success: function(response) {
                    $("#pin-screen").hide();
                    $("#options-screen").html(response).show();
                }
            });
        }

        function checkBalance(card) {
            $.ajax({
                url: 'atmcheckbalance.php',
                method: 'POST',
                data: {
                    card: card
                },
                success: function(response) {
                    alert(response);

                },
                error: function() {
                    alert('Error checking balance. Please try again.');
                }
            });
        }

        function showWithdrawForm() {
            $("#options-screen").hide();
            $("#withdraw-form").show();
        }

        function withdrawMoney() {
            var withdrawAmount = $("#withdraw-amount").val();

            $.ajax({
                url: 'atmwithdraw.php',
                method: 'POST',
                data: {
                    card: selectedCard,
                    amount: withdrawAmount
                },
                success: function(response) {
                    alert(response);
                    if (response.includes("successful")) {
                        window.location.href = 'atmthankyou.php';
                    }
                },
                error: function() {
                    alert('Error withdrawing money. Please try again.');
                }
            });
        }

        function showDepositForm() {
            $("#options-screen").hide();
            $("#deposit-form").show();
        }

        function depositMoney() {
            var depositAmount = $("#deposit-amount").val();

            $.ajax({
                url: 'atmdepositmoney.php',
                method: 'POST',
                data: {
                    card: selectedCard,
                    amount: depositAmount
                },
                success: function(response) {
                    alert(response);
                    if (response.includes("successful")) {
                        window.location.href = 'atmthankyou.php';
                    }
                },
                error: function() {
                    alert('Error depositing money. Please try again.');
                }
            });
        }

        function showChangePINForm() {
            $("#options-screen").hide();
            $("#change-pin-form").show();
        }

        function changePIN() {
            var currentPIN = $("#current-pin").val();
            var newPIN = $("#new-pin").val();
            var confirmNewPIN = $("#confirm-new-pin").val();


            $.ajax({
                url: 'atmchangepin.php',
                method: 'POST',
                data: {
                    card: selectedCard,
                    currentPIN: currentPIN,
                    newPIN: newPIN,
                    confirmNewPIN: confirmNewPIN
                },
                success: function(response) {
                    alert(response);
                    if (response.includes("successful")) {
                        window.location.href = 'atmthankyou.php';
                    }
                },
                error: function() {
                    alert('Error changing PIN. Please try again.');
                }
            });
        }

        function printStatement() {
            $.ajax({
                url: 'atmprintstatement.php',
                method: 'POST',
                data: {
                    card: selectedCard
                },
                success: function(response) {
                    downloadFile(response, 'balance_statement.txt', 'text/plain');
                    alert(response);
                },
                error: function() {
                    alert('Error printing statement. Please try again.');
                }
            });
        }

        function downloadFile(content, fileName, contentType) {
            var blob = new Blob([content], {
                type: contentType
            });

            var a = document.createElement('a');
            a.href = window.URL.createObjectURL(blob);
            a.download = fileName;
            a.style.display = 'none';
            document.body.appendChild(a);

            a.click();

            document.body.removeChild(a);
        }

        function goBack() {
            $("#options-screen").show();
            $("#withdraw-form").hide();
            $("#deposit-form").hide();
            $("#change-pin-form").hide();
        }

        function exitATM() {
            window.location.href = 'atmone.php';
        }
    </script>
</body>

</html>