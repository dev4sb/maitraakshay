<?php
$apikey = "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";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $websiteUrl = filter_var($_POST['websiteUrl'], FILTER_SANITIZE_URL);

    $html = file_get_contents($websiteUrl);
    preg_match('/<title>(.*?)<\/title>/', $html, $matches);
    $websiteTitle = isset($matches[1]) ? $matches[1] : 'Title not found';

    $prompt = "Determine the industry of a website with the title: $websiteTitle";
    $api_url = 'https://api.openai.com/v1/chat/completions';

    $headers = [
        'Content-Type: application/json',
        'Authorization: Bearer ' . $apikey,
    ];

    $data = [
        "model" => "gpt-3.5-turbo",
        "messages" => [
            ["role" => "system", "content" => "You are a helpful assistant."],
            ["role" => "user", "content" => $prompt],
        ],
    ];

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

        if (isset($result['choices']) && is_array($result['choices']) && count($result['choices']) > 0) {
            $industry = $result['choices'][0]['message']['content'];
            echo "<p><strong>Website Title:</strong> $websiteTitle</p>";
            echo "<p><strong>Industry:</strong> $industry</p>";
        } else {
            echo 'Error: Unexpected response structure.';
        }
    }

    curl_close($ch);
} else {
    echo 'Invalid request method.';
}
?>
