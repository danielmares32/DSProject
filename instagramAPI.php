<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");	
    $jsonurl = 'https://www.instagram.com/graphql/query/?query_hash=298b92c8d7cad703f7565aa892ede943&variables={"tag_name":"australia","first":12,"after":"XXXXXXXX"}';
    //$jsonurl = 'https://www.instagram.com/graphql/query/?query_hash=298b92c8d7cad703f7565aa892ede943&variables={%22tag_name%22:%22echandorollo%22,%22first%22:12,%22after%22:%22XXXXXXXX%22}';
    $json = file_get_contents($jsonurl);
    $array[]=json_decode($json,true);
    var_dump($array[0]["data"]["hashtag"]["edges"]["node"]["thumbnail_src"]);
?>