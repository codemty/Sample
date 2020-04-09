<?php
namespace sample;

//引入基础文件
include '../sample/Base.php';


// //使用容器类创建类的实例----依赖注入
Container::get('sample')->run()->send();


