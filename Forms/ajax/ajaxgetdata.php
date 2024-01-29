<?php

    $data = array('message'=>'Retrived Data', 'data'=>'hi');
    
    $responseData = json_encode($data);

    echo $responseData;

    // $update = array('updated'=>'demoworld','message'=> 'testing');

    // $responseDataTwo = json_encode($update);

    // echo $responseDataTwo;

?>