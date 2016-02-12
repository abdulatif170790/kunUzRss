<?php

class rss_feed
{

    public function __construct($datas, $xmlns, $a_channel, $site_url, $site_name, $full_feed = false)
    {
        // initialize
        $this->datas = $datas;
        $this->xmlns = ($xmlns ? ' ' . $xmlns : '');
        $this->channel_properties = $a_channel;
        $this->site_url = $site_url;
        $this->site_name = $site_name;
        $this->full_feed = $full_feed;

    }

    public function create_feed()
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $xml .= '<rss version="2.0"' . $this->xmlns . '>' . "\n";
        $xml .= '<channel>' . "\n";
        $xml .= '    <title>' . $this->channel_properties["title"] . '</title>' . "\n";
        $xml .= '    <link>' . $this->channel_properties["link"] . '</link>' . "\n";
        $xml .= '    <description>' . $this->channel_properties["description"] . '</description>' . "\n";

        $rss_items = $this->datas;

        foreach ($rss_items as $rss_item) {
            $xml .= "\n".'    <item>' . "\n";
            $xml .= '        <title>' . $rss_item['title'] . '</title>' . "\n";
            $xml .= '        <link>' . $rss_item['url'] . '</link>' . "\n";
            $xml .= '        <description>' . $rss_item['category'] . '</description>' . "\n";
            $xml .= '        <pubDate>' . $rss_item['date_created'] . '</pubDate>' . "\n";
            $xml .= '        <category>' . $rss_item['category'] . '</category>' . "\n";
            $xml .= '        <source url="' . $rss_item['source'] . '">' . $this->channel_properties["title"] . '</source>' . "\n";

            if ($this->full_feed) {

                $html = file_get_html("http://app.kun.uz/mobapi/postview/index?id=".$rss_item['id']."&lang=uz_l");
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
                $xml .= '        <content:encoded>' . htmlspecialchars($content) . '</content:encoded>' . "\n";
            }
            $xml .= '    </item>' . "\n";
        }
        $xml .= '</channel>';
        $xml .= '</rss>';
        return $xml;
    }
}