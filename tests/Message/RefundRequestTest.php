<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Braintree\Exceptions\NotImplementedException;
use Omnipay\Tests\TestCase;

class RefundRequestTest extends TestCase
{
    /**
     * @var AuthorizeRequest
     */
    private $request;

    public function setUp(): void
    {
        $this->request = new RefundRequest($this->getHttpClient(), $this->getHttpRequest(), \Braintree_Configuration::gateway());
    }

	/**
	 * @throws InvalidRequestException
	 */
	public function testGetDataReturn(): void
	{
		$this->request->setTransactionId('1112222');
		$this->request->setAmount('4.59');
        $data = $this->request->getData();

		$this->assertEmpty($data);
    }
}
