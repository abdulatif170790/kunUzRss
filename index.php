<?php
header('Content-type: application/xml; charset=UTF-8');
require_once 'rss_feed.php'; // configure appropriately
require_once 'simplehtmldom/simple_html_dom.php';

// set more namespaces if you need them
$xmlns = 'xmlns:content="http://purl.org/rss/1.0/modules/content/"
    xmlns:wfw="http://wellformedweb.org/CommentAPI/"
    xmlns:dc="http://purl.org/dc/elements/1.1/"
    xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"
    xmlns:atom="http://www.w3.org/2005/Atom"';

// configure appropriately - pontikis.net is used as an example
$a_channel = array(
    "title" => "Kun.uz",
    "link" => "http://kun.uz/",
    "description" => "КУННИНГ АСОСИЙ ЯНГИЛИКЛАРИ",
    "language" => "uz_l",
    "image_title" => "mehnat.uz",
    "image_link" => "http://kun.uz/",
    "image_url" => "https://kun.uz/images/stationary/logo.png",
);
$site_url = 'http://kun.uz/'; // configure appropriately
$site_name = 'http://kun.uz/'; // configure appropriately

$datas = json_decode(@file_get_contents("http://app.kun.uz/mobapi/post/index?type=main&lang=uz_l"), true)['data'];
$rss = new rss_feed($datas, $xmlns, $a_channel, $site_url, $site_name, true);
echo $rss->create_feed();


?>