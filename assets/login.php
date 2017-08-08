<?php

	require "../../../config/glancrConfig.php";

	$client_id = getConfigValue("spotify_client_id");
	$redirect_uri = getConfigValue("spotify_redirect_uri");

	$scopes = [
		"user-read-playback-state",
		"user-read-currently-playing"
	];

	$scopes_string = join('%20', $scopes);

	$url = "https://accounts.spotify.com/de/authorize?response_type=code&client_id=" . $client_id . "&show_dialog=true&redirect_uri=" . $redirect_uri . "&scope=" . $scopes_string;

	header("Location: $url");

?>
