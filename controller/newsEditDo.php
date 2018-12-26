<?php
// +----------------------------------------------------------------------
// | ZL [ WE CAN DO IT！！！]
// +----------------------------------------------------------------------
// | Copyright (c) 2016~2018 Z.L All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( NO )
// +----------------------------------------------------------------------
// | Author: Z.L <582152734@qq.com>
// +----------------------------------------------------------------------
header('content-type:text/html;charset=utf8');
$id=$_POST['id'];
$tittle=$_POST['tittle'];
$content=$_POST['content'];
if(!empty($tittle)&&!empty($content))
{
	include '../Db/Db.php';
	$sql="update news set tittle='$tittle',content='$content' where id=$id";
	$res=$conn->query($sql);
	$impact=$res->rowCount();
	if($impact)
	{
		echo "<script>alert('修改成功');window.location.href='../newslist.php'</script>";
	}else{
		echo "<script>alert('修改失败');window.location.href='../newslist.php'</script>";
	}

	$conn=null;
}else{
	echo "<script>alert('标题和内容不能为空');window.history.back(-1)</script>"; 
}