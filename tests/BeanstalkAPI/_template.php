<?php

//
// Perform unit testing on the TEMPLATE part of the BeanstalkAPI object using PHPUnit
//


class TEMPLATETest extends PHPUnit_Framework_TestCase
{
	protected $Beanstalk;
	
	/**
	 * Generic function to check return type from all API calls - can be used as a wrapper
	 */
	protected function doReturnTypeCheck($apiResult)
	{
		$this->assertEquals('SimpleXMLElement', get_class($apiResult));
		
		return $apiResult;
	}
	
	protected function setUp()
	{
		$this->Beanstalk = new BeanstalkAPI(BEANSTALK_TEST_ACCOUNT, BEANSTALK_TEST_USER, BEANSTALK_TEST_PASS);
	}
}
