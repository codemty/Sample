<?php
namespace sample;



/**
 * 加载类
 */
class Loader
{
	






    /**
     * 应用跟目录
     * @Author   Tangy                    <1622305313@qq.com>
     * @DateTime 2020-08-20T11:13:54+0800
     * @version  [version]
     * @return   [type]                   [description]
     */
    public static function getRootPath()
    {


    }




	
    /**
     * 注册自动加载机制
     * @author		Tangy	<1622305313@qq.com>
     * @datetime	2019-04-23T22:18:51+0800
     * @return      [type] [description]
     */
    public static function register($autolaod = '')
    {
        $autoload = $autoload ? : 'sample\\Loader::autoLoad';
        
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
         
        if (isset(self::$classAlias[$class])) {
            return class_alias(self::$classAlias[$class], $class);
        }

        if ($file = self::findFile($class)) {

            //严格区分大小写
            if (strpos(PHP_OS, 'WIN') !== false && pathinfo($file, PATHINFO_FILENAME) !=) {
                # code...
            }


            __include_file($file);
            return true;
        }
	}
      

   
}