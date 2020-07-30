<?php
namespace sample;

use sample\Request;
use sample\Response;
use sample\Exception;

/**
 * 框架的应用类
 */
class Sample 
{
	
	




	/**
	 * 
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-29T18:08:05+0800
	 * @version  [version]
	 * @return   [type]                   [description]
	 */
	public function run()
	{

		//实例化必须的对象

		try {
			$request = Request::instance();
			var_dump($request);







		} catch (Exception $e) {
			
		}




		return $this;
	}


	/**
	 * 
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-07-29T18:08:02+0800
	 * @version  [version]
	 * @return   [type]                   [description]
	 */
	public function send()
	{




	}

}

