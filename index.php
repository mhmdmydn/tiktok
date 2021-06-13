<?php

require './libs/TiktokDownload.php';
// header('Content-Type: application/json');
// $video = new TiktokDownload('https://www.tiktok.com/@the_object/video/6971368116584533250');
// echo (json_encode($results->get()));
error_reporting(E_ALL);
ini_set('display_errors', 'On');

error_reporting(E_ALL);
ini_set('display_errors', 'On');

function format_number($number)
{
    if ($number >= 1000) {
        return $number / 1000 . "k";   // NB: you will want to round this
    } else {
        return $number;
    }
}

$video = "";
$music = "";
$author = "";

$noProfile = "./assets/img/profile.png";
$noTumbnail = "./assets/img/tiktok.png";

if (isset($_POST['btnProses'])) {
    $url = $_POST['url'];

    if (strpos($url, "tiktok" ? "tiktok" : "vm") !== false) {
        $tikdown = new TiktokDownload($url);
        $result = json_decode(json_encode($tikdown->get()), true);

        $video = $result["video"];
        $music = $result["music"];
        $author = $result["author"];
    } else {
        echo "<script type='text/javascript'>" .
            "alert('Url Invalid')" .
            "</script>";
    }
}
?>

<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">


    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.all.min.js"></script>
    <link rel='stylesheet' href='https://cdn.jsdelivr.net/npm/sweetalert2@7.12.15/dist/sweetalert2.min.css'>



    <title>Tiktok Downloader</title>
</head>

<body style="background: #EEE;">

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="#">Tiktok Downloader</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <!-- <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Disabled</a>
                    </li>
                </ul> -->
            </div>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row text-center">
            <h1>Tiktok Downloader</h1>
        </div>
        <div class="col-6 mx-auto text-center">
            <form method="post">
                <label for="exampleFormControlInput1" class="form-label">Enter Url Here</label>
                <input type="text" class="form-control mb-3" name="url" id="exampleFormControlInput1" placeholder="example : https://vm.tiktok.com/ZSJx7WQcQ/" require>
                <button type="submit" class="btn btn-primary mb-3" name="btnProses">Go To Download</button>
            </form>
        </div>
    </div>

    <div class="container mb-3">
        <div class="title text-center">
            <h5> RESULT :</h5>
        </div>
        <div class="row">
            <div class="col-md-4 d-flex justify-content-center mx-auto">

                <div class="card" style="width: 18rem;">
                    <img src="<?= isset($video["animatedCover"]) ? $video["animatedCover"] : $noTumbnail;  ?>" class="card-img-top" height="300" alt="thumbnail">
                    <div class="card-body align-items-center">
                        <div class="author-profile d-inline-flex mb-2">
                            <img src="<?= isset($author["avatar_medium"]) ? $author["avatar_medium"] : $noProfile; ?>" class="rounded m-3 shadow-sm" alt="profile" width="75" height="75">
                            <div class="description">
                                <h5 class="card-title"><?= isset($author["username"]) ? $author["username"] : "Tiktok Username"; ?></h5>
                                <p class="card-text"><?= isset($video["title"]) ? $video["title"] : "Description"; ?></p>
                                <div class="d-inline-flex">
                                    <span><i class="bi bi-eye-fill m-1"></i><?= format_number(isset($video["views"])) ? format_number($video["views"]) : 0; ?></span>
                                    <span><i class="bi bi-chat-fill m-1"></i><?= format_number(isset($video["comments"])) ? format_number($video["comments"]) : 0; ?></span>
                                    <span><i class="bi bi-heart-fill m-1"></i><?= format_number(isset($video["likes"])) ? format_number($video["likes"]) : 0; ?></span>
                                </div>
                            </div>
                        </div>
                        <a href="<?= isset($video["download_url"]) ? $video["download_url"] : "#"; ?>" class="btn btn-primary d-flex justify-content-center mb-3">Download Video</a>
                        <h6 class="text-center mb-3">or</h6>
                        <a href="<?= isset($music["download_url"]) ? $music["download_url"] : "#";; ?>" class="btn btn-warning d-flex justify-content-center">Download Music</a>
                    </div>
                </div>


            </div>
        </div>
    </div>


    <footer class="footer mt-auto py-3 bg-dark text-light text-center">
        <div class="container">
            <span class="text-muted">Create with <i class="bi bi-heart-fill"></i> by <a href="https://github.com/mhmdmydn">ghodel-dev</a></span>
        </div>
    </footer>

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js" integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous"></script>
    -->


</body>

</html>