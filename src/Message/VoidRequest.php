<?php

namespace Omnipay\Braintree\Message;


class VoidRequest extends CaptureRequest
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
		$response = $this->braintree->transaction()->void($this->getTransactionId());

		return $this->createResponse($response);
	}
}
