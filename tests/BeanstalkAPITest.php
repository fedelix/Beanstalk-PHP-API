<?php

//
// Perform unit testing on the BeanstalkAPI object using PHPUnit
//

require(dirname(__FILE__) . "/../lib/beanstalkapi.class.php");

// Constants used for login in each test
define('BEANSTALK_TEST_ACCOUNT', 'account');
define('BEANSTALK_TEST_USER', 'user');
define('BEANSTALK_TEST_PASS', 'pass');


class BeanstalkAPITest extends PHPUnit_Framework_TestCase
{
	/**
	 * Generic function to check return type from all API calls - can be used as a wrapper
	 */
	protected function doReturnTypeCheck($apiResult)
	{
		$this->assertEquals('SimpleXMLElement', get_class($apiResult));
		
		return $apiResult;
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testInstantiationException()
	{
		new BeanstalkAPI();
	}
	
	/**
	 * Should correctly instantiate Beanstalk connection - used in subsequent API calls
	 */
	public function testInstantiation()
	{
		$Beanstalk = new BeanstalkAPI(BEANSTALK_TEST_ACCOUNT, BEANSTALK_TEST_USER, BEANSTALK_TEST_PASS);
		
		$this->assertInstanceOf('BeanstalkAPI', $Beanstalk);
		
		return $Beanstalk;
	}
	
	/**
	 * @expectedException APIException
	 * @expectedExceptionCode 401
	 */
	public function testBadLoginException()
	{
		$Beanstalk = new BeanstalkAPI('account', 'bad', 'login');
		$Beanstalk->find_all_plans();
	}
}
