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
		
		// Used in subsequent tests
		return $repos;
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testFindSingleRepositoryException()
	{
		$this->Beanstalk->find_single_repository(null);
	}
	
	/**
	 * @depends testFindAllRepositories
	 */
	public function testFindSingleRepository($repos)
	{
		// Check we actually have a repository to test
		if(count($repos->repository) == 0)
		{
			$this->markTestSkipped('No repositories available to test');
		}
		else
		{
			// Get repository id from first repo found
			$repo_id = $repos->repository[0]->id;

			$repo = $this->Beanstalk->find_single_repository($repo_id);

			$this->doReturnTypeCheck($repo);

			$this->assertTrue(isset($repo->id));
			$this->assertTrue(isset($repo->title));
			$this->assertTrue(isset($repo->{'accout-id'}));
		}
	}
}