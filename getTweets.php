<?php

define('CONSUMER_KEY', 'b5cyPGG8rHq1vYPyLmzog7Efa');
define('CONSUMER_SECRET', '5UyBfVo7a7retOAdAyWfNJaplt0xfTeZ6QXShP0n0Oupvywl9Q');

$x = base64_encode(rawurlencode(CONSUMER_KEY).":".rawurlencode(CONSUMER_SECRET));
$url = "https://api.twitter.com/oauth2/token";
$header = array();
$header[] = "Authorization: Basic $x";
$header[] = "Content-Type: application/x-www-formurlencoded; charset=UTF-8";

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl,CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_HTTPHEADER, $header);
curl_setopt($curl,CURLOPT_POST, 1);
curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,0);
curl_setopt($curl,CURLOPT_POSTFIELDS,"grant_type=client_credentials");
$output = curl_exec($curl);
$result = json_decode($output,true);
$access_token = $result['access_token'];
curl_close($curl);

$query = urlencode("query"); //include your query

$search_url = "https://api.twitter.com/1.1/search/tweets.json?q=$query&result_type=recent&count=5"; //retrieve 5 most recent tweets

$output = file_get_contents($search_url,false,stream_context_create(array(

'http'=>array(
'method'=>"GET",
'header'=>"Authorization:Bearer
$access_token"))));
$result = json_decode($output,true); //results returned as JSON


$result = $result['statuses'];
for ($i=0;$i<count($result);$i++) {
$id = $result[$i]['id_str']; //tweet id
$username = $result[$i]['user']['name']; //user posting tweet
$text = $result[$i]['text']; //tweet text
$user_location = ???? //user location
}
?>