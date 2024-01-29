<?php
$api_key = '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';

$api_endpoint = 'https://api.openai.com/v1/chat/completions';

$message = 'dog names random';

$model = 'gpt-3.5-turbo';

$data = array(
    'model' => $model,
    'messages' => array(
        array('role' => 'system', 'content' => 'You are a helpful assistant.'),
        array('role' => 'user', 'content' => $message),
    ),
);

$ch = curl_init($api_endpoint);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $api_key,
));

$response = curl_exec($ch);


if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
}

curl_close($ch);

if ($response) {
    $decoded_response = json_decode($response, true);
    print_r($decoded_response);
} else {
    echo 'No response received';
}
