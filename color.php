<?php
require_once ('config.php');
require_once ('db.php');
if ($color_pwd != '' && $_GET ['pwd'] != $color_pwd) {
	die ( 'Who are you? Password requierd.' );
}
function filter($str) {
	// 转义为HTML Entity
	$str = trim ( htmlspecialchars ( $str, ENT_QUOTES ) );
	$str = str_replace ( '\\', '&#92;', $str );
	$str = str_replace ( '/', '&#47;', $str );
	return $str;
}
?>
<!doctype html>
<html>
<head>
<title>修改配色_<?php echo $website_name; ?></title>

<meta charset="utf-8" />
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="stylesheet" type="text/css"
	href="color.css<?php echo '?time='. time();?>" />
<style type="text/css">
body {
	margin: 0;
	padding: 0;
	font-family: Consolas, Monaco, Courier, Monospace;
}

div {
	width: 800px;
	margin: 5em auto;
	padding: 50px;
	border-radius: 1em;
}

div.showcolor {
	width: 2em;
	height: 1em;
	margin: 0px;
	padding: 0px;
	display: inline-block;
}

@media ( max-width : 700px) {
	div {
		width: auto;
		margin: 0 auto;
		border-radius: 0;
		padding: 1em;
	}
}
</style>
</head>

<body>
	<div>
		<h1>修改网站配色</h1>
		<p>请点击颜色块或文字选择颜色。此操作需要color.css有写权限。</p>
		<script type="text/javascript">
		function checkColor(){
			var f = document.getElementById('formColor');
			if(f.color.value == ''){
				alert('请选择颜色！\nPlease select a color!');
				return false;
			}
			else{
				return true;
			}
		}
		</script>
		<form action="color.php?pwd=<?php echo filter($_GET['pwd'])?>"
			id="formColor" onsubmit="checkColor()" method="post">
			<label for="color_black">
				<div style="background-color: #000000" class="showcolor">
					<input type="radio" name="color" id="color_black" value="black" />
				</div> 高端黑
			</label> <label for="color_pink">
				<div style="background-color: #FFAEC9" class="showcolor">
					<input type="radio" name="color" id="color_pink" value="pink" />
				</div> 少女粉
			</label> <label for="color_red">
				<div style="background-color: #CC0000" class="showcolor">
					<input type="radio" name="color" id="color_red" value="red" />
				</div> 姨妈红
			</label> <label for="color_yellow">
				<div style="background-color: #FFCC33" class="showcolor">
					<input type="radio" name="color" id="color_yellow" value="yellow" />
				</div> 咸蛋黄
			</label> <label for="color_green">
				<div style="background-color: #336600" class="showcolor">
					<input type="radio" name="color" id="color_green" value="green" />
				</div> 满眼绿
			</label> <label for="color_blue">
				<div style="background-color: #99D9EA" class="showcolor">
					<input type="radio" name="color" id="color_blue" value="blue" />
				</div> 天空蓝
			</label> <label for="color_purple">
				<div style="background-color: #330033" class="showcolor">
					<input type="radio" name="color" id="color_purple" value="purple" />
				</div> 基佬紫
			</label><br /> <input type="submit" value="确定" />
		</form>
		<?php
		if ($_POST ['color'] === '') {
			echo '<span class="fail">请选择颜色</span><br />';
		} else {
			// 这样写有点笨，但是省事就这样了
			$css_black = 'body {background-color: #393939;color:#FFFFFF;}div {background-color: #000000;}
		th {background-color: #FF5A09;}span.success {background-color: #003300;}
		span.fail {background-color: #330000;}';
			$css_green = 'body {background-color: #336600;}div {background-color: #99CC33;}
		th {background-color: #FFFF66;}span.success {background-color: #99CC00;}
		span.fail {background-color: #FF6666;}';
			$css_blue = 'body {background-color: #99D9EA;}div {background-color: #FFFFFF;}
		th {background-color: #B5E61D;}span.success {background-color: #B5E61D;}
		span.fail {background-color: #FF8888;}';
			$css_yellow = 'body {background-color: #FFCC33;}div {background-color: #FFFF33;}
		th {background-color: #99CCFF;}span.success {background-color: #66CC00;}
		span.fail {background-color: #FF6666;}';
			$css_pink = 'body {background-color: #FFAEC9;}div {background-color: #FFCCCC;}
		th {background-color: #9933CC;}span.success {background-color: #B5E61D;}
		span.fail {background-color: #FF8888;}';
			$css_red = 'body {background-color: #CC0000;}div {background-color: #FF9999;}
		th {background-color: #66CC00;}span.success {background-color: #66CC00;}
		span.fail {background-color: #FF6666;}';
			$css_purple = 'body {background-color: #330033;}div {background-color: #C0AACC;}
		th {background-color: #AA99FF;}span.success {background-color: #66CC99;}
		span.fail {background-color: #CC33AA;}';
			
			$cmd = '';
			switch ($_POST ['color']) {
				case 'black' :
					$cmd = 'echo "' . $css_black . '" > color.css';
					break;
				case 'green' :
					$cmd = 'echo "' . $css_green . '" > color.css';
					break;
				case 'blue' :
					$cmd = 'echo "' . $css_blue . '" > color.css';
					break;
				case 'pink' :
					$cmd = 'echo "' . $css_pink . '" > color.css';
					break;
				case 'yellow' :
					$cmd = 'echo "' . $css_yellow . '" > color.css';
					break;
				case 'red' :
					$cmd = 'echo "' . $css_red . '" > color.css';
					break;
				case 'purple' :
					$cmd = 'echo "' . $css_purple . '" > color.css';
					break;
			}
			
			$rtn = exec ( $cmd );
		}
		?>
		<p>
			<a href="index.php">返回首页</a><br /><?php echo $dev_info;?></p>
	</div>
</body>
</html>