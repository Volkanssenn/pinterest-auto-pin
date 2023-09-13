<?php
$access_token = 'YOUR_ACCESS_TOKEN';  
$board_id = 'YOUR_BOARD_ID'; // pano (board) kimliği
$image_url = 'https://i.pinimg.com/564x.jpg'; // Resim URL'si

$pin_data = array(
    'title' => 'My Pin', // Pin Başlığı
    'description' => 'Pin Description', // Pin Açıklaması
    'board_id' => $board_id,
    'media_source' => array(
        'source_type' => 'image_url',
        'url' => $image_url
    )
);

$ch = curl_init('https://api.pinterest.com/v5/pins');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($pin_data));
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Authorization: Bearer ' . $access_token,
    'Content-Type: application/json'
));

$response = curl_exec($ch);
curl_close($ch);

if ($response) {
    $result = json_decode($response, true);
    if (isset($result['data']['id'])) {
        echo 'Pin başarıyla oluşturuldu: ' . $result['data']['id'];
    } else {
        echo 'Pin oluşturulurken bir hata oluştu: ' . print_r($result, true);
    }
} else {
    echo 'Pinterest API ile iletişim kurulamadı.';
}
?>