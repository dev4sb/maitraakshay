<?php
include("connection.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Get Data</title>

    <!-- Bootstrap CDN Link -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <!-- Ajax CDN Link -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    <!-- Gogle Fonts Links -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <script>
        let tbody = '';
        $.ajax({
            type: 'GET',
            url: 'databasedata.php',
            dataType: "JSON",
            success: function(data) {
                if (data) {
                    for (i = 0; i <= data.length - 1; i++) {
                        tbody += '<tr><td>' + data[i].firstname + '</td><td>' + data[i].lastname + '</td><td>' + data[i].email + '</td><td>' + data[i].password + '</td><td>' + data[i].confirmpassword + '</td><td>' + data[i].hobbies + '</td><td>' + data[i].gender + '</td><td>' + data[i].description + '</td><td><a href="javascript:void(0)" data-id="' + data[i].id + '" class="btn btn-danger edit-btn">Edit</a> <a href="javascript:void(0)" data-id="' + data[i].id + '" class="btn btn-primary delete-btn" >Delete</a></td>';
                    }
                }
                console.log(tbody);
                $('#rowdata').html(tbody);
            }
        });

        $(document).on("click", ".delete-btn", function() {
            console.log($(this).attr('data-id'));
            let id = $(this).attr('data-id');
            $.ajax({
                type: "POST",
                url: 'delete.php',
                data: {
                    "id": id
                },
                success: function(data) {
                    alert("Data Deleted")
                    return false;
                }
            });
        });
    </script>
</head>

<body>
    <div class="container-fluid">
        <form action="">
            <table class="table table-bordered table table-striped">
                <thead>
                    <tr>
                        <th>First Name</th>
                        <th>last Name</th>
                        <th>Email</th>
                        <th>Password</th>
                        <th>Confirm Password</th>
                        <th>Hobbies</th>
                        <th>Gender</th>
                        <th>Description</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="rowdata">
                </tbody>
            </table>
        </form>
    </div>
</body>

</html>