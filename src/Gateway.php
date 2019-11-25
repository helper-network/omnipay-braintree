<?php

namespace Omnipay\Braintree;

use Omnipay\Braintree\Message\StatusRequest;
use Omnipay\Common\AbstractGateway;
use Omnipay\Braintree\Message\AuthorizeRequest;
use Omnipay\Braintree\Message\CaptureRequest;
use Omnipay\Braintree\Message\CreateBankRequest;
use Omnipay\Braintree\Message\CreateCardRequest;
use Omnipay\Braintree\Message\CreateCustomerRequest;
use Omnipay\Braintree\Message\PurchaseRequest;
use Omnipay\Braintree\Message\RefundRequest;
use Omnipay\Braintree\Message\RetrievePaymentRequest;
use Omnipay\Braintree\Message\VoidRequest;
use Omnipay\Common\Http\ClientInterface;
use Omnipay\Common\Message\AbstractRequest;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

/**
 * iPay8 Gateway Driver for Omnipay
 *
 * This driver is based on
 * Online Payment Switching Gateway Technical Specification Version 1.6.1
 * @link https://drive.google.com/file/d/0B4YUBYSgSzmAbGpjUXMyMWx6S2s/view?usp=sharing
 */
class Gateway extends AbstractGateway {
	/** @var \Braintree_Gateway */
	private $braintree;

	public function __construct(ClientInterface $httpClient = null, HttpRequest $httpRequest = null, \Braintree_Gateway $braintree = null)
	{
		if ($braintree === null) {
			$this->braintree = \Braintree_Configuration::gateway();
		}
		parent::__construct($httpClient, $httpRequest);
	}

	protected function createRequest($class, array $parameters) {
		/** @var  AbstractRequest $obj */
		$obj = new $class($this->httpClient, $this->httpRequest, $this->braintree);
		return $obj->initialize(array_replace($this->getParameters(), $parameters));
	}

	public function getName()
	{
		return 'Braintree';
	}

	public function getDefaultParameters()
	{
		return array(
			'merchantId' => '',
			'publicKey' => '',
			'privateKey' => '',
			'testMode' => false,
		);
	}

	public function getMerchantId()
	{
		return $this->getParameter('merchantId');
	}

	public function setMerchantId($value)
	{
		return $this->setParameter('merchantId', $value);
	}

	public function getPublicKey()
	{
		return $this->getParameter('publicKey');
	}

	public function setPublicKey($value)
	{
		return $this->setParameter('publicKey', $value);
	}

	public function getPrivateKey()
	{
		return $this->getParameter('privateKey');
	}

	public function setPrivateKey($value)
	{
		return $this->setParameter('privateKey', $value);
	}

	public function authorize(array $parameters = [])
	{
		return $this->createRequest(AuthorizeRequest::class, $parameters);
	}

	public function purchase(array $parameters = [])
	{
		return $this->createRequest(PurchaseRequest::class, $parameters);
	}

	public function void(array $parameters = [])
	{
		return $this->createRequest(VoidRequest::class, $parameters);
	}

	public function refund(array $parameters = [])
	{
		return $this->createRequest(RefundRequest::class, $parameters);
	}

	public function capture(array $parameters = [])
	{
		return $this->createRequest(CaptureRequest::class, $parameters);
	}

	public function createCustomer(array $parameters = []){
		return $this->createRequest(CreateCustomerRequest::class, $parameters);
	}

	public function createCard(array $parameters = [])
	{
		return $this->createRequest(CreateCardRequest::class, $parameters);
	}

	public function retrievePayment(array $parameters = []) {
		return $this->createRequest(RetrievePaymentRequest::class, $parameters);

	}

	public function getSTatus(array $parameters = []) {
		return $this->createRequest(StatusRequest::class, $parameters);
	}

}
