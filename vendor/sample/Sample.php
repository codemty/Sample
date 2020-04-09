<?php
namespace sample;



/**
 * 框架的应用类
 */
class Sample 
{
	
	


	public function __construct()
	{
        
	}





	public function run()
	{
        try {
            var_dump($_SERVER);exit();
        } catch (Exception $e) {
        	
        }
        return $this;
	}


	public function send()
	{
        echo "send function";
	}



}

