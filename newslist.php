<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>数据列表</title>
	<style type="text/css">
		table{
			table-layout: fixed;
		}
		table tr td{
			white-space: nowrap;
			overflow: hidden;
			text-overflow: ellipsis;
		}
		a{
			text-decoration: none;
			cursor: pointer;
		}
	</style>
	<script type="text/javascript">
		// 封装一个ajax函数
		function ajax(options){
			options=options||{};  // 参数是否为空
			options.type=(options.type||"get").toUpperCase();  // 请求方式
			options.dataType=options.dataType||"json";
			// GET请求后面所跟的参数
			var params=createParams(options.data);

			//document.write(options.type);
			document.write(params);
			return;
			//创建连接对象
			//IE6以上
			if(window.XMLHttpRequest){
				var xhr = new XMLHttpRequest();
			}
			else  // ie6以下版本
			{
				var xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}

			
			// 接收
			xhr.onreadystatechange=function(){
				if(xhr.readyState==4 && xhr.status==200 ||xhr.status==304)
				{
					options.success && options.success(xhr.responseText,xhr.responseXML);
				}
			}

			//连接和发送请求
			if(options.type=="GET"){
				xhr.open("GET",options.url+"?"+params,true);
				xhr.send(null);
			}else{
				xhr.open("POST",options.url,true);
				xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
				xhr.send(params);
			}
		}


		// 封装GET请求后面跟的参数
		function createParams(par){
			var arr=[];
			for(var name in par){
				arr.push(name+"="+par[name]);
			}
			//arr.push(("v="+Math.random()).replace(".",""));
			return arr.join("&");
		}

		function del(id){
			var status=window.confirm("确定要删除数据？");
			if(true==status){
					ajax({
					url:"controller/newsDelete.php",
					type:"post",
					data:{ids:id},
					dataType:"json",
					success:function(response,xml){
						// 删除成功执行的代码
						alert(response);
						location.reload();
					},
					fail : function(status){
						// 执行失败的代码
						alert(status);
					}
				});
				//  alert("删除成功勒");
			}
		}
	</script>
</head>
<body>
	<!-- 搜索框 -->
	<form method="GET" action="newslist.php" style="margin:0 40%;width: 20%">
		<input type="text" name="search" placeholder="文章标题" value="<?php echo trim($_GET['search']) ?>">
		<input type="submit" value="搜索">&nbsp;&nbsp;&nbsp;
		<input type="button" name="add" value="新增" onclick="window.location.href='dataPublish.php'">
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
			$pageSize=20;
			$page=($count%$pageSize==0)?($count/$pageSize):floor(($count/$pageSize)+1);  // 总页数
			// echo $page;
			if(isset($_GET['page'])){
				if($_GET['page']<=1){    // 输入的页数小于1或者为负时，当前页为第一页
					$currentPage=1;
				}elseif ($_GET['page']>$page) { 
					//大于总页数时，显示最后一页 
					$currentPage=$page;
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
			$serial_num=$start<=0?1:$start+1;
			while($resarr=$result->fetch()){
			?>
				<tr>
					<td><?php echo $serial_num; ?></td>
					<td><?php echo $resarr['tittle'] ?></td>
					<td><?php echo $resarr['content'] ?></td>
					<td><?php echo $resarr['insert_dt'] ?></td>
					<td><a href="controller/newsEdit.php?id=<?php echo $resarr['id'] ?>">编辑</a>&nbsp;&nbsp;<a id="del" onclick="del(<?php echo $resarr['id'] ?>)" >删除</a></td>
				</tr>
			<?php
				$serial_num++;
				}
				$conn=null;
			?>
				
	</table>
	<p style="margin: 10px 15%;width:70%;text-align: right;">
		<a href="newslist.php?search=<?php echo $search ?>" style="color: red">首页</a>
		<a href="newslist.php?search=<?php echo $search ?>&page=<?php echo $currentPage-1 ?>" style="color: red">|上一页</a>
		<a href="newslist.php?search=<?php echo $search ?>&page=<?php echo $currentPage+1 ?>" style="color: red">|下一页</a>
		<a href="newslist.php?search=<?php echo $search ?>&page=<?php echo $page ?>" style="color: red">|末页</a>
		当前<?php echo $currentPage ?>/<?php echo $page ?>页(<?php echo  $count ?>条记录)
		
	</p>
</body>
</html>