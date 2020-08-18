<?php
namespace sample;

use sample\db\Connection;






class Db
{

	/**
	 * 当前数据库连接对象
	 * @var [type]
	 */
	protected static $connection;

	/**
	 * 数据库配置
	 * @var array
	 */
	protected static $config    = [];

	/**
	 * 查询次数 ？ 有啥用
	 * @var integer
	 */
	public static $queryTimes   = 0;

	/**
	 *执行次数
	 * @var integer
	 */
	public static $executeTimes = 0;


	public static function init($config = [])
	{
		self::$config   = $config;

		//如果没有显示指定query类，那么使用默认的框架类库
		//也就是说,可以拓展框架默认的类库或者使用自定义的Query类
		//Query查询类---
	
		if (empty($config['query'])) {
			self::$config['query']  = '\\sample\\db\\Query';
		}
	}

	/**
	 * 获取数据库配置
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-08-13T17:47:54+0800
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
	 * 切换数据库连接
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-08-13T17:48:53+0800
	 * @version  [version]
	 * @param    array                    $config             [description]
	 * @param    boolean                  $name               [description]
	 * @param    string                   $query              [description]
	 * @return   [type]                                       [description]
	 */
	public static function connect($config= [], $name = false, $query = '')
	{
		//解析配置参数
		$options   = self::parseConfig($config ? : self::$config);
	}


	/**
	 * 数据库连接参数解析
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-08-13T17:49:29+0800
	 * @version  [version]
	 * @param    [type]                   $config             [description]
	 * @return   [type]                                       [description]
	 */
	private static function parserConfig($config)
	{
		if (is_string($config) && false === strpos($config, '/')) {
			//支持读取配置参数
			$config   = isset(self::$config[$config]) ? self::$config[$config] : self::$config;
		}

		$result       = is_string($config) ? self::parseDsnConfig($config) : $config;

		if (empty($result['query'])) {
			$result['query']  = self::$config['query'];
		}

		return $result;
	}


	/**
	 * DSN解析
	 * 格式： mysql://username:passwd@localhost:3306/DbName?param1=val1&param2=val2#utf8
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-08-13T17:50:11+0800
	 * @version  [version]
	 * @param    强制为String                   $dsn                [description]
	 * @return   [type]                                       [description]
	 */
	private static function parseDsnConfig(String $dsnStr)
	{
		$info   = parse_url($dsnStr);

		if (!$info) {
			return [];
		}

		$dsn   = [
			'type'     => $info['scheme'],
			'username' => isset($info['user']) ? $info['user'] : '',
			'password' => isset($info['pass']) ? $info['pass'] : '',
			'hostname' => isset($info['host']) ? $info['host'] : '',
			'hostport' => isset($info['port']) ? $info['port'] : '',
			'database' => !empty($info['path']) ? ltrim($info['path'], '/') : '',
			'charset'  => isset($info['fragment']) ? $info['fragment'] : 'utf8'
		];

		if (isset($info['query'])) {
			parse_str($info['query'], $dsn['params']);
		} else {
			$dsn['params']  = [];
		}

		return $dsn;
	}

	public static function __callStatic($method, $arguments)
	{
		return call_user_func_array([static::connect(), $method], $arguments);
	}

}