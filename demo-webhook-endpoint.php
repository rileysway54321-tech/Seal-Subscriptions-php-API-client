<?php

	require_once dirname(__FILE__).'/SealApiClient.php';
	
	$SealApiClient = new SealApiClient(seal_token_d0ekquazta3lcog9txm6ndnbwz5so2qm93f63hd5, seal_secret_1cat02p2xpz9m3pkin7nlziibnt7nnxyhau2zips);
	
	$webhookContent = '';
	$webhook = fopen('php://input' , 'rb');

	while (!feof($webhook)) {
		$webhookContent .= fread($webhook, 4096);
	}
	fclose($webhook);

	if ($SealApiClient->isWebhookHmacValid($webhookContent) !== true) {
		// Validate the HMAC sent inthe headers, to make sure that the request was sent by Seal Subscriptions and not by somebody else
		die('HMAC is not valid');
	}
	
	// $_SERVER['HTTP_X_SEAL_TOPIC'] contains the topic of the webhook (subscription/created, subscription/updated)
	
	// Decode the webhook payload
	$jsonPayload = json_decode($webhookContent, true);
	
	// TODO: Do something with the JSON payload
?>
