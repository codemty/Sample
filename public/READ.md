2019-04-22
如何开发一套简易框架。
研究别人的框架，终究不如自己想办法开发一套框架出来。能够更深入的理解PHP,也能借此提升技术综合能力。





1.PHP自动创建类的实例方式？
答：






2.使用容器的方式，创建类的实例，有什么好处？
答：依赖注入、控制反转、容器、工厂模式








类的自动加载：首先需要include 或者 require 引入对应的文件。 而文件的名称需要遵循一定的规则，比如PSR-4,否者，完全没办法知道需要记载的类在哪个文件中，如何去引入。





怎么定位怎个框架的根目录  以及应用类库的目录   如果在index中



到这里，基本实现了类的自动加载以及使用容器创建一个类的实例。

接下来，困难的来了。如何根据URL来解析运行相关的代码。比如，/module_name/controller/action 
包含了路径的解析。以及控制器的实例化，action的方法调用。

应用目录的指定



http://domain:port/module/controller/action(.suffix)
.htaccess 文件对美化之后的url进行补全








模型中声明data属性 为数组来保存对应的数据表对应记录的数据
字段名为key值，字段值为 value 值 

不对，类显示声明的私有属性，都不允许通过__get 魔术方法来访问而是通过自定义的getAttr方法来获取相应的值，
如果传递的key参数不存在data中，那么返回错误或者抛出异常






        
使用composer 安装的第三方类库 还有无法自动引入类的问题存在而这个问题只有同步更新相关composer autoloader.php文件才能解决





一个框架中，肯定需要包含对数据库的操作的封装。pdo方式的操作与连接是当前php主流的一种数据库操作方式






如何使用composer 管理框架以及 自动识别composer 管理的第三方类库


/**
 * php>5.6的composer加载类库的方法
 * 1.使用composer管理类，比如安装一个类之后，就会在/vendor/composer/文件里面的几个文件中，自动生成类库的相关配置
 * autoload_static.php中会自动生成一些变量值，就是相应类库的类信息文件之类；
 * autoload_files.php是加载一些助手函数的文件类；
 * autoload_real.php是实现加载的功能类；
 * ClassLoader.php实现类加载的助手类
 * 其他相关类也可以看一下，这里只是分析php>5.6会用到的文件。
 * autoload_static.php其实已经包含了autoload_classmap.php、autoload_namespaces.php、autoload_psr4.php这些文件的值。
 * 2.使用composer管理的项目，在入口文件index.php中会包含autoload.php文件，而这个文件会去调用autoload_real.php文件类的getLoader()方法去实现类加载
 * 3.getLoader方法的实现原理，其实就是使用php的spl_autoload_register()方法注册自动加载器。只要注册了相应方法到加载器中。这个方法可以在执行程序时，当需要调用其他类的时候通过这个函数去自动加载目标类
 * 4.而第三步具体怎么找到相应类文件，这个可以去具体方法中查看。大致是使用了autoload_static.php,autoload_files.php文件中的数据，然后在ClassLoader.php中实现相应逻辑判断，并返回包含相应类文件。




 依赖注入：不是在类的使用方法中实例化需要使用的类，而是传递一个对象的实例对象
        
