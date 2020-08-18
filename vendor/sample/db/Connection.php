<?php
namespace sample\db;




abstract class Connection
{

	const PARAM_FLOAT          = 21;
	protected static $instance = [];

	protected $PDOStatement;

	protected $queryStr         = '';

	protected $numRows          = 0;

	protected $transTimes       = 0;

	protected $error            = '';

	protected $links            = [];

	protected $linkID;
	protected $linkRead;
	protected $linkWrite;

	protected $fetchType         = PDO::FETCH_ASSOC;
	protected $attrCase          = PDO::CASE_LOWER;

	protected static $event      = [];

	protected static $info       = [];

	protected $builderClassName;

	protected $builder;

	protected $config            = [
		//数据类型
		'type'                   => '',
		//服务器地址
		'hostname'               => '';
		'database'               => '';
		'username'               => '';
		'password'               => '';
		'hostport'               => '';
        'dsn'                    => '';
        'params'                 => [];
        'charset'                => 'utf8',
        'prefix'                 => '',
        'debug'                  => false,
        'deploy'                 => 0,
        'rw_separater'           => false，
        'master_num'             => 1,
        'slave_no'               => '',
        'read_master'            => false,
        'fields_strict'          => true,
        'resultset_type'         => '',
        'auto_timestamp'         => false,
        'datetime_format'        => 'Y-m-d H:i:s',
        'sql_explain'            => false,
        'builder'                => '',
        'query'                  => '\\sample\\db\\Query',
        'break_reconnect'        => false,
        'break_match_str'        => []
	];

	protected $params            = [
		PDO::ATTR_CASE               => PDO::CASE_NATURAL,
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_ORACLE_NULLS       => PDO::NULL_NATURAL,
		PDO::ATTR_STRINGIFY_FETCHES  => false,
		PDO::ATTR_EMULATE_PREPARES   => false,
	];


	//服务器断线标识字符
	protected $breakMatchStr      = [
		'server has gone away',
		'no connection to the server',
		'Lost connection',
		'is dead or not enabled',
		'Error while sending',
		'decryption failed or bad record mac',
		'server closed the connection unexpectedly',
		'SSL connection has been closed unexpectedly',
		'Error writing data to the connection',
		'Resource deadlock avoided',
		'failed with errno'
	];

	protected $bind               = [];


	public function __construct(array $config = [])
	{
		if (!empty($config)) {
			$this->config   =  array_merge($this->config, $config);
		}

		$class          =  $this->getBuilderClass();

		$this->builder  = new $class($this);

		//执行初始化操作
		$this->initialize();
	}

    /**
     * 初始化
     * @Author   Tangy                    <1622305313@qq.com>
     * @DateTime 2020-08-12T10:47:44+0800
     * @param    bool|string    $name  连接标识 true 强制重新连接
     * @version  [version]
     * @return   [type]                   [description]
     */
	protected function initialize()
	{}


	public static function  instance($config = [], $name = false)
	{
		if (false === $name) {
			$name  = md5(serialize($config));
		}

		if (true === $name || !isset(self::$instance[$name])) {
			if (empty($config['type'])) {
				throw new InvalidArgumentException('Undefined db type');
			}

			//记录初始化信息
			if (true === $name) {
				$name = md5(serialize($config));
			}

			self::$instance[$name]  = Loader::factory($config['type'], '\\sample\\db\\connector\\', $config);
		}

		return self::$instance[$name];
	}


	public function getBuilderClass()
	{
		if (!empty($this->builderClassName)) {
			return $this->builderClassName;
		}

		return $this->getConfig('builder') ? : '\\sample\\db\\builder\\' . ucfirst($this->getConfig('type'));
	}



	/**
	 * 获取数据表的主键
	 * @Author   Tangy                    <1622305313@qq.com>
	 * @DateTime 2020-08-12T11:23:50+0800
	 * @version  [version]
	 * @param    [type]                   $tableName          [description]
	 * @return   [type]                                       [description]
	 */
	public function getPk($tableName)
	{
		return $this->getTableInfo($tableName, 'pk');
	}

	public function getTableInfo($tableName, $fetch = '')
	{
		if (is_array($tableName)) {
			$tableName  = key($tableName) ? : current($tableName);
		}

		if (strpos($tableName, ',')) {
			//多表不获取字段信息
			return false;
		}
	}
}