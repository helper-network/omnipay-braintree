<?php

namespace Omnipay\Braintree\Message;


class RefundRequest extends AbstractRequest
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
		$response = $this->braintree->transaction()->refund($this->getTransactionId(), $this->getAmount());

		return $this->createResponse($response);
	}
}
