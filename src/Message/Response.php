<?php

namespace Omnipay\Braintree\Message;

use Braintree\Result\Error;
use Braintree\Result\Successful;
use Omnipay\Common\Message\AbstractResponse;

class Response extends AbstractResponse {
	/**
	 * Is the transaction successful?
	 *
	 * @return bool
	 */
	public function isSuccessful() {
		return $this->data->success ?? false;
	}

	/**
	 * Get the error message from the response.
	 *
	 * Returns null if the request was successful.
	 *
	 * @return string|null
	 */
	public function getMessage() {
		if (isset($this->data->message) && $this->data->message) {
			return $this->data->message;
		}

		return null;
	}


	public function getTransactionReference() {
		$this->data->customer->id;
	}

	public function getTransactionId() {
		return $this->data['transactionId'];
	}
}
