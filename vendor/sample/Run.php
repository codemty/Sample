<?php
//框架运行资源文件,在没有引入composer管理类库时,需要手动实现自动加载函数
//以及其他运营基础定义比如常量的定义
//定义的常量不能被覆盖


//类的自动加载就是根据类的完整命名空间来定位到类所在文件位置，然后inlcude_once进来

define('DS', DIRECTORY_SEPARATOR);
defined('ROOT_PATH') or define('ROOT_PATH',dirname(dirname(__DIR__)));
defined('APP_PATH')  or define('APP_PATH',dirname(dirname(__DIR__)).DS.'application'); 

//注册自动加载函数
spl_autoload_register(function($class){

	//传递需要使用的类名全称，包含整个命名空间；根据默认的条件，解析命名空间+类名，拆分为文件相对路径映射以及文件名映射 基于psr-4规范
	//命名空间
	//默认的类文件命名就是以.php结尾，不是其他格式，这里拼接为类库文件的路径并赋予变量
	//然后判断文件是否存在，如果文件不存在，抛出文件notfoundexcepion 或者是classNOtFoundException
	//分隔符的系统兼容处理
	$class             = strtr($class, '\\', DS);

	// $namespaces    = explode(DS, strtolower($class));
	if (stripos($class, 'app'.DS) !== false) {
		$classFilePath = str_replace('app'.DS, APP_PATH.DS, $class).'.php';
	} elseif(stripos($class, 'sample'.DS) !== false){
		$classFilePath = str_replace('sample'.DS, ROOT_PATH.DS.'vendor'.DS.'sample'.DS, $class).'.php';
	} else {
		$classFilePath = $class.'.php';
	}

	//加载类文件
	require_file($classFilePath);


	//顶级命名空间的路径映射以及替换、以及app命名空间的映射和替换
	//
	//比如 app\admin\controller app需要映射到 application 路径下
	//sample作为框架的顶级命名空间 需要映射到 vendor/sample/
	//如果已经知道了类的名称，基于分隔符进行拆分么
	//
	//自动加载队列时遍历执行，如果一个函数没有找到，就会顺序执行下一个，一直到找到为止
});

spl_autoload_register(function($class){




});


//已经注册的自动加载函数队列


//怎样注销匿名函数呢？
// spl_autoload_unregister(autoload_function);




function include_file($file)
{
	return include_once($file);
}

function require_file($file)
{
	return require_once($file);
}