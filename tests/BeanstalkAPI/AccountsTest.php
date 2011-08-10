<?php

//
// Perform unit testing on the Account part of the BeanstalkAPI object using PHPUnit
//


class AccountTest extends PHPUnit_Framework_TestCase
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
	
	public function testGetAccountDetails()
	{
		$this->doReturnTypeCheck($this->Beanstalk->get_account_details());
	}
	
	public function testUpdateAccountDetails()
	{
		$this->markTestIncomplete();
	}
}
