<?php

//
// Perform unit testing on the BeanstalkAPI object using PHPUnit
//

require(dirname(__FILE__) . "/../lib/beanstalkapi.class.php");


class BeanstalkAPITest extends PHPUnit_Framework_TestCase
{
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testInstantiationException()
	{
		new BeanstalkAPI();
	}
	
	public function testInstantiation()
	{
		$Beanstalk = new BeanstalkAPI('account', 'user', 'pass');
		return $Beanstalk;
	}
	
	/**
	 * @expectedException APIException
	 */
	public function testBadLoginException()
	{
		$Beanstalk = new BeanstalkAPI('account', 'bad', 'login');
		$Beanstalk->find_all_plans();
	}
	
	/**
	 * @depends testInstantiation
	 */
	public function testFindAllRepositories(BeanstalkAPI $Beanstalk)
	{
		$Beanstalk->find_all_repositories();
	}
	
	/**
	 * @depends testInstantiation
	 * @expectedException InvalidArgumentException
	 */
	public function testFindRepositoryException(BeanstalkAPI $Beanstalk)
	{
		$Beanstalk->find_single_repository();
	}
}