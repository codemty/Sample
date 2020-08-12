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

	protected $global_server;


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

		$this->get           = $_GET;

		$this->post          = $_POST;

		$this->params        = $_REQUEST;

		$this->global_server = $_SERVER;
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
	 * 请求通信协议
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-31T11:15:03+0800
	 * @version  [version]
	 * @return   [type]                   [description]
	 */
	public function protocol()
	{	
		return $this->global_server['SERVER_PROTOCOL'];
	}

	/**
	 * 覆盖或设置请求参数
	 * 通过这个方法只能通过
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-30T14:26:40+0800
	 * @version  [version]
	 * @return   [type]                   [description]
	 */
	public function request($name, $value)
	{
		if (is_array($name) && !empty($name)) {
			
			$this->params = array_merge($this->params,$name);
		} elseif()




	}

	/**
	 * 当前请求方式
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-30T14:21:15+0800
	 * @version  [version]
	 * @return   [type]                   [description]
	 */
	public function  method($origin = false)
	{
		if ($origin) {
			return $this->global_server['REQUEST_METHOD'] ? :'GET';
		}






		return $this->method;

		 if ($origin) {
            // 获取原始请求类型
            return $this->server('REQUEST_METHOD') ?: 'GET';
        } elseif (!$this->method) {
            if (isset($_POST[$this->config['var_method']])) {
                $method = strtolower($_POST[$this->config['var_method']]);
                if (in_array($method, ['get', 'post', 'put', 'patch', 'delete'])) {
                    $this->method    = strtoupper($method);
                    $this->{$method} = $_POST;
                } else {
                    $this->method = 'POST';
                }
                unset($_POST[$this->config['var_method']]);
            } elseif ($this->server('HTTP_X_HTTP_METHOD_OVERRIDE')) {
                $this->method = strtoupper($this->server('HTTP_X_HTTP_METHOD_OVERRIDE'));
            } else {
                $this->method = $this->server('REQUEST_METHOD') ?: 'GET';
            }
        }

        return $this->method;
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
	 * 是否cli模式
	 * PHP_SAPI同php_sapi_name()，返回接口类型的小写字符
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-31T11:06:54+0800
	 * @version  [version]
	 * @return   boolean                  [description]
	 */
	public function isCli()
	{
		return PHP_SAPI == 'cli';
	}


	/**
	 * 是否cgi模式
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-31T11:07:18+0800
	 * @version  [version]
	 * @return   boolean                  [description]
	 */
	public function isCgi()
	{
		return strpos(PHP_SAPI, 'cgi') === 0;
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