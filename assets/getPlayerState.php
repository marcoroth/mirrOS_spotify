<?php

	require "../../../config/glancrConfig.php";

	$expires_at = getConfigValue("spotify_expires_at");

	if (($expires_at-300)-time() > 0){
		file_get_contents("/modules/spotify/assets/refreshToken.php");
	}

	$url = "https://api.spotify.com/v1/me/player";

	$access_token = getConfigValue("spotify_access_token");

	$curl = curl_init();

	curl_setopt_array($curl, array(
	  CURLOPT_URL => $url,
	  CURLOPT_CUSTOMREQUEST => "GET",
	  CURLOPT_HTTPHEADER => array(
	    "accept: application/json",
	    "authorization: Bearer ". $access_token
		 ),
	));

	$response = curl_exec($curl);
	$err = curl_error($curl);

	curl_close($curl);


	if ($err) {
	  echo "cURL Error #:" . $err;
	} else {
		header("Content-Type: application/json");
	}

?>
