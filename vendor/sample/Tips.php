<?php
namespace sample;


/**
 * 框架全局提示信息,同样注册到TP5.0.*框架中
 * Tips不是单列模式，也不是静态类,需要在使用时，自动初始化，可以定义助手函数，
 */
class Tips 
{
    /**
     * 单条提示信息
     * 如果某些操作是错误即止,错误提示信息就是单条的,保存到tip中
     * @var [type]
     */
    private $tip;

    /**
     * 如果某些操作是分步骤执行,彼此之间并没有依赖关系,错误提示则有多条,
     * 分开记录不同步骤的执行信息
     * 
     * @var array
     */
    private $tips = [];


	public function __construct()
	{
		
	}
    
    public function getTip()
    {

    }
 

    public function getTips()
    {

    }


	public function __set()
	{

	}

	public function __get()
	{

	}



}