<?php
	require_once __DIR__ . '/../Facebook/autoload.php';

	$FB = new \Facebook\Facebook([
		'app_id' => '213434388211472',
		'app_secret' => '56e5f46cbfcdc6f45b0afa93140725c1',
		'default_graph_version' => 'v2.10'
	]);

	$helper = $FB->getRedirectLoginHelper();
?>
