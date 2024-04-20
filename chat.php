<?php
// Your OpenAI API key
$apiKey = 'YOUR_API_KEY';
$url = 'https://api.openai.com/v1/engines/text-davinci-003/completions';
$message = $_POST['user-input'];

$data = array(
    'prompt' => $message,
    'max_tokens' => 150,
    'temperature' => 0.7
);

$headers = array(
    'Content-Type: application/json',
    'Authorization: Bearer ' . $apiKey
);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

$chatGPTResponse = json_decode($response, true);

if (isset($chatGPTResponse['choices']) && !empty($chatGPTResponse['choices'])) {
    $botMessage = $chatGPTResponse['choices'][0]['text'];
    echo '<div class="message-container"><div class="bot-message">' . $botMessage . '</div></div>';
} else {
    echo '<div class="message-container"><div class="bot-message">Sorry, I could not understand that.</div></div>';
}
?>
