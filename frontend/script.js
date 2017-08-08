$(document).ready(function () {
	$("#spotify_cover").attr("src", "/modules/spotify/assets/missing.png");
	$("#spotify_table #progress").hide();
	$("#spotify_table #time").hide();
	$("#spotify_table i").hide();
	reloadSpotify();
});

function reloadSpotify() {

	$.getJSON("/modules/spotify/assets/getPlayerState.php", function(data){

		if (data["error"] == null){
			$("#spotify_cover").attr("style", "");
			$("#spotify_frame").attr("style", "");
			if (data["is_playing"] == true ){

				position = data["progress_ms"];
				duration = data["item"]["duration_ms"];

				device_name = data["device"]["name"];
				repeat_state = data["repeat_state"];
				shuffle_state = data["shuffle_state"];
				device_type = data["device"]["type"];

				device_type_icon = "";
				if (device_type == "Smartphone"){
					device_type_icon = "<i class='fa fa-mobile'></i>";
				} else if (device_type == "Computer"){
					device_type_icon = "<i class='fa fa-desktop'></i>";
				} else if (device_type == "Tablet") {
					device_type_icon = "<i class='fa fa-tablet'></i>";
				}

				repeat_state_icon = "";
				if (repeat_state != "off"){
					repeat_state_icon = "<i class='fa fa-refresh'></i>";
				}

				shuffle_state_icon = "";
				if (shuffle_state == true){
					shuffle_state_icon = "<i class='fa fa-random' style='margin-right: 10px'></i>";
				}

				album = data["item"]["album"];
				album_name = album["name"];
				artist = album["artists"][0]["name"];
				track_name = data["item"]["name"];
				img = album["images"][0]["url"];

				$("#spotify_table #spotify_device").html(device_type_icon + "  " + device_name);

				$("#spotify_table #progress").show();
				$("#spotify_table #time").show();
				$("#spotify_table i").show();

				$("#spotify_table #artist").text(artist);
				$("#spotify_table #album").text(album_name);
				$("#spotify_table #name").text(track_name);
				$("#spotify_table #duration").text(duration/1000/60);
				$("#spotify_player_state").html(shuffle_state_icon + repeat_state_icon);
				$("#spotify_image img").attr("src", img);
				printTime(position, duration);

			} else {

				$("#spotify_table #artist").text("");
				$("#spotify_table #album").text("");
				$("#spotify_table #name").text("");
				$("#spotify_table #minute").text("");
				$("#spotify_table #second").text("");
				$("#spotify_table #duration").text("");
				$("#spotify_table #status").text("");
				$("#spotify_device").text("Pause");

				$("#spotify_table #progress").hide();
				$("#spotify_table #time").hide();
				$("#spotify_table i").hide();

				if ($("#spotify_cover").attr("src") != "/modules/spotify/assets/pause.png") {
					$("#spotify_cover").attr("src", "/modules/spotify/assets/pause.png");
				}
			}
		} else {
			$("#spotify_cover").attr("src", "/modules/spotify/assets/error.png");
			$("#spotify_device").text("Error " + data["error"]["status"] + ": " + data["error"]["message"]);
			$("#spotify_table #artist").text("");
			$("#spotify_table #album").text("");
			$("#spotify_table #name").text("");
			$("#spotify_table #minute").text("");
			$("#spotify_table #second").text("");
			$("#spotify_table #duration").text("");
			$("#spotify_table #status").text("");

			$("#spotify_cover").attr("style", "width: 170px; height: 170px;");
			$("#spotify_frame").attr("style", "width: 180px");

			$("#spotify_table #progress").hide();
			$("#spotify_table #time").hide();
			$("#spotify_table i").hide();
		}
	});

	window.setTimeout(function() {
		reloadSpotify();
	}, 1000);

}

function printTime(position, duration){
	position = Math.round(position)/1000;
	position_minutes = Math.floor(position/60);
	position_seconds = parseInt(position-(position_minutes*60));

	duration = Math.round(duration)/1000;
	duration_minutes = Math.floor(duration/60);
	duration_seconds = parseInt(duration-(duration_minutes*60));

	if (position_seconds >= 60){
		position_minutes += 1;
		position_seconds = position_seconds-60;
	}

	if (duration_seconds >= 60){
		duration_minutes += 1;
		duration_seconds = duration_seconds-60;
	}

	$("#spotify_table #timer").text(prettyPrint(position_minutes) + ":" + prettyPrint(position_seconds));
	$("#spotify_table #duration").text(prettyPrint(duration_minutes) + ":" + prettyPrint(duration_seconds));
	$("#spotify_table #progress").html("<div class='progress'><span style='width: " + ((100/duration)*position) + "%; max-width: 100%;'></span></div>");
}

function prettyPrint(time){
	if (time <= 9) {
		return "0" + time;
	}

	if (time >= 59){
		return 59;
	}

	return "" + time;
}
