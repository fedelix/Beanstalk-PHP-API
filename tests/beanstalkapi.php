<?php

//
// Perform unit testing on the BeanstalkAPI object using PHPUnit
//

require(dirname(__FILE__) . "/../lib/beanstalkapi.class.php");


class BeanstalkAPITest extends PHPUnit_Framework_TestCase
{
	/**
	 * Generic function to check return type from all API calls - can be used as a wrapper
	 */
	protected function doReturnTypeCheck($apiResult)
	{
		$this->assertEquals('SimpleXMLElement', get_class($apiResult))
		
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
		$repos = $Beanstalk->find_all_repositories();
		
		$this->doReturnTypeCheck($repos);
	}
	
	/**
	 * @depends testInstantiation
	 * @expectedException InvalidArgumentException
	 */
	public function testFindSingleRepositoryException(BeanstalkAPI $Beanstalk)
	{
		$Beanstalk->find_single_repository(null);
	}
	
	public function findSingleRepositoryProvider()
	{
		// Need to access BeanstalkAPI object
		// Call find_all_repositories() and return single repo
	}
	
	/**
	 * @dataProvider findSingleRepositoryProvider
	 * @depends testInstantiation
	 */
	public function testFindSingleRepository($repo_id, BeanstalkAPI $Beanstalk)
	{
		$repo = $Beanstalk->find_single_repository();
	}
}