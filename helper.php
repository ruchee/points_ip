<?php

/**
 * 获取免费IP地址1
 */
function get_free_ips1 () {
    $base_url = 'http://www.kuaidaili.com/proxylist/';

    $all_ips = [];
    for ($i = 1; $i <= 10; ++$i) {
        $url = $base_url.$i;
        $html = file_get_contents($url);
        preg_match_all("/<td>((?:\d+\.){3}\d+)<\/td>[^<]*<td>(\d+)<\/td>/", $html, $match);
        $ips = @$match[1];
        $ports = @$match[2];

        if ($ips and $ports) {
            foreach ($ips as $key => $ip) {
                array_push($all_ips, $ip.':'.$ports[$key]);
            }
        }
    }

    return $all_ips;
}

/**
 * 获取免费IP地址2
 */
function get_free_ips2 () {
    $url = 'http://cn-proxy.com';

    $all_ips = [];
    $html = file_get_contents($url);
    preg_match_all("/<td>((?:\d+\.){3}\d+)<\/td>[^<]*<td>(\d+)<\/td>/", $html, $match);
    $ips = @$match[1];
    $ports = @$match[2];

    if ($ips and $ports) {
        foreach ($ips as $key => $ip) {
            array_push($all_ips, $ip.':'.$ports[$key]);
        }
    }

    return $all_ips;
}


/**
 * 对指定网址发起请求
 */
function curl_get ($url, $ip = '') {
    $ch = curl_init();

    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_HEADER, false);
    curl_setopt($ch, CURLOPT_ENCODING, 'gzip');
    curl_setopt($ch, CURLOPT_TIMEOUT, 6);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/4.0 (compatible; MSIE 8.0; Windows NT 5.1; Trident/4.0;)');
    curl_setopt($ch, CURLOPT_PROXY, $ip);
    $ret = curl_exec($ch);
    curl_close($ch);

    return $ret;
}
