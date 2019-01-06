<?php
ini_set('memory_limit', '-1');
ini_set('max_execution_time', 0);
$url = 'https://api.cloudflare.com/client/v4/zones';


$domainsList = 'name1.tld,name2.tld,namex.tld'; //List of website domains
$domains = explode(',', $domainsList);

foreach($domains as $domain) {
    $bodyData= [
      "name" => $domain,
      "account" => [
        "id" => "CloudFlareAccountID",
        "name" => "CloudFlareAccountName"
      ],
      "jump_start" => true
    ];

    $bodyData = json_encode($bodyData);
    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $bodyData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'X-Auth-Email: CloudFlareAccountEmail',
        'X-Auth-Key: YourCloudFlareGlobalAPI',
        'Content-Type: application/json'
    ));
    $result = curl_exec($ch);
    curl_close($ch);

    print_r($result); //Showing the result
    echo '<br><br>';
}
