<?php
namespace sample;




/**
 * 请求类
 * 为了保证在一个请求的执行周期中，Request对象实例的统一性，需要实现单例模式，
 * 否则不同地方使用Request对象，每次都返回新的实例，会导致相关参数的丢失，
 * 甚至单例模式的使用，还能用于传递参数或者数据
 */
class Request
{

	protected static $instance;

	private function __construct()
	{

	}


	/**
	 * 实例方法--对外的接口
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-29T18:28:11+0800
	 * @version  [version]
	 * @return   [type]                   [description]
	 */
	public static function instance()
	{
		if () {
			# code...
		}
		return self::$instance;
	}


	
}