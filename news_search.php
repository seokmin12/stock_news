<?php 

$query = $_POST['search'];
$url = "https://search.naver.com/search.naver?where=news&query=$query&sm=tab_opt&sort=0&photo=0&field=0&reporter_article=&pd=4&ds=&de=&docid=&nso=so%3Ar%2Cp%3A1d%2Ca%3Aall&mynews=0&refresh_start=0&related=0";
echo("<script>location.href='$url';</script>");

?>