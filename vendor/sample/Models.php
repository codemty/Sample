<?php
namespace sample;


/**
 * 
 */
class Models implements ArrayAccess
{
	
	/**
	 * 省略前缀的表名
	 * @var [type]
	 */
	private $name;

	/**
	 * 全表名
	 * @var [type]
	 */
	private $table;

	/**
	 * 数据记录
	 * @var array
	 */
	private $data = [];






	/**
	 * 
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-08-05T10:31:08+0800
	 * @version  [version]
	 * @param    [type]                   $offset             [description]
	 * @return   [type]                                       [description]
	 */
	public function offsetExists($offset)
	{

	}

	public function offsetGet($offset)
	{

	}


	public function offsetSet($offset, $value)
	{

	}

	public function offsetUnset($offset)
	{

	}
}