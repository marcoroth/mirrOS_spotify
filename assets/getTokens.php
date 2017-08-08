<?php

	require "../../../config/glancrConfig.php";

	$access_token = getConfigValue("spotify_access_token");
	$refresh_token = getConfigValue("spotify_refresh_token");
	$code = getConfigValue("spotify_code");
	$client_id = getConfigValue("spotify_client_id");
	$client_secret = getConfigValue("spotify_client_secret");
	$expires_at = getConfigValue("spotify_expires_at");
	$redirect_uri = getConfigValue("spotify_redirect_uri");

	$tokens = [
		"access_token" => $access_token,
		"refresh_token" => $refresh_token,
		"expires_at" => $expires_at,
		"redirect_uri" => $redirect_uri,
		"code" => $code,
		"client_id" => $client_id,
		"client_secret" => $client_secret];

	foreach ($tokens as $token => $value) {
		if ($value == null){
			$tokens[$token] = "";
		}
	}

	header("Content-Type: application/json");
	echo json_encode($tokens);

?>
