 
<?php
$url = 'https://youtube.com/playlist?list=PLxCzCOWd7aiHMonh3G6QNKq53C6oNXGrX'; //pass your dynamic url here
$substr = "=";
if (strpos($url, $substr) !== false) {
    $url_arr  = explode("=", $url);
    $video_id = $url_arr[1];
} else {
    $url_arr  = explode("/", $url);
    $video_id = $url_arr[3];
}
$embed_url = "https://www.youtube.com/embed/" . $video_id;
?>



<iframe width="400" height="250" 
 src="<?php echo $embed_url;?>"
 frameborder="0" allow="accelerometer; autoplay; encrypted-media; 
 gyroscope; picture-in-picture" allowfullscreen>
</iframe>

