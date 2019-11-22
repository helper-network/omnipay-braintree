<?php

namespace Omnipay\Braintree;

use Omnipay\Common\CreditCard;
use Omnipay\Common\Exception\InvalidRequestException;
use Omnipay\Braintree\Message\AuthorizeRequest;
use Omnipay\Braintree\Message\CaptureRequest;
use Omnipay\Tests\GatewayTestCase;
use Omnipay\Braintree\Message\RefundRequest;
use Omnipay\Braintree\Message\RetrievePaymentRequest;
use Omnipay\Braintree\Message\VoidRequest;
use Omnipay\Braintree\Message\PurchaseRequest;
use Omnipay\Braintree\Message\CreateCardRequest;
use Omnipay\Braintree\Message\CreateCustomerRequest;

class GatewayTest extends GatewayTestCase {
	/** @var Gateway */
	protected $gateway;

	public function setUp(): void {
		parent::setUp();

		$this->gateway = new Gateway($this->getHttpClient(), $this->getHttpRequest());
	}

	public function testCreateCustomer(): void {
		$request = $this->gateway->createCustomer([
			'FirstName' => 'Mike',
			'LastName' => 'Jones',
			'Company' => 'Jones Co.',
			'Email' => 'mike.jones@example.com',
			'Phone' => '281.330.8004',
			'Fax' => '419.555.1235',
			'Website' => 'http://example.com'
		]);

		$this->assertInstanceOf(CreateCustomerRequest::class, $request);
		$this->assertSame('Mike', $request->getFirstName());
		$this->assertSame('Jones', $request->getLastName());
		$this->assertSame('Jones Co.', $request->getCompany());
		$this->assertSame('mike.jones@example.com', $request->getEmail());
		$this->assertSame('281.330.8004', $request->getPhone());
		$this->assertSame('419.555.1235', $request->getFax());
		$this->assertSame('http://example.com', $request->getWebsite());
	}

	public function testCreateCard(): void {
		$card = new CreditCard([
			'number'      => '5454545454545454',
			'expiryMonth' => '13',
			'expiryYear'  => '2021',
		]);

		$request = $this->gateway->createCard([
			'card'       => $card,
			'CustomerId' => '012345'
		]);

		$this->assertInstanceOf(CreateCardRequest::class, $request);
		$this->assertSame('012345', $request->getCustomerId());
		$this->assertSame('5454545454545454', $request->getCard()->getNumber());
		$this->assertEquals('13', $request->getCard()->getExpiryMonth());
		$this->assertEquals('2021', $request->getCard()->getExpiryYear());
	}

	/**
	 * @throws InvalidRequestException
	 */
	public function testAuthorize(): void {
		$request = $this->gateway->authorize([
			'AccountId' => '789123',
			'Amount'    => '12.73',
		]);

		$this->assertInstanceOf(AuthorizeRequest::class, $request);
		$this->assertSame('789123', $request->getAccountId());
		$this->assertSame('12.73', $request->getAmount());
	}

	/**
	 * @throws InvalidRequestException
	 */
	public function testCapture(): void{
		$request = $this->gateway->capture([
			'TransactionId' => '789123',
			'Amount'    => '5.23',
		]);

		$this->assertInstanceOf(CaptureRequest::class, $request);
		$this->assertSame('789123', $request->getTransactionId());
		$this->assertSame('5.23', $request->getAmount());
	}

	/**
	 * @throws InvalidRequestException
	 */
	public function testPurchase(): void {
		$request = $this->gateway->purchase([
			'AccountId' => '789123',
			'Amount'    => '50.70',
		]);

		$this->assertInstanceOf(PurchaseRequest::class, $request);
		$this->assertSame('789123', $request->getAccountId());
		$this->assertSame('50.70', $request->getAmount());
	}

	public function testVoid(): void {
		$request = $this->gateway->void([
			'TransactionId' => 467890,
		]);

		$this->assertInstanceOf(VoidRequest::class, $request);
		$this->assertSame(467890, $request->getTransactionId());
	}

	/**
	 * @throws InvalidRequestException
	 */
	public function testRefund(): void {
		$request = $this->gateway->refund([
			'TransactionId' => 467890,
			'Amount' => 10
		]);

		$this->assertInstanceOf(RefundRequest::class, $request);
		$this->assertSame(467890, $request->getTransactionId());
		$this->assertEquals(10, $request->getAmount());
	}

	public function testRetrievePayment(): void {
		$request = $this->gateway->retrievePayment([
			'TransactionId' => 467890,
		]);

		$this->assertInstanceOf(RetrievePaymentRequest::class, $request);
		$this->assertSame(467890, $request->getTransactionId());
	}
}
