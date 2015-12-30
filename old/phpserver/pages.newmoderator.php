<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<?php
include('config.php');
?>
<html>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Street Report - Report moderator</title>
<!-- jquery -->
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<!-- jquery ui -->

	<link rel="stylesheet" href="css/base/jquery.ui.all.css">
	<script src="js/jquery.ui.core.js"></script>
	<script src="js/jquery.ui.widget.js"></script>
	<script src="js/jquery.ui.accordion.js"></script>
	<script src="js/jquery.ui.dialog.js"></script>
	<script src="js/jquery.ui.button.js"></script>
	<script src="js/jquery.ui.tabs.js"></script>
	<link rel="stylesheet" href="css/demos.css">
</head>
<body>
	<div id="sections">
		<h3><a href="#">Moderator</a></h3>
		<div>
		    <div class="elements">
		      <label for="name">Name :</label><br>
		      <input type="text" id="name" name="name" size="25" />
		    </div>
		    <div class="elements">
		      <label for="email">E-mail :</label><br>
		      <input type="text" id="email" name="email" size="25" />
		    </div>
		    <div class="elements">
		      <label for="level">Level :</label><br>
		      <input type="text" id="level" name="level" size="25" />
		    </div>
		    <div class="elements">
		      <label for="password">Password:</label><br>
		      <input type="password" id="password" name="password" size="25" />
		    </div>
		</div>
	</div>
	<div class="buttons">
		<a href="#" id="save">Save</a>
	</div>
<script type="text/javascript">
$(function() {
	$( "#sections" ).accordion();
	$( "a", ".buttons" ).button();
	$( "#save", ".buttons" ).click(function() { save(); });
});
save = function() {
	var data = "mod=" + getModData();
    $.ajax({
        url: "save-mod.php", 
        type: "POST",       
        data: data,
        complete: function (html) {
        	alert(html);  
        }      
    });
};
getModData = function(){
	var ret = '{' ;  
	ret = ret +	'"name":' + '"'+$( "#name" ).val()+'"' + ",";
	ret = ret +	'"email":' + '"'+$( "#email" ).val()+'"' + ",";
	ret = ret +	'"password":' + '"'+$( "#password" ).val()+'"' + ",";
	ret = ret +	'"level":' + '"'+$( "#level" ).val()+'"';
	ret = ret +	'}';
	return ret;
};
</script>
</body>
</html>