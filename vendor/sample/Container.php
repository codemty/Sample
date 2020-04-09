<?php
namespace sample;



use ReflectionClass;
use ReflectionException;



/**
 * 容器类
 */
class Container
{
	
	
    protected static $instance;

    /**
     * 容器的标识符
     * @var [type]
     */
    protected $name;


    /**
     * 预注册类
     * @var [type]
     */
    protected $bind = [
       'sample'     => Sample::class



    ];







    
    /**
     * 私有化的构造函数
     * @author		Tangy	<1622305313@qq.com>
     * @datetime	2019-04-22T23:24:54+0800
     */
    private function __construct()
    {

    }


    /**
     * 设置容器的实例
     * @author        Tangy    <1622305313@qq.com>
     * @datetime    2019-04-23T23:42:09+0800
     * @param                             [type] $instance [description]
     */
    public static function setInstance($instance)
    {
        static::$instance = $instance;
    }


    /**
     * 获取容器的实例
     * @author        Tangy    <1622305313@qq.com>
     * @datetime    2019-04-23T23:38:02+0800
     * @return                            [type] [description]
     */
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            static::$instance = new static;
        }
        return self::$instance;
    }

    /**
     * 获取容器中的对象实例
     * @author		Tangy	<1622305313@qq.com>
     * @datetime	2019-04-22T23:18:42+0800
     * @return      object
     */
	public static function get($abstract, $vars = [], $newInstance = false)
	{
        return self::getInstance()->make($abstract, $vars ,$newInstance);
	}



    /**
     * 创建类的实例
     * @author		Tangy	<1622305313@qq.com>
     * @datetime	2019-04-22T23:36:58+0800
     * @param       String   $abstract    类名或标识
     * @param       Array|   $vars        变量
     * @param       boolean  $newInstance  是否每次创建新的实例
     * @return      object
     */
    public function make($abstract, $vars, $newInstance)
    {
        if (isset($this->bind[$abstract])) {
           $abstract = $this->bind[$abstract];
        }


        $object = $this->invokeClass($abstract, $vars);
        return $object;
    }

    /**
     * 调用反射--执行类的实例化
     * @author		Tangy	<1622305313@qq.com>
     * @datetime	2019-04-22T23:53:01+0800
     * @return                            [type] [description]
     */
    public function invokeClass($class, $vars)
    {  
    	try {

    		$reflect = new ReflectionClass($class);

            //判断类是否已经定义了默认的其他实例化方法
            // if ($reflect->hasMethod('')) {
            // 	# code...
            // }


            //返回一个ReflectionMethod对象或者null
            $constructor = $reflect->getConstructor();

            
            // $args = is_null($constructor) ? [] : 
            $args = [];

            //ReflectClass的方法--从给出的参数，创建一个类的新实例。
            return $reflect->newInstanceArgs($args);


    	} catch (ReflectionException $e) {
            //抛出新的异常
    		// throw new ClassNotFoundException("'class not exists: ". $class, $class, 1);
    	}

    }
}



/**
     * 创建类的实例
     * @access public
     * @param  string        $abstract       类名或者标识
     * @param  array|true    $vars           变量
     * @param  bool          $newInstance    是否每次创建新的实例
     * @return object
     */
//     public function make($abstract, $vars = [], $newInstance = false)
//     {
//         if (true === $vars) {
//             // 总是创建新的实例化对象
//             $newInstance = true;
//             $vars        = [];
//         }

//         $abstract = isset($this->name[$abstract]) ? $this->name[$abstract] : $abstract;

//         if (isset($this->instances[$abstract]) && !$newInstance) {
//             return $this->instances[$abstract];
//         }

//         if (isset($this->bind[$abstract])) {
//             $concrete = $this->bind[$abstract];

//             if ($concrete instanceof Closure) {
//                 $object = $this->invokeFunction($concrete, $vars);
//             } else {
//                 $this->name[$abstract] = $concrete;
//                 return $this->make($concrete, $vars, $newInstance);
//             }
//         } else {
//             $object = $this->invokeClass($abstract, $vars);
//         }

//         if (!$newInstance) {
//             $this->instances[$abstract] = $object;
//         }

//         return $object;
//     }

// /**
//      * 调用反射执行类的实例化 支持依赖注入
//      * @access public
//      * @param  string    $class 类名
//      * @param  array     $vars  参数
//      * @return mixed
//      */
//     public function invokeClass($class, $vars = [])
//     {
//         try {
//             $reflect = new ReflectionClass($class);

//             if ($reflect->hasMethod('__make')) {
//                 $method = new ReflectionMethod($class, '__make');

//                 if ($method->isPublic() && $method->isStatic()) {
//                     $args = $this->bindParams($method, $vars);
//                     return $method->invokeArgs(null, $args);
//                 }
//             }

//             $constructor = $reflect->getConstructor();

//             $args = $constructor ? $this->bindParams($constructor, $vars) : [];

//             return $reflect->newInstanceArgs($args);

//         } catch (ReflectionException $e) {
//             throw new ClassNotFoundException('class not exists: ' . $class, $class);
//         }
//     }


//     /**
//      * 调用反射执行类的实例化 支持依赖注入
//      * @access public
//      * @param  string    $class 类名
//      * @param  array     $vars  参数
//      * @return mixed
//      */
//     public function invokeClass($class, $vars = [])
//     {
//         try {
//             $reflect = new ReflectionClass($class);

//             if ($reflect->hasMethod('__make')) {
//                 $method = new ReflectionMethod($class, '__make');

//                 if ($method->isPublic() && $method->isStatic()) {
//                     $args = $this->bindParams($method, $vars);
//                     return $method->invokeArgs(null, $args);
//                 }
//             }

//             $constructor = $reflect->getConstructor();

//             $args = $constructor ? $this->bindParams($constructor, $vars) : [];

//             return $reflect->newInstanceArgs($args);

//         } catch (ReflectionException $e) {
//             throw new ClassNotFoundException('class not exists: ' . $class, $class);
//         }
//     }