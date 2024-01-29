<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<?php

$apikey = "API_KEY_HERE"; 

$inputType = ($_POST['inputType'] === 'images') ? 'images' : 'text';
$prompt = htmlspecialchars($_POST['prompt']);

// echo "<pre>";
// print_r($inputType);
// die;

$api_url = 'https://api.openai.com/v1/chat/completions';

$headers = [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apikey,
];

$data = [
    "model" => "gpt-4-0125-preview",
    "messages" => [
        ["role" => "system", "content" => "You are a helpful assistant."],
        ["role" => "user", "content" => $prompt],
    ],
];

if ($inputType === 'images') {
    $data["messages"][1]["content"] = "Generate an image of:";
    $data["messages"][1]["image"] = ["url" => "https://api.openai.com/v1/images/generations"];
}

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$response = curl_exec($ch);

if ($response === false) {
    echo 'Error: ' . curl_error($ch);
} else {
    $result = json_decode($response, true);

    // echo '<pre>';
    // print_r($result);
    // echo '</pre>';


    if (isset($result['choices']) && is_array($result['choices']) && count($result['choices']) > 0) {
        echo '<div class="alert alert-primary"><p><strong>Response:</strong> ' . $result['choices'][0]['message']['content'] . '</p></div>';
    } else {
        echo 'Error: Unexpected response structure.';
    }
}

curl_close($ch);
?>
