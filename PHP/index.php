<?php include("connection.php") ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="/Forms/Images/privacy_2133152.png" type="image/x-icon">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">


</head>
<title>Login Form</title>
<style>
    * {
        font-family: 'jost';
    }

    .image {
        height: 100vh;
        background-image: url(../Forms/Images/light-olive-green-watercolor-texture-wallpaper.jpg);
        background-repeat: no-repeat;
        background-size: 100% 100%;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .card {
        background-color: #E9F0D5;
    }

    .btn {
        text-decoration: none;
    }

    .modal {
        background-color: #d6e6a9;
    }

    .profile_card_image {
        border-radius: 50%;
        display: block;
        margin-left: auto;
        margin-right: auto;
    }
</style>
<script>
    $(document).ready(function() {
        $('#myFormId').validate({
            rules: {
                username: {
                    required: true,
                    minlength: 3,
                    maxlength: 10
                },
                password: {
                    required: true
                }
            },

            errorPlacement: function(error, element) {
                // Custom error placement
                let fieldId = element.attr('id') + '-error';
                error.appendTo('#' + fieldId);
            },
            messages: {
                username: {
                    required: "<h6 style=color:red;>Please Enter Your Username</h6>",
                    minlength: "<h6 style=color:red;>Please Enter Minimum 3 Characters</h6>",
                    maxlength: "<h6 style=color:red;>Please Enter maximum 10 Characters</h6>"
                },
                password: {
                    required: "<h6 style=color:red;>Please Enter Your Password</h6>"
                }
            },
            submitHandler: function(form) {
                window.location.href = 'successlogin.html';
            }
        });
    });

    $(document).ready(function() {
        $('#CreateUser').validate({
            rules: {
                newFirstName: {
                    required: true
                },
                newLastName: {
                    required: true
                },
                newEmail: {
                    required: true
                },
                newPassword: {
                    required: true,
                    minlength: 3
                },
                newConfirmPassword: {
                    required: true,
                    minlength: 3,
                    equalTo: '#newPassword'
                },
                checkbox: {
                    required: true
                },
                btnradio: {
                    required: true
                }
            },
            errorPlacement: function(error, element) {
                let field = element.attr('id') + '-error';
                // console.log(element.attr('id') + '-error');
                error.hide().fadeIn("slow").appendTo('#' + field);
                // console.log( error.appendTo('#' + field));
                if (element.is(":radio")) {
                    error.appendTo(
                        element.parents('.form-group'));
                    // console.log( element.parents('#btnradio-error'));
                } else {
                    error.insertAfter(element.parents('.form-group'));
                }
            },
            messages: {
                newFirstName: {
                    required: "<h6 style=color:red;>Please Enter Your First Name</h6>"
                },
                newLastName: {
                    required: "<h6 style=color:red;>Please Enter Your Last Name</h6>"
                },
                newEmail: {
                    required: "<h6 style=color:red;>Please Enter Your Email</h6>"
                },
                newPassword: {
                    required: "<h6 style=color:red;>Please Enter Your Password</h6>",
                    minlength: "<h6 style=color:red;>Minimum 3 Characters</h6>"
                },
                newConfirmPassword: {
                    required: "<h6 style=color:red;>Please Enter Your Confirm Password</h6>",
                    minlength: "<h6 style=color:red;>Minimum 3 Characters</h6>",
                    equalTo: "<h6 style=color:red;>Password Not matched</h6>"
                },
                checkbox: {
                    required: "<h6 style=color:red;>Please Select One CheckBox</h6>"
                },
                btnradio: {
                    required: "<h6 style=color:red;>Please Select Gender</h6>"
                }
            },

            submitHandler: function(form) {
                $.ajax({
                    type: 'POST',
                    url: 'insert.php',
                    data: $('#CreateUser').serialize(),
                    success: function(data) {
                        $('#CreateUser')[0].reset();
                        // window.location = "index.php";
                        // console.log(data);
                        alert ("Done");
                        return false;

                    }
                });
            }

        });
        
    });
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
                    // console.log(tbody);
                    $('#rowdata').html(tbody);
                }
            });

            // Delete Ajax
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
                            
                        return false;
                    }
                });
            });
</script>

</head>

