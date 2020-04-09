<?php
namespace sample;



/**
 * 基础模型类
 *
 * 
 */
class Model  implements ArrayAccess
{
	
	

	/**
	 * 模型数据
	 * @var array
	 */
    private $data = [];





    /**
     * 构造函数
     * @Author   Tangy                    <1622305313@qq.com>
     * @DateTime 2019-09-21T09:33:51+0800
     * @version  [version]
     */
	public function __construct()
	{

	}


    /**
     * 
     * @Author   Tangy                    <1622305313@qq.com>
     * @DateTime 2019-09-21T09:33:47+0800
     * @version  [version]
     * @return   [type]                   [description]
     */
	public static function init()
	{

	}

    //魔术方法
    public function __set($key, $value)
    {

    }


    /**
     * 读取不可访问属性的值时(包含已声明的)
     * 读取未声明的属性值时也会调用__get()方法
     * @Author   Tangy                    <1622305313@qq.com>
     * @DateTime 2019-09-23T11:17:49+0800
     * @version  [version]
     * @param    [type]                   $key                [description]
     * @return   [type]                                       [description]
     */
    public function __get($key)
    {
         
    }

    public function __isset($key)
    {

    }

    public function __unset($key)
    {

    }


	//数组方式访问对象
	public function offsetExists($key)
	{

	}


	public function offsetGet($key)
	{

	}


	public function offsetSet($key, $value)
	{

	}

	public function offsetUnset()
	{

	}
}

