<?php



//当前文件所在目录 --绝对路径


// echo __NAMESPACE__;exit(); //当前命名空间


// 注册自动加载函数
spl_autoload_register(function($class){


    //$class 是完全限定名称  --待命名空间的类型全称  如sample\Container;
    //如果遵循最基本的规则 $class 对应 路径 那么文件全称是  sample\Container.php


    //windows下不区分 分隔符 linux 区分分隔符
    $class = strtr($class, '\\', DIRECTORY_SEPARATOR); //将分隔符根据所在系统进行转换

    //获取应用根目录
    // dirname(path)  __DIR__ realpath(path)     
    
    $rootPath = dirname(__DIR__);

    $file = $rootPath . DIRECTORY_SEPARATOR . $class . '.php';

    //判断转化之后的文件是否存在
    if (is_file($file)) {
        
        __include_file($file);
    }


});




//查找文件
// function findFile($class)
// {   


// 	//规则1：文件名称和类名称一致，都遵循大驼峰法
//     $file = $class.'.php';








// }


function __include_file($file)
{
    return include $file;
}

function __require_file($file)
{
	return require $file;
}






