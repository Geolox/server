<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<?php
session_start();
?>

<html>
<head>
<?php
if(!$_SESSION['usr']){
	header('Location: home.php');
}
else {
	$user = $_SESSION['usr'];
}
?>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>jQuery UI Tabs - Default functionality</title>
	<!-- jquery -->
	<link rel="stylesheet" href="css/base/jquery.ui.all.css">
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
	<!-- jquery ui -->
	<script src="js/jquery.ui.core.js"></script>
	<script src="js/jquery.ui.widget.js"></script>
	<script src="js/jquery.ui.tabs.js"></script>
	<link rel="stylesheet" href="css/demos.css">
<script type="text/javascript">
$(function() {
	$("#tabs").tabs({
		cache: true,
		ajaxOptions: {
			error: function( xhr, status, index, anchor ) {
				$( anchor.hash ).html(
					"Couldn't load this tab. We'll try to fix this as soon as possible. " +
					"If this wouldn't be a demo." );
			}
		}
	});
	getQueueInfo = function() {
		var data = "&queue=" + "streetreport";
		data = data + "&exchange=" + "transit";
	    $.ajax({
	        url: "queue-info.php", 
	        type: "POST",       
	        data: data,
	        complete: function (html) {
	        	ret = eval(html.responseText);
				$("#output").text(ret);
	        }      
	    });
	}();
	$( "#tabs" ).bind( "tabsselect", function(event, ui) {
		alert(ui.index);
	});
});
</script>
</head>
<body>

<div class="demo">

	<div id="tabs">
		<ul>
			<li><a href="#tabs-1">Welcome</a></li>
			<li><a href="pages.monitor.php">Monitor</a></li>
			<li><a href="pages.reports.php">Reports</a></li>
			<li><a href="pages.newmoderator.php">New Moderator</a></li>
		</ul>
		<div id="tabs-1">
			<p>Hello <?php echo $user["name"]; ?>!!</p>
			<p>You have <label id="output"></label> reports waiting!</p>
			<p>StreetReport Rulez!!!</p>
		</div>
	</div>

</div><!-- End demo -->



<div class="demo-description">
<p>Click tabs to swap between content that is broken into logical sections.</p>
</div><!-- End demo-description -->

</body>
</html>