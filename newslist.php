<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>数据列表</title>
	<style type="text/css">
		a{
			text-decoration: none;
		}
	</style>
</head>
<body>
	<!-- 搜索框 -->
	<form method="GET" action="newslist.php" style="margin:0 40%;width: 20%">
		<input type="text" name="search" placeholder="文章标题">
		<input type="submit" value="搜索">
	</form>
	<br>
	<table style="text-align: center; width: 70%;background-color: #ccc;margin: 0 15%">
		<tr>
			<th>编号</th>
			<th>标题</th>
			<th>内容</th>
			<th>创建时间</th>
			<th>操作</th>
		</tr>
		<?php  
			include 'Db/Db.php';
			// 搜索框
			$search=trim($_GET['search']);
			//搜素语句
			$sql="select count(1) from news where tittle like '%$search%'";
			$res=$conn->query($sql);
			$arr=$res->fetch();
			list($key,$value)=each($arr);
			$count = $value;
			$pageSize=2;
			$page=floor(($count/$pageSize)+1);  // 总页数
			// echo $page;
			if(isset($_GET['page'])){
				if($_GET['page']<=1){    // 输入的页数小于1或者为负时，当前页为第一页
					$currentPage=1;
				}elseif ($_GET['page']>=$page) { 
					//大于总页数时，显示最后一页 
					$currentPage=$page-1;
				}else{
					$currentPage=$_GET['page'];
				}
			}else{
				$currentPage=1;
			}

			$start=($currentPage-1)*$pageSize;
			$sql2="select id,tittle,content,insert_dt from news where tittle like '%$search%' order by insert_dt limit $start,$pageSize";

            // echo $sql2;
			$result=$conn->query($sql2);

			while($resarr=$result->fetch()){
		?>
			<tr>
				<td><?php echo $resarr['id'] ?></td>
				<td><?php echo $resarr['tittle'] ?></td>
				<td><?php echo $resarr['content'] ?></td>
				<td><?php echo $resarr['insert_dt'] ?></td>
				<td><a href=""> 编辑</a>&nbsp;&nbsp;<a href="controller/newsDelete.php?id=<?php echo $resarr['id'] ?>">删除</a></td>
			</tr>
		<?php
			}
			$conn=null;
		?>
	</table>
	<p style="margin: 10px 15%;width:70%">
		<a href="newslist.php?search=<?php echo $search ?>" style="color: red">首页</a>
		<a href="newslist.php?search=<?php echo $search ?> & page=<?php echo $currentPage-1 ?>" style="color: red">|上一页</a>
		<a href="newslist.php?search=<?php echo $search ?> & page=<?php echo $currentPage+1 ?>" style="color: red">|下一页</a>
		<a href="newslist.php?search=<?php echo $search ?> & page=<?php echo $page ?>" style="color: red">|末页</a>
		共<?php echo $page ?>页|有<?php echo  $count ?>条记录
		当前第<?php echo $currentPage ?>页|
		
	</p>
</body>
</html>