<?php

define("HOSTNAME","localhost");
define("USERNAME","root");
define("PASSWORD","");
define("DATABASE","form_data");

$conn = mysqli_connect(HOSTNAME,USERNAME,PASSWORD,DATABASE);

if(!$conn){
    die("Error". mysqli_connect_error());
}
// else{
//     echo "Connect";
// }

?>