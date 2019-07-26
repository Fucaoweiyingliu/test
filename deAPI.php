<?php
header("content-type:text/html;charset=utf8");
$db=new PDO("mysql:host=127.0.0.1;dbname=1704phpA", 'root', 'root');
$db->exec("set  names  utf8");
//让用户传要删除的数据
$sql="";//组织删除语句
$res=$db->exec($sql);
if($res){
    echo  json_encode(array('code'=>'0','msg'=>'删除成功','data'=>''));
}else{
    echo  json_encode(array('code'=>'1','msg'=>'删除失败','data'=>''));
}