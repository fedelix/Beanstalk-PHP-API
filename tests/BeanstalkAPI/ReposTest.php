<?php

//
// Perform unit testing on the Repository part of the BeanstalkAPI object using PHPUnit
//


class ReposTest extends PHPUnit_Framework_TestCase
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
		$this->Beanstalk = new BeanstalkAPI('account', 'user', 'pass');
	}
	
	public function testFindAllRepositories()
	{
		$repos = $this->Beanstalk->find_all_repositories();
		
		$this->doReturnTypeCheck($repos);
		
		$this->assertTrue(isset($repos->repository));
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testFindSingleRepositoryException()
	{
		$this->Beanstalk->find_single_repository(null);
	}
	
	public function findSingleRepositoryProvider()
	{
		$repos = $this->Beanstalk->find_all_repositories();
		
		return array(array($repos->repository[0]->id));
	}
	
	/**
	 * @dataProvider findSingleRepositoryProvider
	 */
	public function testFindSingleRepository($repo_id)
	{
		$repo = $this->Beanstalk->find_single_repository($repo_id);
		
		$this->doReturnTypeCheck($repo);
		
		$this->assertTrue(isset($repo->id));
		$this->assertTrue(isset($repo->title));
		$this->assertTrue(isset($repo->{'accout-id'}));
	}
}