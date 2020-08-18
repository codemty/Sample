<?php
namespace sample;

use sample\db\Connection;




/**
 * 
 */
class Schema
{

	/**
	 * 保存连接对象
	 * @var array
	 */
	private static $connection;



	/** 
	 * 配置参数解析
	 * 支持数据格式为数组 : dsn 两个方式 深圳还可以直接xml格式
	 * 数组格式相对来说配置会更友好一点，dsn 格式 使用比较少了
	 * 而且对于特殊格式的解析
	 * 
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-08-14T14:33:19+0800
	 * @version  [version]
	 * @return   [type]                   [description]
	 */
	private static function parseConfig($config)
	{
		//判断config的数据格式：数组|字符串(dsn)|指定名称配置(配置文件中设置)
		//dsn格式必须包含斜线 以此作为 双方的区分标识
		if (is_string($config) && false === strpos($config, '/')) {
			//读取配置
			$config
		}




	}
    
	protected static function init()
	{

	}


	/**
	 * 获取配置参数
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-08-14T11:36:20+0800
	 * @version  [version]
	 * @param    string                   $name               [description]
	 * @return   [type]                                       [description]
	 */
	public static function getConfig($name = '')
	{
		if ('' === $name) {
			return self::$config;
		}

		return isset(self::$config[$name]) ? self::$config[$name] : null;
	}

	/**
	 * 切换数据库
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-08-14T10:53:08+0800
	 * @version  [version]
	 * @param    [type]                   $config             [description]
	 * @return   obj
	 */
	public static function connect($config, $name = false)
	{
		//解析配置参数
		$options    = self::parseConfig($config);

		//获取配置的查询类
		$query      = $options['query'];

		//创建数据库连接对象
		//使用解析之后的选项以及连接标识或是否重新连接来创建对应数据库的连接对象并返回
		self::$connection   =  Connection::instance($options, $name);

		//使用连接对象初始化指定的查询对象 --依赖注入方式
		return new $query(self::$connection);
	}













	public static function __callStatic($method, $arguments)
	{
		return call_user_func_array([, $method], $arguments);
	}

	
}
