<html>

<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Street Report | Home</title>
    
    <style type="text/css">
    body,h1,h2,h3,p,quote,small,form,input,ul,li,ol,label{
		/* The reset rules */
		margin:0px;
		padding:0px;
	}
	
	body{
		color:#555555;
		font-size:13px;
		background: #eeeeee;
		font-family:Arial, Helvetica, sans-serif;
		width: 100%;
	}
	
	h1{
		font-size:28px;
		font-weight:bold;
		font-family:"Trebuchet MS",Arial, Helvetica, sans-serif;
		letter-spacing:1px;
	}
	
	h2{
		font-family:"Arial Narrow",Arial,Helvetica,sans-serif;
		font-size:10px;
		font-weight:normal;
		letter-spacing:1px;
		padding-left:2px;
		text-transform:uppercase;
		white-space:nowrap;
		margin-top:4px;
		color:#888888;
	}
	
	#main p{
		padding-bottom:8px;
	}
	
	.clear{
		clear:both;
	}
	
	#main{
		width:800px;
		/* Centering it in the middle of the page */
		margin:60px auto;
	}
	
	.container{
		margin-top:20px;
		
		background:#FFFFFF;
		border:1px solid #E0E0E0;
		padding:15px;
		
		/* Rounded corners */
		-moz-border-radius:20px;
		-khtml-border-radius: 20px;
		-webkit-border-radius: 20px;
		border-radius:20px;
	}
	
	.err{
		color:red;
	}
	
	.success{
		color:#00CC00;
	}
	
	a, a:visited {
		color:#00BBFF;
		text-decoration:none;
		outline:none;
	}
	
	a:hover{
		text-decoration:underline;
	}
	
	.tutorial-info{
		text-align:center;
		padding:10px;
	}
    </style>
    <link rel="stylesheet" type="text/css" href="css/slide.css" media="screen" />
    
	<!-- jquery -->
	<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    
    <!-- PNG FIX for IE6 -->
    <!-- http://24ways.org/2007/supersleight-transparent-png-in-ie6 -->
    <!--[if lte IE 6]>
        <script type="text/javascript" src="../js/pngfix/supersleight-min.js"></script>
    <![endif]-->
    <!-- jquery ui -->

	<link rel="stylesheet" href="css/base/jquery.ui.all.css">
	<script src="js/jquery.ui.core.js"></script>
	<script src="js/jquery.ui.widget.js"></script>
	<script src="js/jquery.ui.button.js"></script>
    <script src="js/slide.js" type="text/javascript"></script>
    
</head>

<body>
<script type="text/javascript">
$(document).ready(function() {
	
	// Expand Panel
	$("#open").click(function(){
		$("div#panel").slideDown("slow");
	
	});	
	
	// Collapse Panel
	$("#close").click(function(){
		$("div#panel").slideUp("slow");	
	});		
	
	// Switch buttons from "Log In | Register" to "Close Panel" on click
	$("#toggle a").click(function () {
		$("#toggle p").toggle();
	});		
		
});
login = function() {
	var data = "email=" + $("#username").val();
	data = data + "&password=" + $("#password").val();
    $.ajax({
        url: "login.php", 
        type: "POST",       
        data: data,
        complete: function (html) {
        	ret = eval(html.responseText);
        	if(ret.result=="1"){
            	document.location.href="pages.main.php";
        	}
        	else{
        		alert("fail");
        	}
        }      
    });
};
$(function() {
	$( "a", ".buttons" ).button();
	$( "#login", ".buttons" ).click(function() { login(); });
});
</script>
<!-- Panel -->
<div id="toppanel">
	<div id="panel">
		<div class="content clearfix">          
			<div class="right">
				<!-- Login Form -->
				<form class="clearfix" action="" method="post">
					<h1>Member Login</h1>
                    
                    					
					<label class="grey" for="username">E-Mail:</label>
					<input class="field" type="text" name="username" id="username" value="" size="23" />
					<label class="grey" for="password">Password:</label>
					<input class="field" type="password" name="password" id="password" size="23" />
        			<div class="clear"></div>
					<br>
					<div class="buttons">
						<a href="#" id="login">Login</a>
					</div>
				</form>
			</div>
            
       </div>
	</div> <!-- /login -->	

    <!-- The tab on top -->	
	<div class="tab">
		<ul class="login">
	    	<li class="left">&nbsp;</li>
	        <li>Hello!!</li>
			<li class="sep">|</li>
			<li id="toggle">
				<a id="open" class="open" href="#">Log In</a>
				<a id="close" style="display: none;" class="close" href="#">Close</a>			
			</li>
	    	<li class="right">&nbsp;</li>
		</ul> 
	</div> <!-- / top -->
	
</div> <!--panel -->

<div class="pageContent">
    <div id="main">
      <div class="container">
        <h1>Street Reports</h1>
        <h2>Admin Site</h2>
        </div>
        
        <div class="container">
        
          <p>Logging to access the site.</p>
          <div class="clear"></div>
        </div>
    </div>
</div>

</body>
</html>