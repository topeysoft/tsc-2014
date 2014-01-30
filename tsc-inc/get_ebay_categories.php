<?php

$endpoint = "https://api.ebay.com/ws/api.dll";

$api_dev_name = "secret";
$api_app_name = "secret";
$api_cert_name = "secret";
$auth_token = "a very long secret";

$headers = array(
	'Content-Type:text/xml',
	'X-EBAY-API-COMPATIBILITY-LEVEL: 819',
	'X-EBAY-API-DEV-NAME: '.$api_dev_name,
	'X-EBAY-API-APP-NAME: '.$api_app_name,
	'X-EBAY-API-CERT-NAME :'.$api_cert_name,
	'X-EBAY-API-CALL-NAME: GetCategories',
	'X-EBAY-API-SITEID: 3' # eBay.co.uk
);

$body = <<<BODY
<?xml version="1.0" encoding="utf-8"?>
<GetCategoriesRequest xmlns="urn:ebay:apis:eBLBaseComponents">
<RequesterCredentials>
<eBayAuthToken>$auth_token</eBayAuthToken>
</RequesterCredentials>
<ViewAllNodes>True</ViewAllNodes>
<DetailLevel>ReturnAll</DetailLevel>
</GetCategoriesRequest>
BODY;
$body = utf8_encode($body);

$curl = curl_init();

curl_setopt_array($curl,
	array(
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL => $endpoint,
		CURLOPT_POST => 1,
		CURLOPT_POSTFIELDS => $body,
		CURLOPT_HTTPHEADER => $headers
	)
);

$response = curl_exec($curl);
curl_close($curl);

if(!$response){
    die('Error: "' . curl_error($curl) . '" - Code: ' . curl_errno($curl));
}
else
{
	echo $response;
}

?>