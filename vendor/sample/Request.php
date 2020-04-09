<?php
namespace sample;




/**
 * 对$_SERVER 全局变量的封装
 * 单例模式--在整个应用或者一次http请求运行期间，request的实例是唯一的。
 */
class Request
{


    
    private function __construct()
    {

    }



	public static function instance()
	{

	}
	
	
}