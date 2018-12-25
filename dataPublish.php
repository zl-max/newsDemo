<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>数据发布</title>
</head>
<body bgcolor="#CCC">
	<form name="article" method="POST" action="controller/dataPublishDo.php" style="margin: 100px 500px;text-align: center">
		<h1>数据添加</h1>
		标题 <input type="text" name="tittle"><br/>
		<textarea name="content" rows="10" cols="40" placeholder="输入要添加的内容"></textarea><br/><br>
		<input type="submit" value="添加">
	</form>
</body>
</html>