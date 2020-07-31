<?php
namespace sample;



/**
 * 对$_SESSION全局变量以及相关函数的封装
 */
class Session
{


	protected $session;



	private function __construct()
	{

	}



	/**
	 * 魔术方法--调用实例不可访问方法时执行
	 * @param  [type] $method    [description]
	 * @param  [type] $arguments [description]
	 * @return [type]            [description]
	 */
	public function __call($method, $arguments)
	{
		
		
	}





	
}