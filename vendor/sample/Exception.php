<?php
namespace sample;




/**
 * 自定义异常
 * 继承PHP异常类并进行拓展
 * 提供额外的debug信息字段
 * 
 *
 * 
 */
class Exception extends \Exception
{
	
	protected $debug = []; 

	protected $data  = [];



	public function __construct($message = null, $code = 0, $data = [])
	{



		$this->data   =  $data;
	}

	/**
	 * 字段数据只能在类初始化阶段赋值,
	 * 避免后期数据被修改
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-24T17:08:24+0800
	 * @version  [version]
	 */
	final protected function setData()
	{

	}

	/**
	 * 定义不可访问的set方法
	 * 避免调用不存在的方法抛出异常
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-24T17:10:34+0800
	 * @version  [version]
	 */
	final protected function setDebug()
	{

	}

	final public function getData()
	{
		return $this->data;
	}


	/**
	 * 输出debug信息
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-24T17:11:51+0800
	 * @version  [version]
	 * @return   [type]                   [description]
	 */
	final public function getDebug()
	{
		return $this->debug;
	}

	/**
	 * 魔术方法
	 * 当实例对象被直接输出时调用
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-24T16:49:23+0800
	 * @version  [version]
	 * @return   string                   [description]
	 */
	public function __toString()
	{

	}




}