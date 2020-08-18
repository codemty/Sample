<?php
namespace sample;




class Facade
{




	public static function name(){
		echo 'method exists';
	}





	public static function __callStatic($method, $arguments)
	{
		echo $method;
	}
}