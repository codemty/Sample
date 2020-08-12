<?php
namespace sample;



/**
 * 工具类
 * 将整理的工具函数封装到类中，方便全局调用
 */
class Tools
{



	public static function demo()
	{

	}


	/**
	 * PHP可变参数
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-08-04T17:13:36+0800
	 * @version  [version]
	 * @param    [type]                   $arguments          [description]
	 * @return   [type]                                       [description]
	 */
	public static function demo1(...$arguments)
	{

	}



	public static function curl_request($url, $method = 'GET', $params = null)
	{
		$curl  = curl_init();

		//根据请求方式来设置相关差异参数
		switch (strtoupper($method)) {
			case 'POST':
				# code...
				break;
			default:
				# code...
				break;
		}



		//关闭连接请求
		curl_close($curl);
		return ;
	}



}