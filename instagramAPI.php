<?php
    header("Access-Control-Allow-Origin: *");
    header("Access-Control-Allow-Headers: *");	
    $jsonurl = 'https://www.instagram.com/graphql/query/?query_hash=298b92c8d7cad703f7565aa892ede943&variables={"tag_name":"hello","first":12,"after":"XXXXXXXX"}';
    $json = file_get_contents($jsonurl);
    var_dump(json_decode($json));
?>