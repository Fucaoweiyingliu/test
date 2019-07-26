<?php
header("content-type:text/html;charset=utf8");
$db=new PDO("mysql:host=127.0.0.1;dbname=1704phpA", 'root', 'root');
$db->exec("set  names  utf8");
$data=$_POST;//接收用户提交的数据
$table="news";
$val='';//用户存放数据
$filed="";//存放字段的名称
foreach($data as $key=>$value) {
    $filed.=",`$key`";
    $val.=",'$value'";
}
$val=substr($val,1);
$filed=substr($filed,1);
$sql="insert into `$table`($filed) values($val)";//组织sql语句
$db->exec($sql);
/*include_once ("pdo.class.php");//引入数据库封装类
$db=new  Db("127.0.0.1",'1704phpA','root','root');
$res=$db->add($table,$data);*/

if($res){
    echo  json_encode(array('code'=>'0','msg'=>'添加成功','data'=>''));
}else{
    echo  json_encode(array('code'=>'1','msg'=>'添加失败','data'=>''));
}




