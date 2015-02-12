<?php

/**
 * http://www.bufan.com/hd/jmz2015
 */

include __DIR__.'/helper.php';

$ip_file = __DIR__.'/abc2_ips.txt';

if (! is_file($ip_file)) {
    $ips = get_free_ips2();
    file_put_contents($ip_file, json_encode($ips));
}

$ips = @json_decode(file_get_contents($ip_file), true);
if (! $ips) {
    exit('代理IP不存在');
}

foreach ($ips as $key => $ip) {
    $url = 'http://www.bufan.com/hdapi/do?event_name=Jmz2015&action=vote&item_id=79';
    $ret = curl_get($url, $ip);
    $ret = @json_decode($ret, true);
    echo "{$ret['code']} - {$ret['msg']}\n";
}
unlink($ip_file);
