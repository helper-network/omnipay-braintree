<?php

namespace Omnipay\Braintree\Message;

class AuthorizeRequest extends AbstractRequest
{
	/**
	 * @return array|mixed|void
	 * @throws \Omnipay\Common\Exception\InvalidRequestException
	 */
	public function getData()
	{
		$data = [
			'amount' => $this->getAmount(),
			'paymentMethodToken' => $this->getAccountId(),
			'options' => [
				'submitForSettlement' => false
			]
		];

		return $data;
	}

	/**
	 * @param mixed $data
	 * @return Response|\Omnipay\Common\Message\ResponseInterface
	 * @throws \Exception
	 */
	public function sendData($data) {
		$response = $this->braintree->transaction()->sale($data);

		return $this->createResponse($response);
	}
}
