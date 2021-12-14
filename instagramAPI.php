<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");	

    //$jsonurl = 'https://www.instagram.com/graphql/query/?query_hash=298b92c8d7cad703f7565aa892ede943&variables={%22tag_name%22:%22australia%22,%22first%22:12,%22after%22:%22AQAbn0VY16CEYymK6h0pgP-MM7g%22}';
    $jsonurl = 'https://www.instagram.com/explore/tags/australia/?__a=1';
    $json = file_get_contents($jsonurl);
    $array[]=json_decode($json,true);
    $imgArray[]=$array[0]["graphql"]["hashtag"]["edge_hashtag_to_media"]["edges"];
    var_dump($array);
    /*echo '<h1>'.count($imgArray).'</h1>';
    for ($i=0; $i < count($imgArray); $i++) { 
        echo '<h1>'.$imgArray[$i]["node"]["thumbnail_src"].'</h1>';
    }*/
    echo '<h1>'.$array[0]["graphql"]["hashtag"]["edge_hashtag_to_media"]["edges"][0]["node"]["thumbnail_src"].'</h1>';
    echo $array[0]["graphql"]["hashtag"]["edge_hashtag_to_media"]["edges"][1]["node"]["thumbnail_src"];
    echo $array[0]["graphql"]["hashtag"]["edge_hashtag_to_media"]["edges"][2]["node"]["thumbnail_src"];
    echo $array[0]["graphql"]["hashtag"]["edge_hashtag_to_media"]["edges"][3]["node"]["thumbnail_src"];

    //var_dump($array[0]["data"]["hashtag"]["edges"]["node"]["thumbnail_src"]);
    /*var_dump($array[0]["data"]["hashtag"]["edge_hashtag_to_media"]);*/
?>