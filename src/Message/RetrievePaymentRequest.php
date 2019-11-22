<?php

namespace Omnipay\Braintree\Message;


class RetrievePaymentRequest extends AbstractRequest
{

	/**
	 * @return array|mixed|void
	 * @throws \Omnipay\Common\Exception\InvalidRequestException
	 */
	public function getData()
	{
		return [];
	}

	/**
	 * @param mixed $data
	 * @return Response|\Omnipay\Common\Message\ResponseInterface
	 * @throws \Exception
	 */
	public function sendData($data) {
		$response = $this->braintree->transaction()->sale($this->getTransactionId());

		return $this->createResponse($response);
	}
}
