<?php
/**
* Plugin Name: BCS GA Tracking Code Embed
* Plugin URI: http://www.github.com/bshelling
* Description: Easily adds Google Tracking Code to website
* Version: 1.0
* Author: Bshelling
* Author URI: http://www.bshelling.com
* License:
*/


//Google analytics
function analyticsPage(){?>
	<script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
	<script>
	$(document).ready(function(){
		console.log();
		var textArea = $("#gaCode");
		var submitBtn = $("#submitCode");
		var removeBtn = $("#removeCode");
		var statusBox = $("#status");

		if(textArea.val() != ""){
			textArea.css("display","none");
			$("#inputLabel").css("display","none");
			statusBox.css("display","block");
			statusBox.css({
				    "display": "block",
				    "background-color": "#fff",
				    "border": "1px solid rgba(167, 167, 167, 0.611765)",
				    "padding": "15px",
				    "margin-right": "75%",
				    "color": "#444",
				    "font-size": "1rem"
			});
			submitBtn.css("display","none");

			statusBox.text($.trim(textArea.val()));
		}
		else{
			$("#inputLabel").css("display","block");
			removeBtn.css("display","none");
			statusBox.css("display","none");
		}

		removeBtn.on("click",function(e){
			e.preventDefault();
			$("#inputLabel").css("display","block");
			statusBox.slideUp();
			textArea.slideDown();
			submitBtn.css("display","block");
			submitBtn.val("Save Analytics Code");
			$(this).css("display","none");
		});


	});

	</script>
<?php
	function settingsForm(){
		if(isset($_POST['gaCode'])){
			update_option('gaCode', $_POST['gaCode']);
			$value = stripslashes($_POST['gaCode']);
		}
		$value = stripslashes(get_option('gaCode','Enter your Google Analytics Code'));
		echo"<div><label><h1>GA Tracking Code Embed</h1></label></div>";
		echo"<code id='status'></code>";
		echo"<form method='post' action=''>";
		echo"<label id='inputLabel'>Enter Google Analytics Tracking ID</label>";
		echo"<input name='gaCode' id='gaCode' value='".$value."'/>";
		echo"<p></p>";
		echo"<input id='submitCode' class='button button-primary button-large' type='submit' value='Save Analytics Code' />";
		echo"<p></p>";
		echo"<input id='removeCode' class='button button-primary button-large' type='submit' value='Update Code' />";
		echo"</form>";
		echo"<p>To obtain a tracking code visit <a href='https://www.google.com/analytics/'>Google Analytics Tracking Code</a></p>";
		echo"<p>GA Tracking Code Embed v.1 <br>For contact <a href='mailto:info@bshelling.com'>info@bshelling.com</a></p>";
	}
	add_menu_page('analytics page','Google Analytics','manage_options','ga_settings','settingsForm','dashicons-chart-area',77);
}
add_action('admin_menu','analyticsPage');

//Displays Code in footer
function gaCode(){
	echo "<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', '".get_option('gaCode')."', 'auto');
  ga('send', 'pageview');
  </script>";

}
add_action('wp_footer','gaCode');