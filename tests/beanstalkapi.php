<?php

//
// Perform unit testing on the BeanstalkAPI object using PHPUnit
//

require(dirname(__FILE__) . "/../lib/beanstalkapi.class.php");


class BeanstalkAPITest extends PHPUnit_Framework_TestCase
{
	protected $Beanstalk;
	
	protected function setUp()
	{
		$this->Beanstalk = new BeanstalkAPI();
	}
	
	
	public function testFindAllRepositories()
	{
		
	}
}