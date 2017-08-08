<?php

	$client_id = getConfigValue('spotify_client_id');
	$client_secret = getConfigValue('spotify_client_secret');
	$access_token = getConfigValue('spotify_access_token');
	$refresh_token = getConfigValue('spotify_refresh_token');
	$expires_at = getConfigValue('spotify_expires_at');

	$host =  $_SERVER["HTTP_HOST"];
	$redirect_uri = "http://" . $host . "/modules/spotify/assets/callback.php";

	setConfigValue("spotify_redirect_uri", urlencode($redirect_uri));

?>

<section class="spotify_step_section" id="spotify_step1">
	<h4><?php echo _('spotify_how_to_use'); ?></h4><br>

	<h5><?php echo _('spotify_create_app'); ?>:<br>
	<a class="button" href="https://developer.spotify.com/my-applications/">Spotify App</a> </h5><br>

	<h5><?php echo _('spotify_tutorial_text'); ?>: <br>
	<a class="button" href="https://glancr.de/tutorials/das-spotify-modul-konfigurieren/"><?php echo _('spotify_tutorial_create_app'); ?></a></h5> <br>

	<h5><?php echo _('spotify_copy_values'); ?></h5> <br>

	<h6><?php echo _('spotify_application_name'); ?></h6>
	<input type="text" id="spotify_application_name" onclick="this.select();" placeholder="<?php echo _('spotify_application_name'); ?>" value="Glancr Smart Mirror" />

	<h6><?php echo _('spotify_application_description'); ?></h6>
	<input type="text" id="spotify_application_description" onclick="this.select();" placeholder="<?php echo _('spotify_application_description'); ?>" value="Spotify integration for Glancr mirr.OS" />

	<h6><?php echo _('spotify_redirect_uri'); ?></h6>
	<input type="text" id="spotify_redirect_uri" onclick="this.select();" placeholder="<?php echo _('spotify_redirect_uri'); ?>" value="<?php echo $redirect_uri; ?>" /><br><br>

	<div class="button" id="spotify_save_step1" style="width: 100%">
		<button class="spotify_save_step1--button" href="#">
			<span><?php echo _('spotify_next_step'); ?></span>
		</button>
	</div>
</section>

<section class="spotify_step_section" id="spotify_step2">
	<h6><?php echo _('spotify_client_id'); ?></h6>
	<input type="text" id="spotify_client_id" placeholder="<?php echo _('spotify_client_id'); ?>" value="<?php echo $client_id; ?>"/>

	<h6><?php echo _('spotify_client_secret'); ?></h6>
	<input type="text" id="spotify_client_secret" placeholder="<?php echo _('spotify_client_secret'); ?>" value="<?php echo $client_secret; ?>"/>

	<div class="button" id="spotify_save_step2" style="width: 100%">
		<button class="spotify_save_step2--button" href="#">
			<span><?php echo _('spotify_save'); ?></span>
		</button>
	</div>
</section>

<section class="spotify_step_section" id="spotify_step3">
	<a href="/modules/spotify/assets/login.php" id="spotify_follow_button"><i class="fa fa-spotify" aria-hidden="true"></i> <?php echo _("spotify_login_with_spotify"); ?></a><br><br>
</section><br><br>

<section class="spotify_step_section" id="spotify_step4">
	<?php echo _("spotify_modul_configured"); ?>
</section><br><br>

<?php

	if (strlen($client_id) > 1 &&  strlen($client_secret) > 1  && strlen($access_token) > 1 && strlen($refresh_token) > 1 && strlen($expires_at) > 1 && strlen($client_id) > 1 ){
		echo '<script> setTimeout(function(){ $(".spotify_step_section").hide(); $("#spotify_step4").show(); }, 2000)</script>';
	}

?>

<a href="/modules/spotify/assets/reset.php"><?php echo _("spotify_reset_config"); ?></a><br /><br />
