<?php

namespace Omnipay\Braintree\Message;


class CaptureRequest extends AbstractRequest
{
	/**
	 * @return array|mixed|void
	 * @throws \Omnipay\Common\Exception\InvalidRequestException
	 */
	public function getData()
	{
		$data = [
			'amount' => $this->getAmount(),
			'transactionId' => $this->getTransactionId(),
		];

		return $data;
	}

	/**
	 * @param mixed $data
	 * @return Response|\Omnipay\Common\Message\ResponseInterface
	 * @throws \Exception
	 */
	public function sendData($data) {
		$response = $this->braintree->transaction()->submitForSettlement($data['transactionId'], $data['amount']);

		return $this->createResponse($response);
	}
}
