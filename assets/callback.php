<?php

	require '../../../config/glancrConfig.php';

	$client_id = getConfigValue("spotify_client_id");
	$client_secret = getConfigValue("spotify_client_secret");
	$redirect_uri = urldecode(getConfigValue("spotify_redirect_uri"));

	if (!isset($_GET["error"])){

			if (isset($_GET["code"])){

				setConfigValue("spotify_code", $_GET["code"]);

				$url = "https://accounts.spotify.com/api/token";
				$curl = @curl_init();

				@curl_setopt_array($curl, array(
				  CURLOPT_URL => $url,
					CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_CUSTOMREQUEST => "POST",
				  CURLOPT_POSTFIELDS => "client_id=" . $client_id . "&client_secret=". $client_secret. "&grant_type=authorization_code&code=" . $_GET["code"] . "&redirect_uri=" . $redirect_uri,
				  CURLOPT_HTTPHEADER => array( "content-type: application/x-www-form-urlencoded" )
				));

				$response = curl_exec($curl);
				curl_close($curl);

				header("Content-Type: application/json");
				$json = json_decode($response, true);

				$access_token = $json["access_token"];
				$refresh_token = $json["refresh_token"];
				$expires_in = $json["expires_in"];
				$expires_at = time()+$expires_in;

				header("Content-Type: application/json");

				if (strlen($access_token) > 1 && strlen($refresh_token) > 1 && strlen($expires_at) > 1){
					setConfigValue("spotify_access_token", $access_token);
					setConfigValue("spotify_refresh_token", $refresh_token);
					setConfigValue("spotify_expires_at", $expires_at);
					echo '{ "success": true }';
					header("Location: /config/");
				} else {
					echo '{ "success": false }';
				}

			}
	}

?>
