<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>数据编辑</title>
</head>
<body bgcolor="#ccc">
	<?php
		$id=(int)$_GET['id']; 
		// 引入数据库
		include '../Db/Db.php';
		// 查询语句 
		$sql="select id,tittle,content from news where id=$id";
		$res=$conn->query($sql);
		$arr=$res->fetch();		
		$conn=null;
	?>
	<form name="article" method="POST" action="newsEditDo.php" style="margin: 100px 500px;text-align: center">
		<h1>数据添加</h1>
		<input type="hidden" name="id" value="<?php echo $id ?>">
		标题 <input type="text" name="tittle" value="<?php echo $arr['tittle'] ?>"><br/>
		<textarea name="content" rows="10" cols="40"><?php echo $arr['content'] ?></textarea><br/><br>
		<input type="submit" value="修改">
	</form>
</body>
</html>