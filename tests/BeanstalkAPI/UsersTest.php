<?php

//
// Perform unit testing on the User part of the BeanstalkAPI object using PHPUnit
//


class UsersTest extends PHPUnit_Framework_TestCase
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
	
	public function testFindAllUsers()
	{
		$users = $this->Beanstalk->find_all_users();
		
		$this->doReturnTypeCheck($users);
		
		$this->assertObjectHasAttribute('user', $users);
		$this->assertGreaterThan(0, count($users->user));
		$this->assertObjectHasAttribute('account-id', $users->user[0]);
		$this->assertObjectHasAttribute('email', $users->user[0]);
		$this->assertObjectHasAttribute('id', $users->user[0]);
		$this->assertObjectHasAttribute('login', $users->user[0]);
		
		return $users;
	}
	
	/**
	 * @depends testFindAllUsers
	 */
	public function testFindSingleUser($users)
	{
		$user_id = $users->user[0]->id;
		
		$user = $this->Beanstalk->find_single_user($user_id);
		
		$this->doReturnTypeCheck($user);
		
		$this->assertObjectHasAttribute('account-id', $user);
		$this->assertObjectHasAttribute('email', $user);
		$this->assertObjectHasAttribute('id', $user);
		$this->assertObjectHasAttribute('login', $user);
	}
	
	public function testFindCurrentUser()
	{
		$user = $this->Beanstalk->find_current_user();
		
		$this->doReturnTypeCheck($user);
		
		$this->assertObjectHasAttribute('account-id', $user);
		$this->assertObjectHasAttribute('email', $user);
		$this->assertObjectHasAttribute('id', $user);
		$this->assertObjectHasAttribute('login', $user);
	}
	
	public function testCreateUser()
	{
		$this->markTestIncomplete();
	}
	
	public function testUpdateUser()
	{
		$this->markTestIncomplete();
	}
	
	public function testDeleteUser()
	{
		$this->markTestIncomplete();
	}
}
