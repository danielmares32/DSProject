<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");	
    $hashtag=substr($_POST["hashtag"],1);
    $jsonurl = 'https://www.instagram.com/explore/tags/'.$hashtag.'/?__a=1';
    if(@file_get_contents($jsonurl)){
        $array[]=json_decode(file_get_contents($jsonurl),true);
        $imgArray[]=$array[0]["graphql"]["hashtag"]["edge_hashtag_to_media"]["edges"];
        for ($i=0; $i < count($imgArray[0]); $i++) { 
            $url = $imgArray[0][$i]["node"]["thumbnail_src"];
            $im = file_get_contents($url);
            echo '<div class="col-sm-4 col-md-3 py-3"><div class="card">';
            echo "<img class='card-img-top' src='data:image/jpg;base64,".base64_encode($im)."' alt='Image'>";
            echo '</div></div>';
        }
    }
?>