<?php

//
// Perform unit testing on the Public Key part of the BeanstalkAPI object using PHPUnit
//


class PublicKeysTest extends PHPUnit_Framework_TestCase
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
	
	public function testFindAllPublicKeys()
	{
		$keys = $this->Beanstalk->find_all_public_keys();
		
		$this->doReturnTypeCheck($keys);
		
		$this->assertObjectHasAttribute('public-key', $keys);
		
		return $keys;
	}
	
	public function testFindAllUserPublicKeys()
	{
		// Find public keys for current user
		$user = $this->Beantsalk->find_current_user();
		
		$keys = $this->Beanstalk->find_all_public_keys($user->id);
		
		$this->doReturnTypeCheck($keys);
		
		$this->assertObjectHasAttribute('public-key', $keys);
	}
	
	/**
	 * @expectedException InvalidArgumentException
	 */
	public function testFindSinglePublicKeyException()
	{
		$this->Beanstalk->find_single_public_key(null);
	}
	
	/**
	 * @depends testFindAllPublicKeys
	 */
	public function testFindSinglePublicKey($keys)
	{
		if(count($keys->{'public-key'}) == 0)
		{
			$this->markTestSkipped('No public keys available to test');
		}
		else
		{
			$key_id = $keys->{'public-key'}[0]->id;
			
			$key = $this->Beanstalk->find_single_public_key($key_id);
			
			$this->doReturnTypeCheck($key);
			
			$this->assertObjectHasAttribute('id', $key);
			$this->assertObjectHasAttribute('account-id', $key);
			$this->assertObjectHasAttribute('user-id', $key);
			$this->assertObjectHasAttribute('content', $key);
		}
	}
	
	public function testCreatePublicKey()
	{
		$this->markTestIncomplete();
	}
	
	public function testUpdatePublicKey()
	{
		$this->markTestIncomplete();
	}
	
	public function testDeletePublicKey()
	{
		$this->markTestIncomplete();
	}
}
