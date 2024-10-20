<?php
$listPath = dirname(__FILE__) . "/cache/schools/school_list_" . str_replace(".", "", htmlspecialchars($_GET["city"], ENT_QUOTES)) . ".txt";
$timePath = dirname(__FILE__) . "/cache/schools/time_created_" . str_replace(".", "", htmlspecialchars($_GET["city"], ENT_QUOTES)) . ".txt";
$fileExists = file_exists($listPath);
$timeFileExists = file_exists($timePath);
if($fileExists && $timeFileExists){
    $timeFile = fopen($timePath, "r");
    $timeRead = fread($timeFile, filesize($timePath));
    fclose($timeFile);
    if($timeRead && intval($timeRead) > (time() - 30 * 24 * 60 * 60)){
        $listFile = fopen($listPath, "r");
        $listRead = fread($listFile, filesize($listPath));
        fclose($listFile);
        echo $listRead;
        exit();
    }
}

$url = "https://sluzby.bakalari.cz/api/v1/municipality/" . htmlspecialchars($_GET["city"], ENT_QUOTES);

$ch = curl_init();

// Nastavení cURL pro GET požadavek
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Přidání HTTP záhlaví
$headers = [
    "Accept: application/json"
];
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Provedení požadavku a uložení odpovědi
$response = curl_exec($ch);
curl_close($ch);
echo $response;
if(curl_error($ch)) exit();
if(!$response || empty($response)) exit();

$timeFile = fopen($timePath, "w");
fwrite($timeFile, time() . "");
fclose($timeFile);

$listFile = fopen($listPath, "w");
fwrite($listFile, $response);
fclose($listFile);
?>