<?php

require 'TiktokDownload.php';
$directUrl = urldecode($_GET['u']);
$title = urldecode($_GET['t']);
$format = $_GET['f'];
$tiktokDownload  = new TiktokDownload();
$tiktokDownload->forceDownload($directUrl, $title, $format);
