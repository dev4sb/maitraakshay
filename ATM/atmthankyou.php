<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="../ATM/Images/background.jpg">
    <title>Thank You</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f2f2f2;
        }

        .thank-you-container {
            text-align: center;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
        }

        h1 {
            color: #333333;
        }

        p {
            color: #666666;
        }
    </style>
</head>
<script>
        setTimeout(function() {
            window.location.href = 'atmone.php'; 
        }, 3000);
    </script>
<body>
    <div class="thank-you-container">
        <h1>Thank You For Using Axis ATM</h1>
        <p>Have a Great Day today!</p>
    </div>
</body>
</html>
