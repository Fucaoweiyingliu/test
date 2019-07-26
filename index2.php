<?php
//天气预报接口
header("content-type:text/html;charset=utf8");//调整页面编码格式
$curl=curl_init();//初始化
$url="http://api.k780.com/?app=weather.today&weaid=上海&appkey=42767&sign=f2c0982883594a157d5a7909345b74e1&format=json";
curl_setopt($curl,CURLOPT_URL,$url);//设置连接的地址
curl_setopt($curl,CURLOPT_RETURNTRANSFER,true);//不直接输出
$data=curl_exec($curl);
echo $data;
