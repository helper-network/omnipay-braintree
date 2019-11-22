<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Tests\TestCase;

class CreateCustomerRequestTest extends TestCase
{
	private $request;

	public function setUp(): void
	{
		$this->request = new CreateCustomerRequest($this->getHttpClient(), $this->getHttpRequest(), \Braintree_Configuration::gateway());

		$this->request->initialize([
			'FirstName' => 'Mike',
			'LastName' => 'Jones',
			'Company' => 'Jones Co.',
			'Email' => 'mike.jones@example.com',
			'Phone' => '281.330.8004',
			'Fax' => '419.555.1235',
			'Website' => 'http://example.com'
		]);
	}

	public function testGetDataReturn()
	{
		$data = $this->request->getData();

		$this->assertEquals('Mike', $data['firstName']);
		$this->assertEquals('Jones', $data['lastName']);
		$this->assertEquals('Jones Co.', $data['company']);
		$this->assertEquals('mike.jones@example.com', $data['email']);
		$this->assertEquals('281.330.8004', $data['phone']);
		$this->assertEquals('419.555.1235', $data['fax']);
		$this->assertEquals('http://example.com', $data['website']);
	}

}
