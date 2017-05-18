<?php
defined( 'ABSPATH' ) or die( 'No script' );

/**
* Plugin Name: BCS GA Tracking Code Embed
* Plugin URI: http://www.github.com/bshelling
* Description: Easily adds Google Tracking Code to WP website
* Version: 2.0
* Author: Brandon Shelling
* Author URI: http://noearlynohalf.com
* License:one line to give the program's name and an idea of what it does.
*Copyright (C) 2015  bshelling
*
*This program is free software; you can redistribute it and/or
*modify it under the terms of the GNU General Public License
*as published by the Free Software Foundation; either version 2
*of the License, or (at your option) any later version.
*
*This program is distributed in the hope that it will be useful,
*but WITHOUT ANY WARRANTY; without even the implied warranty of
*MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
*GNU General Public License for more details.
*
*You should have received a copy of the GNU General Public License
*along with this program; if not, write to the Free Software
*Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/


//Google analytics
function analyticsPage(){?>

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
		echo"<textarea name='gaCode' cols='75' rows='5' placeholder='UA-xxxxxxxx-x' id='gaCode'>".$value."</textarea>";
		echo"<p></p>";
		echo"<input id='submitCode' class='button button-primary button-large' type='submit' value='Save Analytics Code' />";
		echo"<p></p>";
		echo"<input id='removeCode' class='button button-primary button-large' type='submit' value='Update Code' />";
		echo"</form>";
		echo"<p>To obtain a tracking code visit <a href='https://analytics.google.com'>Google Analytics Tracking Code</a></p>";
		echo"<p>GA Tracking Code Embed v.2 <br>For contact <a href='mailto:bshelling@gmail.com'>bshelling@gmail.com</a></p>";
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

function loadScripts(){
	wp_enqueue_script('gaEmbedScript',plugin_dir_url( __FILE__ ).'/js/app.js',array('jquery'),2.1,true);
}
add_action('admin_enqueue_scripts','loadScripts');