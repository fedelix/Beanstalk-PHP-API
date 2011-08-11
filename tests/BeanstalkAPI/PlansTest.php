<?php

//
// Perform unit testing on the Plan part of the BeanstalkAPI object using PHPUnit
//


class PlansTest extends PHPUnit_Framework_TestCase
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
	
	public function testFindAllPlans()
	{
		$plans = $this->Beanstalk->find_all_plans();
		
		$this->doReturnTypeCheck($plans);
		
		$this->assertObjectHasAttribute('plan', $plans);
		$this->assertGreaterThan(0, count($plans->plan));
		$this->assertObjectHasAttribute('id', $plans->plan[0]);
		$this->assertObjectHasAttribute('name', $plans->plan[0]);
	}
}
