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


	protected $input;

	protected $get;

	protected $post;






	protected $method;

	protected $domain;

	protected $params;

	protected $protocol;


	protected static $instance = null;

	private function __construct()
	{
		$this->init();

		$this->input = file_get_contents('php://input');

	}

	/**
	 * 数据初始化
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-30T14:30:34+0800
	 * @version  [version]
	 * @return   [type]                   [description]
	 */
	protected function init()
	{

		var_dump($_GET);
		var_dump($_POST);
		var_dump($_REQUEST);
		var_dump($_SERVER);
		var_dump($_ENV);



		$this->get    = $_GET;


		$this->post   = $_POST;

		$this->params = $_REQUEST;




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
		if (is_null(self::$instance)) {
			self::$instance = new static();
		}
		return self::$instance;
	}








	/**
	 * 获取变量值
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-30T14:27:24+0800
	 * @version  [version]
	 * @param    [type]                   $name               [description]
	 * @return   [type]                                       [description]
	 */
	public function get($name = null)
	{

	}


	public function post($name = null)
	{

	}

	/**
	 * 
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-30T14:28:24+0800
	 * @version  [version]
	 * @param    [type]                   $name               [description]
	 * @return   [type]                                       [description]
	 */
	public function param($name = null)
	{
		return is_null($name) ? $this->params : $this->params[$name];
	}


	/**
	 * 返回请求方式
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-30T14:21:15+0800
	 * @version  [version]
	 * @return   [type]                   [description]
	 */
	public function  method($origin = false)
	{
		if ($origin) {
			return $_SERVER['REQUEST_METHOD'];
		}

	}


	/**
	 * 是否为GET请求
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-30T14:21:26+0800
	 * @version  [version]
	 * @return   boolean                  [description]
	 */
	public function isGet()
	{	
		return $this->method() == 'GET';
	}


	/**
	 * 请求方式是否为Post
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-30T14:21:40+0800
	 * @version  [version]
	 * @return   boolean                  [description]
	 */
	public function isPost()
	{
		return $this->method() == 'POST';
	}
	

	/**
	 * 是否为PUT请求
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-30T16:27:33+0800
	 * @version  [version]
	 * @return   boolean                  [description]
	 */
	public function isPut()
	{
		return $this->method() == 'PUT';
	}


	/**
	 * 是否为Delete请求
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-30T16:30:18+0800
	 * @version  [version]
	 * @return   boolean                  [description]
	 */
	public function isDelete()
	{
		return $this->method() == 'DELETE';
	}


	/**
	 * 是否为Head请求
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-30T16:31:39+0800
	 * @version  [version]
	 * @return   boolean                  [description]
	 */
	public function isHead()
	{
		return $this->method() == 'HEAD';
	}

	/**
	 * 是否为Options请求
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-30T16:32:25+0800
	 * @version  [version]
	 * @return   boolean                  [description]
	 */
	public function isOptions()
	{
		return $this->method() == 'OPTIONS';
	}

	/**
	 * 
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-30T14:26:40+0800
	 * @version  [version]
	 * @return   [type]                   [description]
	 */
	public function request()
	{

	}


	/**
	 * 协议信息
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-30T14:29:43+0800
	 * @version  [version]
	 * @return   [type]                   [description]
	 */
	public function protocol()
	{

	}


	/**
	 * 设置值
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-30T14:39:45+0800
	 * @version  [version]
	 */
	public function __set($name, $value)
	{
		$this->params[$name]  = $value;
	}

	public function __get($name)
	{
		return $this->params[$name];
	}

	public function __isset($name)
	{
		return isset($this->params[$name]);
	}





}