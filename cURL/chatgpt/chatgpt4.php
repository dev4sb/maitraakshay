<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OpenAI ChatGPT API Demo</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
</head>
<body>
    <div class="container d-flex flex-column">
    <h1>OpenAI ChatGPT API Demo</h1>

    <form id="generateForm" method="post">
        <label>
            <input type="radio" name="inputType" value="text" checked> Text
        </label>
        <label>
            <input type="radio" name="inputType" value="images"> Images
        </label>

        <br>

        <label for="prompt">Enter prompt:</label>
        <input type="text" id="prompt" name="prompt" required>

        <br>

        <button type="button" onclick="generateResponse()" class="btn btn-primary">Generate Response</button>
    </form>

    <div id="result"></div>
    </div>


    <script>
        function generateResponse() {
            var inputType = $("input[name='inputType']:checked").val();
            var prompt = $("#prompt").val();

            $.ajax({
                type: "POST",
                url: "chatgptresponse.php",
                data: { inputType: inputType, prompt: prompt },
                success: function(response) {
                    $("#result").html(response);
                },
                error: function(xhr, status, error) {
                    console.error("Ajax request failed:", error);
                }
            });
        }
    </script>
</body>
</html>
