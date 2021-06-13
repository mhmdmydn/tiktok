<?php
require './libs/TiktokDownload.php';
header('Content-Type: application/json');


// usage = api.php?url=https://www.tiktok.com/@benok_haha/video/6973007985903668482
if (isset($_GET["url"])) {
    $tiktokdown = new TiktokDownload($_GET["url"]);
    $json = json_decode(json_encode($tiktokdown->get()), true);

    $video = $json["video"];
    $music = $json["music"];
    $author = $json["author"];

    $results = array(
        "status" => true,
        "title" => "Tiktok Downloader",
        "developer" => "ghodel-dev",
        "results" => [
            "video" => $video,
            "music" => $music,
            "author" => $author
        ]
    );

    echo json_encode($results);
} else {
    $results = array(
        "status" => false,
        "title" => "Tiktok Downloader",
        "developer" => "ghodel-dev",
        "Message" => "Invalid Url"
    );

    echo json_encode($results);
}
