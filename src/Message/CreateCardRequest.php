<?php

namespace Omnipay\Braintree\Message;


use Omnipay\Common\CreditCard;

class CreateCardRequest extends AbstractRequest
{
	public function getCard()
	{
		return $this->getParameter('Card');
	}

	public function setCard($value)
	{
		return $this->setParameter('Card', $value);
	}


	/**
	 * @return array|mixed|void
	 * @throws \Omnipay\Common\Exception\InvalidRequestException
	 */
	public function getData()
	{
		$this->validate('Card');
		/** @var CreditCard $card */
		$card = $this->getCard();

		$data = [
			'number' => $card->getNumber(),
			'expirationDate' => $card->getExpiryDate('m/y'),
			'customerId' => $this->getCustomerId(),
		];

		return $data;
	}

	/**
	 * @param mixed $data
	 * @return Response|\Omnipay\Common\Message\ResponseInterface
	 * @throws \Exception
	 */
	public function sendData($data) {
		$response = $this->braintree->creditCard()->create($data);

		return $this->createResponse($response);
	}

}
