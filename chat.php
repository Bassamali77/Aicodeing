
<?php
$apiKey = 'YOUR_OPENAI_API_KEY'; // استبدله بمفتاحك الحقيقي

$userMessage = $_POST['message'] ?? '';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://api.openai.com/v1/chat/completions");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
  "Content-Type: application/json",
  "Authorization: Bearer $apiKey"
]);

$data = [
  "model" => "gpt-3.5-turbo",
  "messages" => [
    ["role" => "user", "content" => $userMessage]
  ]
];

curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
$response = curl_exec($ch);
curl_close($ch);

$responseData = json_decode($response, true);
$reply = $responseData['choices'][0]['message']['content'] ?? 'حدث خطأ ما.';

echo json_encode(['reply' => $reply]);
?>
