<?php

namespace Omnipay\Braintree\Message;

use Omnipay\Common\CreditCard;
use Omnipay\Tests\TestCase;

class CreateCreditCardRequestTest extends TestCase
{
	private $request;

	public function setUp(): void
	{
		$this->request = new CreateCardRequest($this->getHttpClient(), $this->getHttpRequest(), \Braintree_Configuration::gateway());


		$card = new CreditCard();
		$card->setNumber('123123123123');
		$card->setExpiryMonth('07');
		$card->setExpiryYear('2020');
		$this->request->initialize([
			'Card' => $card,
			'CustomerId' => '12345'
		]);
	}

	/**
	 * @throws \Omnipay\Common\Exception\InvalidRequestException
	 */
	public function testGetDataReturn(): void {
		$data = $this->request->getData();

		$this->assertEquals('123123123123', $data['number']);
		$this->assertEquals('07/20', $data['expirationDate']);
		$this->assertEquals('12345', $data['customerId']);
	}
}
