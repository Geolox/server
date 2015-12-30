<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN">
<?php
include('config.php');
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=Cp1252">
<title>Street Report - Report moderator</title>
<!-- jquery -->
<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
<!-- flexigrid -->
<link rel="stylesheet" type="text/css" href="css/flexigrid.css">
<script type="text/javascript" src="js/flexigrid.js"></script>
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
    <table id="reports" style="display:none"></table>
    <script type="text/javascript">
    var currentReportStr;
	$(function() {
		$( "#sections" ).accordion();
		$( "#report" ).dialog({
		autoOpen: false,
		height: 500,
		width: 1010,
		modal: true});
		$( "a", ".buttons" ).button();
		$( "#save", ".buttons" ).click(function() { save(); });
		$( "#reject", ".buttons" ).click(function() { reject(); });
		$( "#cancel", ".buttons" ).click(function() { cancel(); });
	});
    $(document).ready(function () {
    	$("#reports").flexigrid({
			url: 'reports.php?catid=0',
			dataType: 'json',
			colModel : [
			  {display: 'CatID', name : 'reportd', width : 100, sortable : true},
			  {display: 'Cathegory', name : 'reportd', width : 100, sortable : true},
			  {display: 'Sub-CatID', name : 'catname', width : 110, sortable : true},
			  {display: 'Sub-Cathegory', name : 'subcat_name', width : 115, sortable : true},
			  {display: 'Lon', name : 'lon', width : 100, sortable : true},
			  {display: 'Lat', name : 'lat', width : 100,sortable : true},
			  {display: 'User', name : 'desc', width : 100,sortable : true}
			 ],
			usepager: false,
			title: 'Reports',
			useRp: false,
			rp: 5,
			showTableToggleBtn: false,
			width: 861,
			height: 255,
			singleSelect: true,
			onSuccess:function(g)
				{
					$('thead tr',g.hDiv).each(function(index,elem){
						$(this).append('<th axis="col7" abbr="action"><div style="width: 50px;">Action</div></th>');
						}
					);
					$('tbody tr', g.bDiv).each(function(index,elem){
							$(this).append("<td style='width:50px;text-align:center;vertical-align:middle;'><a href='javascript:view("+index+")'><img id='viewMessage' width='16' style='padding-top: 5px;' height='16' src='css/images/magnifier.png'></a></td>");
						}	
					);
				}
			});
    });
	view = function (index) {
		var row = $('.bDiv tbody tr')[index];//(' td:first div')[0].innerHTML;
		var info = $('td:first div',row)[0].innerHTML;
		show(info);
	};
	show = function(info) {
		currentReportStr = info;
		var report = eval( "(" + info + ")");
		bindReport(report);
		$( "#report" ).dialog( "open" );
	};
	save = function() {
		var data = "report=" + currentReportStr;
		data = data + "&queue=" + "streetreport";
		data = data + "&exchange=" + "transit";
	    $.ajax({
	        url: "save-report.php", 
	        type: "POST",       
	        data: data,
	        complete: function (html) {
	        	ret = eval(html.responseText);
	        	if(ret.result=="1"){
	        		alert("Success");
	        		$( "#report" ).dialog('close');
	        		$( "#reports" ).flexReload();
	        	}
	        }      
	    });
	};
	cancel = function(){
		alert('cancel');
	}
	reject = function (){
		alert('reject');
	};
	bindReport = function(r){
		$("#catname").text(r.body.catname);
		$("#subcatname").text(r.body.subcatname);
		$("#reportd").text(r.body.reportd);
		$("#user").text(r.body.user);
		$("#desc").text(r.body.desc);
		$("#img1").attr('src','<?php echo FILESERVER ?>'+r.body.img1);
		$("#img2").attr('src','<?php echo FILESERVER?>'+r.body.img2);
		$("#img3").attr('src','<?php echo FILESERVER?>'+r.body.img3);
		$("#lat").text(r.body.lat);
		$("#lon").text(r.body.lon);
		$("#mapmonitor").attr('src','<?php echo FILESERVER?>'+r.body.mapmonitor);
	}
    </script>
	<div id="report" title='Report'>
		<div id="sections">
			<h3><a href="#">Data</a></h3>
			<div>
				User:&nbsp;<label id="user"></label><br>
				Date:&nbsp;<label id="reportd"></label><br>
				Cathegory:&nbsp;<label id="catname"></label><br>
				Sub-Cathegory:&nbsp;<label id="subcatname"></label><br>
				Description:<p id="desc"></p>
			</div>
			<h3><a href="#">Evidence</a></h3>
			<div>
				<img id="img1" width="300" height="200" />
				<img id="img2" width="300" height="200" /> 
				<img id="img3" width="300" height="200" /> 
			</div>
			<h3><a href="#">Location</a></h3>
			<div>
				Lat:&nbsp;<label id="lat"></label> <br>
				Lon:&nbsp;<label id="lon"></label> <br>
				<div style="text-align:center;">
				<img id="mapmonitor" width="300" height="200" />
				</div>
			</div>
		</div>
		<div class="buttons">
			<a href="#" id="save">Save</a>
			<a href="#" id="reject">Reject</a>
			<a href="#" id="cancel">Cancel</a>
		</div>
	</div>
</body>
</html>