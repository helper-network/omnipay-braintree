<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Braintree\Exceptions\NotImplementedException;
use Omnipay\Tests\TestCase;

class PurchaseRequestTest extends TestCase
{
    /**
     * @var AuthorizeRequest
     */
    private $request;

    public function setUp(): void
    {
        $this->request = new PurchaseRequest($this->getHttpClient(), $this->getHttpRequest(), \Braintree_Configuration::gateway());
    }

	/**
	 * @throws InvalidRequestException
	 */
	public function testGetDataReturn(): void
	{
		$this->request->setAccountId('2222333');
		$this->request->setAmount('10.90');
        $data = $this->request->getData();

		$expected = [];
		$expected['amount'] = 10.90;
		$expected['paymentMethodToken'] = '2222333';
		$expected['options'] = [
			'submitForSettlement' => true
		];

		$this->assertEquals($expected, $data);
    }
}
