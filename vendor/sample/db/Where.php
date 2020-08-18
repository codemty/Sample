<?php
namespace sample\db;

use ArrayAccess;


class Where implements ArrayAccess
{

	protected $where   = [];

	protected $enclose = false;


	public function __construct(array $where = [], $enclose = false)
	{
		$this->where    = $where;
		$this->enclose  = $enclose;
	}


	public function enclose($enclose = true)
	{
		$this->enclose  = $enclose;
		return $this;
	}

	/**
	 * 解析为Query对象可识别的查询条件数组
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-08-13T09:50:00+0800
	 * @version  [version]
	 * @return   [type]                   [description]
	 */
	public function parse()
	{
		$where   = [];

		foreach ($this->where as $key => $value) {
			if ($value instanceof Expression) {
				$where[]   = [$key, 'exp', $value];
			} elseif (is_null($value)){
				$where[]   = [$key, 'NULL', ''];
			} elseif (is_array($value)){
				$where[]   = $this->parseItem($key, $value);
			} else {
				$where[]   = [$key, '=', $value];
			}
		}

		return $this->enclose ? [$where] : $where;
	}


	/**
	 * 分析查询表达式
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-08-13T10:01:40+0800
	 * @version  [version]
	 * @param    [type]                   $field              [description]
	 * @param    array                    $where              [description]
	 * @return   [type]                                       [description]
	 */
	protected function parseItem($field, $where = [])
	{
		$op          = $where[0];
		$condition   = isset($where[1]) ? $where[1] : null;

		if (is_array($op)) {
			//同一字段多条件查询
			array_unshift($where, $field);
		} elseif (is_null($condition)){
			if (in_array(strtoupper($op), ['NULL', 'NOTNULL','NOT NULL'], true)) {
				//null 查询
				$where    = [$field, $op, ''];
			} elseif (in_array($op, ['=', 'eq', 'EQ', null], true)){
				$where    = [$field, 'NULL', ''];
			} elseif (in_array($op, ['<>', 'neq', 'NEQ'], true)){
				$where    = [$field, 'NOTNULL', ''];
			} else {
				//字段相等查询
				$where    = [$field, '=', $op];
			}
		} else {
			$where        = [$field, $op, $condition];
		}

		return $where;
	}	


	/**
	 * 修改器  设置数据对象的值
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-08-13T09:51:40+0800
	 * @version  [version]
	 * @param    [type]                   $name               [description]
	 * @param    [type]                   $value              [description]
	 */
	public function __set($name, $value)
	{
		$this->where[$name]  = $value;
	}

	public function __get($name)
	{
		return isset($this->where[$name]) ? $this->where[$name] : null;
	}

	/**
	 * 检测数据对象的值
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-08-13T09:53:06+0800
	 * @version  [version]
	 * @param    [type]                   $name               [description]
	 * @return   boolean                                      [description]
	 */
	public function __isset($name)
	{
		return isset($this->where[$name]);
	}

	public function __unset($name)
	{
		unset($this->where[$name]); 
	}

	//ArrayAccess
	public function offsetSet($name, $value)
	{
		$this->__set($name, $value);
	}

	public function offsetExists($name)
	{
		return $this->__isset($name);
	}

	public function offsetUnset($name)
	{
		$this->__unset($name);
	}

	public function offsetGet($name)
	{
		return $this->__get($name);
	}
}