<?php

error_reporting(0);
header('Content-Type: application/json');
include_once("classyoutubedownloader.php");
include_once("helper.php");

if (isset($_GET['id'])) {
  $link = $_GET['id'];
    $ytb = new YoutubeDownloader("https://www.youtube.com/watch?v=".$link);
echo $ytb->execute();
} else {
 echo errMsg("url youtube tidak di temukan");

}
?>
