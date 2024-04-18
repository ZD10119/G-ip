<?php
function getUserIP() {
    $client  = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote  = $_SERVER['REMOTE_ADDR'];

    if (filter_var($client, FILTER_VALIDATE_IP)) {
        $ip = $client;
    } elseif (filter_var($forward, FILTER_VALIDATE_IP)) {
        $ip = $forward;
    } else {
        $ip = $remote;
    }

    return $ip;
}

$user_ip = getUserIP();

// 获取地理位置信息
$lat = $_POST['lat'] ?? 'Unknown';
$lon = $_POST['lon'] ?? 'Unknown';

// 将 IP 地址、地理位置和访问时间记录到文本文件
$date = date('Y-m-d H:i:s');
$logEntry = "$date - IP: $user_ip, Latitude: $lat, Longitude: $lon\n";
file_put_contents('ip_log.txt', $logEntry, FILE_APPEND);

echo "Your IP address is: " . $user_ip . "<br>";
echo "Your location is: Latitude $lat, Longitude $lon<br>";
?>
