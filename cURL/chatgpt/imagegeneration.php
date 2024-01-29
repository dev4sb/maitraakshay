<?php
$number = 3; 
$resolution = '512x512';
$apikey = "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";
$yourinput = 'cat with brown hair wearing red jackets and standing in a garden';

$api_url = 'https://api.openai.com/v1/images/generations';

$headers = [
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apikey,
    // "model : 'dall-e-3",

];

$data = [
    "prompt" => $yourinput,
    "n" => 1,
    "size" => $resolution,
];

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$output = curl_exec($ch);

if ($output === false) {
    echo 'Curl error: ' . curl_error($ch);
} else {
    file_put_contents("image" . $number . ".data", $output);

    $joutput = json_decode($output, true);

    if (isset($joutput["data"][0]["url"])) {
        // $image_content = file_get_contents($joutput);
        // $image = imagecreatefromstring($imageContent);
        file_put_contents("image" . $number . ".jpg", file_get_contents($joutput["data"][0]["url"]));
        echo '<a href="' . $joutput["data"][0]["url"] . '">DOWNLOAD</a><br>';
    } else {
        print_r($joutput);
    }
}

// Close cURL session
curl_close($ch);

echo 'done';
?>
