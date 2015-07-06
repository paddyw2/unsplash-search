<?php

$tag = $_POST["tag"];

$tag1 = str_replace(',','%2C',$tag);
$tag2 = str_replace(' ','+',$tag1);

$hostname = getenv('HTTP_HOST');
$home_url = "http://".$hostname;

// Pixabay API details

$api_key = ****************;
$username = ***************;

$url = "https://pixabay.com/api/?username=".$username."&key=".$api_key."&q=user%3Aunsplash+".$tag."&image_type=photo";

$string = file_get_contents($url);
    
$json_decoded = json_decode($string,true);

$total = $json_decoded['totalHits'];

if ($total != 0) {


$site_array = array();
$url_array = array();
$int = 0;
    
    if ($total >= 19) {
        $total = 19;
    }

while($int < $total) {


    $web_url = $json_decoded['hits'][$int]['webformatURL'];
    $site_url = $json_decoded['hits'][$int]['pageURL'];

    array_push($url_array, $web_url);
    array_push($site_array, $site_url);

    $int++;
 
}


if (count($url_array) > 0) {
    
$array_length = count($url_array);
$array_length = $array_length - 1;
$random_int = rand(0, $array_length);
    
$rand_url = $url_array[$random_int];
$rand_site = $site_array[$random_int];
    
$photoURL = $rand_url;
$error_message = "<a href='$rand_site'><div class='button extra-class'>View Photo</div></a></h3>";
}
    
} else {
    $photoURL = "https://ununsplash.imgix.net/uploads/14128324071271c853818/3765c625?dpr=1.5&fit=crop&fm=jpg&h=700&q=75&w=1075";
    $error_message = "<h3>No images found! Try choosing different tags, or remove all tags to view popular photos.<br><a href='$home_url'><div class='button extra-class' style='margin-top: 10px !important;'>Go Back</div></a></h3>";
}


?>