<?php

namespace Omnipay\Braintree\Message;

use Exception;
use Omnipay\Common\Http\ClientInterface;
use Omnipay\Common\Message\AbstractRequest as BaseAbstractRequest;
use Symfony\Component\HttpFoundation\Request as HttpRequest;

abstract class AbstractRequest extends BaseAbstractRequest
{


	/** @var \Braintree_Gateway */
	protected $braintree;


	public function __construct(ClientInterface $httpClient, HttpRequest $httpRequest, \Braintree_Gateway $gateway) {
		$this->braintree = $gateway;
		parent::__construct($httpClient, $httpRequest);
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

	public function getAmount(){
		return $this->getParameter('Amount');
	}

	public function setAmount($value){
		return $this->setParameter('Amount', $value);
	}


	public function getCustomerId()
	{
		return $this->getParameter('CustomerId');
	}

	public function setCustomerId($value)
	{
		return $this->setParameter('CustomerId', $value);
	}

	public function getAccountId()
	{
		return $this->getParameter('AccountId');
	}

	public function setAccountId($value)
	{
		return $this->setParameter('AccountId', $value);
	}

	public function send() {
		$this->configure();
		return parent::send();
	}

	public function configure(){
		if ($this->getTestMode()) {
			$this->braintree->config->setEnvironment('sandbox');
		} else {
			$this->braintree->config->setEnvironment('production');
		}

		$this->braintree->config->setMerchantId($this->getMerchantId());
		$this->braintree->config->setPublicKey($this->getPublicKey());
		$this->braintree->config->setPrivateKey($this->getPrivateKey());
	}

	/**
	 * @param $data
	 * @return Response
	 * @throws Exception
	 */
	protected function createResponse($data)
	{
		return new Response($this, $data);
	}
}
