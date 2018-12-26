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

//设置字符集
header("content-type:text/html;charset=utf-8");
// 设置默认时间区间
date_default_timezone_set('Asia/Shanghai');

if(!empty($_POST['tittle']) && !empty($_POST['content']))
{
	$tittle=$_POST['tittle'];
	$content=$_POST['content'];

	$sql="insert into news(tittle,content,insert_dt) select '$tittle','$content',now()";
	// echo $sql;
	//加载数据库连接
	require_once '../Db/Db.php';

	$result=$conn->query($sql);

	if($result)
	{
		$msg="<a href='../newslist.php'>添加成功,返回文章列表</a>";
	}else{
		$msg="<a href='../newslist.php'>添加失败,返回文章列表</a>";
	}
	$newsadd="<a href='../dataPublish.php'>添加新数据</a>";
	echo $msg." || ".$newsadd;
	//释放数据库连接
	$conn=null;
}else{
	echo "<script>alert('标题和内容两项都不能为空')</script>";
}