<body>
    <div class="image">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card border border-dark">
                        <div class="card-header">
                            <h2> Login Form </h2>
                        </div>
                        <div class="card-body">
                            <form id="myFormId">
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" class="form-control border border-success" id="username" name="username" placeholder="Enter your username">
                                <div class="error-message" id="username-error"></div>

                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control border border-success" id="password" name="password" placeholder="Enter your password">
                                <div class="error-message" id="password-error"></div>

                            </div>
                            <button type="submit" class="btn btn-outline-primary" id="loginForm">Login</button>
                            <button type="button" class="btn btn-link" data-bs-toggle="modal" data-bs-target="#createAccountModal">Create an Account</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div id="messages"></div>

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

        <!-- Create Account Modal -->
        <div class="modal fade" id="createAccountModal" tabindex="-1" role="dialog" aria-labelledby="createAccountModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createAccountModalLabel">Create an Account</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="CreateUser" method="POST">
                            <div class="form-group">
                                <img src="../Forms/Images/profile_card.jpg" alt="Profile Card" width="100px" height="100px" class="profile_card_image">
                            </div>
                            <div class="form-group">
                                <label for="newFirstName">First Name</label>
                                <input type="text" class="form-control" name="newFirstName" id="newFirstName" placeholder="Enter your Firstname">
                                <div class="error-message" id="newFirstName-error"></div>

                            </div>
                            <div class="form-group">
                                <label for="newLastName">Last Name</label>
                                <input type="text" class="form-control newLastName" id="newLastName" placeholder="Enter your Lastname" name="newLastName">
                                <div class="error-message" id="newLastName-error"></div>

                            </div>
                            <div class="form-group">
                                <label for="newEmail">Email</label>
                                <input type="text" class="form-control newEmail" id="newEmail" placeholder="Enter your Email" name="newEmail">
                                <div class="error-message" id="newEmail-error"></div>

                            </div>
                            <div class="form-group">
                                <label for="newPassword">Password</label>
                                <input type="password" class="form-control newPassword" id="newPassword" placeholder="Enter your Password" name="newPassword">
                                <div class="error-message" id="newPassword-error"></div>

                            </div>
                            <div class="form-group">
                                <label for="newConfirmPassword">Confirm-Password</label>
                                <input type="password" class="form-control newConfirmPassword" id="newConfirmPassword" placeholder="Enter your Confirm-Password" name="newConfirmPassword">
                                <div class="error-message" id="newConfirmPassword-error"></div>

                            </div>
                            <div class="form-group">
                                <label for="newHobbies">Hobbies</label> <br>
                                <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                                    <input type="checkbox" class="btn-check" id="btncheck1" name="hobbies[]" autocomplete="off" value="cricket">
                                    <label class="btn btn-outline-primary" for="btncheck1">Cricket</label>

                                    <input type="checkbox" class="btn-check" id="btncheck2" name="hobbies[]" autocomplete="off" value="football">
                                    <label class="btn btn-outline-primary" for="btncheck2">Football</label>

                                    <input type="checkbox" class="btn-check" id="btncheck3" name="hobbies[]" autocomplete="off" value="vollyball">
                                    <label class="btn btn-outline-primary" for="btncheck3">Vollyball</label>
                                </div>
                                <div class="error-message" id="checkbox-error"></div>

                            </div>
                            <div class="form-group">
                                <label for="newGender">Gender</label> <br>
                                <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                                    <input type="radio" class="btn-check" name="gender" id="btnradio1" autocomplete="off" value="male">
                                    <label class="btn btn-outline-primary" for="btnradio1">Male</label>

                                    <input type="radio" class="btn-check" name="gender" id="btnradio2" autocomplete="off" value="female">
                                    <label class="btn btn-outline-primary" for="btnradio2">Female</label>

                                    <input type="radio" class="btn-check" name="gender" id="btnradio3" autocomplete="off" value="other">
                                    <label class="btn btn-outline-primary" for="btnradio3">Other</label>
                                </div>
                                <div class="error-message radioError" id="btnradio-error"></div>

                            </div>
                            <div class="form-group">
                                <label for="newComments">Add Few Words About Yourself</label> <br>
                                <div class="form-floating">
                                    <textarea class="form-control" placeholder="Leave a comment here" name="description" id="floatingTextarea"></textarea>
                                    <label for="floatingTextarea">Comments</label>
                                </div>
                            </div> <br>
                            <div class="">
                                <!-- <input type="hidden" name="rowid" id="rowid" value=""> -->
                                <button type="submit" class="btn btn-outline-primary" id="CreateForm">Sign
                                    Up</button>
                                <button type="reset" class="btn btn-outline-danger" id="resetForm">Reset</button>
                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>