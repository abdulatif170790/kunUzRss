<?php
include_once('simplehtmldom/simple_html_dom.php');

$html = file_get_html("http://app.kun.uz/mobapi/postview/index?id=123983&lang=uz_l");

foreach($html->find('h4') as $e)
    $e->outertext = '';
foreach($html->find('hr') as $e)
    $e->outertext = '';
foreach($html->find('style') as $e)
    $e->outertext = '';
foreach($html->find('script') as $e)
    $e->outertext = '';
foreach($html->find('div.mini-news') as $e)
    $e->outertext = '';
foreach($html->find('div.ssk-lg') as $e)
    $e->outertext = '';
foreach($html->find('div.data') as $e)
    $e->outertext = '';
foreach($html->find('embed.advertisement') as $e)
    $e->outertext = '';
$content = "";
foreach($html->find('div.container') as $e) {
    $content = $e->outertext;
    break;
}
echo $content;

?>

