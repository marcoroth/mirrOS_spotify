<?php

	include('../../../config/glancrConfig.php');

	setConfigValue("spotify_client_id", "");
	setConfigValue("spotify_client_secret", "");
	setConfigValue("spotify_access_token", "");
	setConfigValue("spotify_refresh_token", "");
	setConfigValue("spotify_redirect_uri", "");
	setConfigValue("spotify_code", "");
	setConfigValue("spotify_expires_at", "");
	setConfigValue("reload", "1");

	header("location: /config/");

?>
