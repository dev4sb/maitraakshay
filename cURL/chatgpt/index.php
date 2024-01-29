<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <title>ChatGPT API Request</title>
</head>

<body>
    <div id="response-container"></div>


    <script>
        $(document).ready(function() {
            let apiEndpoint = 'https://api.openai.com/v1/chat/completions';

          let message = 'Hello World!';


            let requestData = {
                message: message,
            };

            $.ajax({
                url: 'api_request.php',
                type: 'POST',
                contentType: 'application/json',
                data: JSON.stringify(requestData),
                success: function(response) {

                    $('#response-container').html('API Response: ' + response);
                },
                error: function(error) {
                    console.error(error);
                }
            });
        });
    </script>

</body>

</html>