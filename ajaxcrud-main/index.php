<?php
include("connection.php"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    
        <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Jost:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        *{
            font-family: 'jost';
        }
        input, select{
            border: 3px solid #a7b9b1;
            border-radius: 15%;
        }
        .img{
            /* border: 2px solid black; */
            width: 410px;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        form{
            width: 100%;
        }
      
    </style>
</head>
<body>
    <div class="img">
        
    <form action="" method="post" id="validateForm">
        <h3 style="text-align:center; background-color:#a7b9b1">Forms</h3>
        <table class="table table-striped table-success table-bordered">
        <div class="form-group">
            <tr>
                <td>First Name</td>
                <td  class="form-group"><input type="text" name="firstname" id="firstname"></td>
                <div class="error-message" id="firstname-error"></div>
            </tr>
        </div>
        <div class="form-group">
            <tr>
                <td>Last Name</td>
                <td class="form-group"><input type="text" name="lastname" id="lastname"></td>
                <div class="error-message" id="lastname-error"></div>
            </tr>
</div>
<div class="form-group">
            <tr>
                <td>Email</td>
                <td class="form-group"><input type="email" name="email" id="email"></td>
                <div class="error-message" id="email-error"></div>
            </tr>
</div>
<div class="form-group">
            <tr>
                <td>Gender</td>
                <td class="form-group">
                    <select name="gender" id="gender">
                        <option value="">Choose an Option</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>
                </td>
                <div class="error-message" id="gender-error"></div>
            </tr>
            </div>
     <div class="form-group">
            <tr>
                <td>Date of Birth</td>
                <td class="form-group"><input type="date" name="dob" id="dob"></td>
                <div class="error-message" id="dob-error"></div>

            </tr>
</div>
<div class="form-group">
            <tr>
                <td>Hobbies</td>
                <td class="form-group">
                <input type="checkbox" name="hobbies[]" value="cricket" id="hobbies">&nbsp;Cricket
                <input type="checkbox" name="hobbies[]" value="football" id="hobbies">&nbsp;Football
                <input type="checkbox" name="hobbies[]" value="hockey" id="hobbies">&nbsp;Hockey</td>
                <div class="error-message" id="hobbies-error"></div>

            </tr>
</div>
            <tr>
                <td colspan=2>
                    <input type="hidden" name="rowid" id="rowid" value="">
                    <center><input type="submit" name="submitform" value="Submit" class="btn btn-success"></center>
                </td>
            </tr>

            <tr>
                <td colspan=2>
                    <div id="message" style="text-align:center;"></div>
                </td>
            </tr>
        </table>
    </form>

</div>
<h3  style="text-align:center; background-color:#a7b9b1">Inserted Data</h3>
    <table border="2px" class="table table-success">
        <thead>
        <tr>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Email</th>
            <th>Gender</th>
            <th>DOB</th>
            <th>Hobbies</th>
            <th>Action</th>
        </tr>
        </thead>
        <tbody id="rowdata">
        </tbody>
    </table>
 



</body>

<script>


$(document).ready(function() {
        $('#validateForm').validate({
            rules: {
                firstname: {
                    required: true
                },
                lastname: {
                    required: true
                },
                email: {
                    required: true,
                    email : true
                },
                gender: {
                    required: true
                },
                dob: {
                    required: true
                },
                hobbies: {
                    required: true
                },
            },
            errorPlacement: function(error, element) {

                    let field = element.attr('id') + '-error';
                    // console.log(element.attr('id') + '-error');
                    error.hide().fadeIn("slow").appendTo('#' + field);
                    // console.log(error.appendTo('#' + field));
                    if (element.attr("name") == "hobbies[]") {
                        error.appendTo("#hobbies-error");
                    } else {
                        error.insertAfter(element);
                    }


            },
            messages: {
                firstname: {
                    required: "<h6 style=color:red;>Please Enter Your First Name</h6>"
                },
                lastname: {
                    required: "<h6 style=color:red;>Please Enter Your Last Name</h6>"
                },
                email: {
                    required: "<h6 style=color:red;>Please Enter Your Email</h6>",
                    email :"<h6 style=color:red;>Please Write Email Correctly</h6>"
                },
                gender: {
                    required: "<h6 style=color:red;>Please Select Gender</h6>"
                },
                dob: {
                    required: "<h6 style=color:red;>Please Choose Date Of Birth</h6>"
                },
                hobbies: {
                    required: "<h6 style=color:red;>Please Select One CheckBox</h6>"
                },

            
            },
            submitHandler: function(form) {
                $.ajax({
                    type: 'POST',
                    url: 'insert.php',
                    data: $('#validateForm').serialize(),
                    success: function(data) {
                        getRowData();
                        $('#validateForm')[0].reset();
                        $('#message').html("<h5>Data Inserted</h5>").css("color","red").fadeIn(2000);
                        // console.log(data);
                        // alert ("Done");
                        return false;

                    }
                    
                });
            }

        });
        
    });

function getRowData()
{
    var tbody = '';
    $.ajax({
        type:"GET",
        url:'dataget.php',
        dataType:"JSON",
        success:function(data){
            // console.log (data);
            if (data) {
                for(i=0; i<= data.length - 1; i++) {
                    // console.log(data[i].firstname);
                    tbody += '<tr><td>'+data[i].firstname+'</td><td>'+data[i].lastname+'</td><td>'+data[i].email+'</td><td>'+data[i].gender+'</td><td>'+data[i].dob+'</td><td>'+data[i].hobbies+'</td><td><a href="javascript:void(0)" data-id="'+data[i].id+'" class="btn btn-danger edit-btn">Edit</a> <a href="javascript:void(0)" data-id="'+data[i].id+'" class="btn btn-primary delete-btn" >Delete</a></td>';
                }
                // console.log(tbody);
                $('#rowdata').html(tbody);
            }
        }
    });

}
$(document).ready(function(){
    //get tbody data
    getRowData();
    
    
    //update data to table
    $(document).on("click",".edit-btn",function() {
        console.log($(this).attr('data-id'));
        let id = $(this).attr('data-id');
        // console.log(id);
        $.ajax({
            type:"POST",
            url:'update.php',
            dataType:"JSON",
            data:{
                "id": id
            },
            success:function(data){
                // console.log ('data');
                // console.log (data);
                // console.log (data.hobbies.split(','));
                $('form #rowid').val(data.id);
                $('form #firstname').val(data.firstname);
                $('form #lastname').val(data.lastname);
                $('form #email').val(data.email);
                $('form #gender').val(data.gender);
                $('form #dob').val(data.dob);
                $('form #hobbies').val(data.hobbies.split(','));
                $('#message').html("<h5>Data is Updating</h5>").css("color" ,"red").fadeOut(3000);

                return false;
                
            }
        });
    });


    //Delete data of table
    $(document).on("click",".delete-btn",function() {
        console.log($(this).attr('data-id'));
        let id = $(this).attr('data-id');
        $.ajax({
            type:"POST",
            url:'delete.php',
            data:{
                "id": id
            },
            success:function(data){
                getRowData();
                $('#message').html("<h5>Data Deleted</h5>").css("color" ,"red").fadeOut("slow");

                return false;
            }
        });
    });


});
    </script>
</html>