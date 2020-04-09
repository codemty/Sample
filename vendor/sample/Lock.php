<?php
namespace sample;



abstract class Lock {


   /**
    * 抽象方法--读锁(共享锁)
    * @Author   Tangy                    <1622305313@qq.com>
    * @DateTime 2019-04-24T21:28:08+0800
    * @version  [version]
    * @return   [type]                   [description]
    */
   abstract protected function readLock()
   {

   }

   /**
    * 抽象方法--写锁(排它锁)
    * @Author   Tangy                    <1622305313@qq.com>
    * @DateTime 2019-04-24T21:27:41+0800
    * @version  [version]
    * @return   [type]                   [description]
    */
   abstract protected function writeLock()
   {

   }


}


class Myisam  implements Lock {
    

    public function readLock()
    {

    }

    public function writeLock()
    {

    }
}


class Innodb implements Lock {

    public function readLock()
    {

    }

    public function writeLock()
    {
    	
    }

}