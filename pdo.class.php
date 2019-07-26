<?php
class  Db
{
    private   $link;//数据库连接符
    /**
     * Db constructor.
     * @param string $host  服务器地址
     * @param $dbname  数据库名称
     * @param $user 用户名
     * @param $pass 密码
     */
    public  function  __construct($host='127.0.0.1',$dbname,$user,$pass)
    {
        $this->link=new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);//实例化pdo类 注意单引号不解析变量
        $this->link->exec("set  names  utf8");//数据库操作的编码为utf8
        $this->link->setAttribute(PDO::ATTR_ERRMODE,1);//开启错误调试模式
    }
    /**
     * 查询一条数据
     * @param $table  要查询的数据表
     * @param string $where  查询的条件
     * @return mixed   有数据返回数组，没有数据返回空
     */
    public  function getOne($table,$where="1"){
        $sql="select  * from `$table` where  $where";//组织sql语句
        $stmt= $this->link->query($sql);//执行sql语句
        return  $stmt->fetch(2);//fetch获取一条条数据  2 关联数组
    }
    /**
     * @param $table  要查询的数据
     * @param string $where  要查询的条件
     * @return array  查询的结果
     */
    public function  getAll($table,$where="1"){
        $sql="select  *  from  `$table` where  $where";//组织sql语句
        $stmt=$this->link->query($sql);//执行查询语句
        return  $stmt->fetchAll(2);//从结果集中获取多条数据
    }
    public  function  getDel($table,$where)
    {
        if(empty($where))
        {
            return false;
        }
        $sql="delete from `$table` where $where";//组织sql语句
        $res=$this->link->exec($sql);//执行查询语句
        return  $res;//从结果集中获取多条数据
    }

    /**
     * @param $table 要插入的数据表
     * @param $arr  要插入的数据 关联数组
     * @return bool|int  执行成功返回受影响的行数 ，失败 返回false
     */
    public function add($table,$arr)
    {
        if(empty($table) || count($arr)==0){
            return  false;
        }
        $val='';//用户存放数据
        $filed="";//存放字段的名称
        foreach($arr as $key=>$value) {
            $filed.=",`$key`";
            $val.=",'$value'";
        }
        $val=substr($val,1);
        $filed=substr($filed,1);
        $sql="insert into `$table`($filed) values($val)";//组织sql语句
        $res=$this->link->exec($sql);//执行查询语句
        return  $res;//从结果集中获取多条数据
    }

    /**
     * @param $table 要修改的数据表
     * @param $data  要修改的数据
     * @param $where 要修改的条件
     * @return bool|int  返回值 成功影响的函数 失败 false
     */
    public  function  updateOne($table,$data,$where){
        if(empty($table)|| count($data)==0 || empty($where)){
            return  false;
        }
        $filed="";
        foreach($data as  $key=>$value){//键值对的拼接
            $filed.=",`$key`='$value'";
        }
        $filed=substr($filed,1);//去掉前面的逗号
        $sql="update  $table set $filed where  $where";//组织sql语句
        return $this->link->exec($sql);//执行sql语句
    }
}
$db=new  Db('127.0.0.1','1704phpA','root','root');
$array=['user_name'=>'美羊羊','user_pwd'=>'123456','use_states'=>'1'];
$data=$db->add('user',$array);
$data=$db->updateOne('user',$array,'user_id=6');