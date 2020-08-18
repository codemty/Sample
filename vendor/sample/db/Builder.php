<?php
namespace sample\db;

use PDO;
use sample\Exception;


abstract class Builder 
{
	protected $connection;

	//查询表达式映射
	protected $exp  = [
		'EQ'             => '=',
		'NEQ'            => '<>',
		'GT'             => '>',
		'EGT'            => '>=',
		'LT'             => '<',
		'ELT'            => '<=',
		'NOTLIKE'        => 'NOT LIKE',
		'NOTIN'          => 'NOT IN',
		'NOTBETWEEN'     => 'NOT BETWEEN',
		'NOTEXISTS'      => 'NOT EXISTS',
		'NOTNULL'        => 'NOT NULL',
		'NOTBETWEEN TIME'=> 'NOT BETWEEN TIME'
	];

	//查询表达式解析
	protected $parser  = [
		'parseCompare'    => ['=', '<>', '>', '>=', '<', '<='],
		'parseLike'       => ['LIKE', 'NOT LIKE'],
		'parseBetween'    => ['NOT BETWEEN', 'BETWEEN'],
		'parseIn'         => ['NOT IN', 'IN'],
		'parseExp'        => ['EXP'],
		'parseNull'       => ['NOT NULL', 'NULL'],
		'parseBetweenTime'=> ['BETWEEN TIME', 'NOT BETWEEN TIME'],
		'parseTime'       => ['< TIME', '> TIME','<= TIME', '>= TIME'],
		'parseExists'     => ['NOT EXISTS', 'EXISTS'],
		'parseColumn'     => ['COLUMN'],

	];

    //SQL表达式
    protected $selectSql    = '';

    protected $insertSql    = '';

    protected $insertAllSql = '';

    protected $updateSql    = 'UPDATE %TABLE% SET %SET%%JOIN%%WHERE%%ORDER%%LIMIT% %LOCK%%COMMENT%';

    protected $deleteSql    = 'DELETE FROM %TABLE%%USING%%JOIN%%WHERE%%ORDER%%LIMIT% %LOCK%%COMMENT%';


    public function __construct(Connection $connection)
    {
    	$this->connection    = $connection;
    }


    public function getConnection()
    {
    	return $this->connection;
    }


    public function bindParser($name, $parser)
    {
    	$this->parser[$name]   = $parser;
    	return $this;
    }


    protected function parseData(Query $query, $data = [], $fields = [], $bind = [])
    {
    	if (empty($data)) {
    		return [];
    	}

    	$options  = $query->getOptions();

    	//获取绑定信息
    	if (empty($bind)) {
    		$bind   = $this->connection->getFieldsBind($options['table']);
    	}

    	if (empty($fields)) {
    		if ('*' == $options['field']) {
    			$fields  = array_keys($bind);
    		} else {
    			$fields  = $options['field'];
    		}
    	}

    	$result  = [];

    	foreach ($data as $key => $value) {
    		if ('*' != $options['field'] && !in_array($key, $fields, true) {
    			continue;
    		}

    		$item  = $this->parseKey($query, $key, true);

    		if ($value instanceof Expression) {
    			$result[$item]   = $value->getValue();
    			continue;
    		}
    	}
    }
}