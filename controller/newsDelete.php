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
header('content-type:text/html;charset=utf-8');
include '../Db/Db.php';
$id=$_GET['id'];
if(isset($id)){
	$sql="delete from news where id=$id";
	$res=$conn->query($sql);
	if(!$res){
		echo "<script> alert('删除失败！');window.location.href='../newslist.php' </script>";
	}else{
		echo "<script> alert('删除成功！');window.location.href='../newslist.php' </script>";
	}
}


