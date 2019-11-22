<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Braintree\Exceptions\NotImplementedException;
use Omnipay\Tests\TestCase;

class CaptureRequestTest extends TestCase
{
    /**
     * @var AuthorizeRequest
     */
    private $request;

    public function setUp(): void
    {
        $this->request = new CaptureRequest($this->getHttpClient(), $this->getHttpRequest(), \Braintree_Configuration::gateway());
    }

	/**
	 * @throws InvalidRequestException
	 */
	public function testGetDataReturn(): void
	{
		$this->request->setTransactionId('445566');
		$this->request->setAmount('13.21');
        $data = $this->request->getData();

		$expected = [];
		$expected['amount'] = 13.21;
		$expected['transactionId'] = '445566';

		$this->assertEquals($expected, $data);
    }
}
