<?php
//百度翻译接口
header("content-type:text/html;charset=utf8");//调整页面编码格式
$curl=curl_init();//初始化
$q="我是一名软件工程师";//要翻译的数据
$from="zh";//源语言 中文
$to="en";//翻译语言  英文
$appid="20190529000302898";
$salt=rand(1000000000,1500000000);
$key="OlcAZuodFb2vaOmXYPBS";//秘钥
$sign=md5($appid.$q.$salt.$key);
$url="http://api.fanyi.baidu.com/api/trans/vip/translate?q=$q&from=$from&to=$to&appid=$appid&salt=$salt&sign=$sign";
curl_setopt($curl,CURLOPT_URL,$url);
//关闭ssl协议
/*curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,false);
curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,false);*/
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);//不直接数据
$data=curl_exec($curl);//执行
echo $data;
