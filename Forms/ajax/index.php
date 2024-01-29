<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajax Call</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    

</head>
<script>
  $(document).ready(function(){
    $('#getData').click(function () {
        $.ajax({
            url : 'ajaxgetdata.php',
            type : 'GET',
            // dataType : 'json',
            success : function (response){
                console.log(response);
                $('#data').append(response).css('color','green');
                $('#remove').click(function(){
                    $('#data').remove();
                });
            }
        });
      });
  });

//   $(document).ready(function(){
//     $('#update').click(function(){
//         $.ajax({
//             url : 'ajaxgetdata.php',
//             type : 'GET',
//             success : function(updateData){
//                 $('#updateData').append(updateData).css('color','red');
//             }
//         });
//     });
//   });
</script>
<body>
    <button id="getData">Data</button>
    <h1 id="data"></h1>

    <button id="remove">Remove</button>
    <br><br>
    <!-- <button id="update">Update</button>
    <h1 id="updateData"></h1>
</body> -->
</html>
