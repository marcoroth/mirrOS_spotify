var success = true;

$(document).ready(function() {

	$(".spotify_step_section").hide();
	$("#spotify_step1").show();

	$("#spotify_save_step1").click(function() {
		$("#spotify_step1").hide();
		$("#spotify_step2").show();
	});

	$("#spotify_save_step2").click(function() {
		client_id = $("#spotify_client_id").val();
		client_secret = $("#spotify_client_secret").val();


		if (client_id != "" && client_secret != ""){

			$.post("setConfigValueAjax.php", {"key": "spotify_client_id", "value": client_id}).fail(function(){ success = false });
			$.post("setConfigValueAjax.php", {"key": "spotify_client_secret", "value": client_secret}).fail(function(){ success = false });

			if (success) {
				$("#ok").show(30, function() {
					$(this).hide("slow");
				});

				$("#spotify_step2").hide();
				$("#spotify_step3").show();
			} else {
				$("#error").show(30, function() {
					$(this).hide("slow");
				});
			}
		} else {
			$("#error").show(30, function() {
				$(this).hide("slow");
			});
		}
	});

});
