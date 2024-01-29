<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>cURL</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>

    </style>
</head>

<body>
    <input type="submit" name="submitData" id="submitData" value="Click Here" class="btn btn-success">
    <section id="responseCurl" style="width: 300px; height:300px;">

    </section>
    <script>
        $(document).ready(function() {
            $("#submitData").on("click", function() {
                // alert("clicked");
                $.ajax({
                    type: "GET",
                    url: "curl.php",
                    dataType: "JSON",
                    contentType: "application/json",
                    success: function(data) {
                       
                            if (data && data.status === "success") {
                                let imageUrl = data.message;
                                // console.log(imageUrl);
                                $("#responseCurl").html("<img src='" + imageUrl + "' alt='Random Dog Image'>");
                            } else {
                                alert("Error fetching dog image");
                            }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }

                });
            });
        });
    </script>
</body>

</html>