<?php 

$url = "https://dog.ceo/api/breeds/image/random";
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);


$result = curl_exec($ch);

if (curl_errno($ch)) {
    echo json_encode(["status" => "error", "message" => "Error fetching dog image"]);
} else {
    $data = json_decode($result, true);
    if ($data && $data['status'] === "success") {
        echo json_encode(["status" => "success", "message" => $data['message']]);
    } else {
        echo json_encode(["status" => "error", "message" => "Error fetching dog image"]);
    }
}

curl_close($ch);


?>