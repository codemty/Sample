<?php
namespace sample;



/**
 * 加载类
 */
class Loader
{
	
	
    /**
     * 注册自动加载机制
     * @author		Tangy	<1622305313@qq.com>
     * @datetime	2019-04-23T22:18:51+0800
     * @return      [type] [description]
     */
    public static function register($autolaod = '')
    {
        $autoload = $autoload ? $autolaod : 'sample\\Loader::autoLoad';
        
        //注册系统自动加载函数
        spl_autoload_register($autoload, true, true);




        //注册composer自动加载函数
        // if (condition) {
        // 	# code...
        // }


    }







    /**
     * 自动加载方法
     * @author		Tangy	<1622305313@qq.com>
     * @datetime	2019-04-23T22:06:07+0800
     * @param       String $class  非限定名称(类名)、限定名称(带命名空间的类名)、完全限定名称(带完整命名空间的类名)
     * @return                            [type]        [description]
     */
	public static function autoLoad($class)
	{
         




	}
      

   
}