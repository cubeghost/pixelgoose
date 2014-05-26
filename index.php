<!DOCTYPE html>     
<html xmlns="http://www.w3.org/1999/xhtml">     
  <head>

    <meta charset="UTF-8"/>     
    <title>pixelgoose</title>

<link rel="stylesheet" href="spectrum.css" />

<style type="text/css">
* {padding:0;margin:0;}
body {background:rgb(195,224,217);height:100%;width:100%;overflow:hidden;}
#taco {height:100%;width:900px;margin:0 auto;position:relative;bottom:0;min-height:600px;}
/*#ground {position:absolute;bottom:0;width:100%;height:100px;overflow:hidden;background:url(ground.png) repeat-x;}*/
#ground {position:absolute;bottom:0;width:100%;height:100px;overflow:hidden;}
#char {width:225px;height:300px;position:absolute;left:150px;bottom:100px;}
#char svg {position:absolute;display:none;}
#options {position:relative;left:350px;}
.opt_column {float:left;margin-right:10px;}
.icon {width:75px;height:50px;text-decoration:none;display:block;}
.colorpick {display:block;height:50px;width:75px;background:#eee;}
.tall_column .colorpick {height:100px;}
</style>

<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.6.2/jquery.min.js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.18/jquery-ui.min.js"></script>
<script type="text/javascript" src="spectrum.js"></script>
<script type="text/javascript">
$(document).ready(function() {
	var height = $(window).height();
	$('#taco').css({'height':height});
	
	$('.colorpick').each(function(){
		var thiscolor = $(this).data('color');
		//console.log(thiscolor);
		$(this).css({'background-color':thiscolor})
	});
	
	$('#body').css('z-index','-10');
	$('#eyes').css('z-index','1');
	$('#body, #shirt_1, #eyes, #pants_1, #hair_1').show();

	var s = 0;
	var p = 0;
	var h = 0;

	$("#icon_shirt").click(function() {
		var b = s + 2;
		$('[id*="shirt_"]').hide();
		$('[id*="shirt_"][id*="' + b + '"]').show();

		if (s < 0) {
			s++;
		} else {
			s = -1;
		};

		return false
	});
	
	$("#icon_pants").click(function() {
		var b = p + 2;
		$('[id*="pants_"]').hide();
		$('[id*="pants_"][id*="' + b + '"]').show();
			
		if (p < 0) {
			p++;
		} else {
			p = -1;
		};

		return false
	});

	$("#icon_hair").click(function() {
		var b = h + 2;
		$('[id*="hair_"]').hide();
		$('[id*="hair_"][id*="' + b + '"]').show();

		if (h < 4) {
			h++;
		} else {
			h = -1;
		};

		return false
	});

	$('#colorpick_hair').spectrum({
		color: $('#colorpick_hair').data('color'),
		showInitial: true,
		clickoutFiresChange: true,
		showButtons: false,
		move: function(color) {
			thishex = color.toHexString(); 
			$('#colorpick_hair').css({'background-color':thishex}); //color.toHexString(); 
			$('[id*="hair_"]').children('polygon, rect').attr('fill', thishex);
		}

	});
	$('#colorpick_shirt').spectrum({
		color: $('#colorpick_shirt').data('color'),
		showInitial: true,
		clickoutFiresChange: true,
		showButtons: false,
		move: function(color) {
			thishex = color.toHexString(); 
			$('#colorpick_shirt').css({'background-color':thishex}); //color.toHexString(); 
			$('[id*="shirt_"]').children('polygon, rect').attr('fill', thishex);
		}

	});
	$('#colorpick_pants').spectrum({
		color: $('#colorpick_pants').data('color'),
		showInitial: true,
		clickoutFiresChange: true,
		showButtons: false,
		move: function(color) {
			thishex = color.toHexString(); 
			$('#colorpick_pants').css({'background-color':thishex}); //color.toHexString(); 
			$('[id*="pants_"]').children('polygon, rect').attr('fill', thishex);
		}

	});
	$('#colorpick_body').spectrum({
		color: $('#colorpick_body').data('color'),
		showInitial: true,
		clickoutFiresChange: true,
		showButtons: false,
		move: function(color) {
			thishex = color.toHexString(); 
			$('#colorpick_body').css({'background-color':thishex}); //color.toHexString(); 
			$('#body polygon').attr('fill', thishex);
		}

	});
	$('#colorpick_eyes').spectrum({
		color: $('#colorpick_eyes').data('color'),
		showInitial: true,
		clickoutFiresChange: true,
		showButtons: false,
		move: function(color) {
			thishex = color.toHexString(); 
			$('#colorpick_eyes').css({'background-color':thishex}); //color.toHexString(); 
			$('#eyes rect').attr('fill', thishex);
		}

	});



var block = $('#char'),
    leftPos;
$(document).keydown(function (e) {
    leftPos = block.position().left;
    leftPos += (e.which == 37) ? -25 : 0;
    leftPos += (e.which == 39) ? 25 : 0;
    block.css('left', leftPos);
});








});
</script>


<body>
	<div id="taco">
		<div id="char">
		<?
			$svgarray = array();
			if ($svghandle = opendir('svg')) {
				while (false !== ($svgfile = readdir($svghandle))) {
				if ($svgfile != "." && $svgfile != "..") {
					$svgwhole = file_get_contents('svg/' . $svgfile);
					$svgfilenm = str_replace('.svg', '', $svgfile);
					$svgstring = str_replace('<svg', '<svg shape-rendering="crispEdges"', $svgwhole);
					$svgstring = str_replace('Layer_1', $svgfilenm, $svgstring);
					//echo $svgstring;
					$svgarray[] = $svgstring;

				}
			}
			closedir($svghandle);
		}
		sort($svgarray); 

		foreach ($svgarray as $svgval) {
			echo $svgval;
		}

		?>

		</div>
		
		<div id="options">
					
			<div id="column_hair" class="opt_column">
				<a id="icon_hair" class="icon" href="#">
				<svg shape-rendering="crispEdges" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="75px" height="50px" viewBox="0 0 75 50" enable-background="new 0 0 75 50" xml:space="preserve">
		 		<rect fill="#F1F1F2" width="75" height="50"/>
		 		<polygon fill="#BBBDBF" points="62.5,20.83 62.5,37.5 54.17,37.5 54.17,29.17 12.5,29.17 12.5,12.5 54.17,12.5 54.17,20.83 "/>
				</svg>
				</a>
				<a id="colorpick_hair" class="colorpick" data-color="#ED94A4"></a>
			</div>
			
			<div id="column_shirt" class="opt_column">
				<a id="icon_shirt" class="icon" href="#">
				<svg shape-rendering="crispEdges" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="75px" height="50px" viewBox="0 0 75 50" enable-background="new 0 0 75 50" xml:space="preserve">
		 		<rect fill="#F1F1F2" width="75" height="50"/>
		 		<polygon fill="#BBBDBF" points="62.5,12.5 62.5,20.833 52.5,20.833 52.5,37.5 22.5,37.5 22.5,20.833 12.5,20.833 12.5,12.5 
	32.5,12.5 32.5,20.833 42.5,20.833 42.5,12.5 "/>
				</svg>
			</a>
				<a id="colorpick_shirt" class="colorpick" data-color="#F9AA89"></a>
			</div>
			
			<div id="column_pants" class="opt_column">
				<a id="icon_pants" class="icon" href="#">
				<svg shape-rendering="crispEdges" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="75px" height="50px" viewBox="0 0 75 50" enable-background="new 0 0 75 50" xml:space="preserve">
		 		<rect fill="#F1F1F2" width="75" height="50"/>
		 		<polygon fill="#BBBDBF" points="62.5,12.5 62.5,37.5 49.995,37.5 49.995,25 25.005,25 25.005,37.5 12.5,37.5 12.5,12.5 "/>
		 		</svg>
		 	</a>
				<a id="colorpick_pants" class="colorpick" data-color="#006D7D"></a>
			</div>
			
			<div id="column_body" class="opt_column tall_column">
				<a id="colorpick_body" class="colorpick" data-color="#FEE2CC"></a>
			</div>
			
			<div id="column_eyes" class="opt_column tall_column">
				<a id="colorpick_eyes" class="colorpick" data-color="#7CB9C6"></a>
			</div>

			
		</div>	
	</div>

<div id="ground">
	<object data="ground_wide.svg" type="image/svg+xml" class="groundthing"></object>
</div>
</body>


