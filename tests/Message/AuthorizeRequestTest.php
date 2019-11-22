<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Tests\TestCase;

class AuthorizeRequestTest extends TestCase
{
    /**
     * @var AuthorizeRequest
     */
    private $request;

    public function setUp(): void
    {
        $this->request = new AuthorizeRequest($this->getHttpClient(), $this->getHttpRequest(), \Braintree_Configuration::gateway());
    }

	public function testGetDataReturn(): void
	{
		$this->request->setAccountId('123123');
		$this->request->setAmount('10.99');
        $data = $this->request->getData();

		$expected = [];
		$expected['amount'] = 10.99;
		$expected['paymentMethodToken'] = '123123';
		$expected['options'] = [
			'submitForSettlement' => false
		];

		$this->assertEquals($expected, $data);
    }
}
