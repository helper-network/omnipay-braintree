<?php

namespace Omnipay\Braintree\Message;


class CreateCustomerRequest extends AbstractRequest {

	public function setFirstName($value) {
		return $this->setParameter('FirstName', $value);
	}

	public function getFirstName() {
		return $this->getParameter('FirstName');
	}

	public function setLastName($value) {
		return $this->setParameter('LastName', $value);
	}

	public function getLastName() {
		return $this->getParameter('LastName');
	}

	public function setCompany($value) {
		return $this->setParameter('Company', $value);
	}

	public function getCompany() {
		return $this->getParameter('Company');
	}

	public function setEmail($value) {
		return $this->setParameter('Email', $value);
	}

	public function getEmail() {
		return $this->getParameter('Email');
	}

	public function setPhone($value) {
		return $this->setParameter('Phone', $value);
	}

	public function getPhone() {
		return $this->getParameter('Phone');
	}

	public function setFax($value) {
		return $this->setParameter('Fax', $value);
	}

	public function getFax() {
		return $this->getParameter('Fax');
	}

	public function setWebsite($value) {
		return $this->setParameter('Website', $value);
	}

	public function getWebsite() {
		return $this->getParameter('Website');
	}


	public function getData() {
		$data = [
			'firstName' => $this->getFirstName(),
			'lastName' => $this->getLastName(),
			'company' => $this->getCompany(),
			'email' => $this->getEmail(),
			'phone' => $this->getPhone(),
			'fax' => $this->getFax(),
			'website' => $this->getWebsite()
		];

		return $data;
	}


	/**
	 * @param mixed $data
	 * @return Response|\Omnipay\Common\Message\ResponseInterface
	 * @throws \Exception
	 */
	public function sendData($data) {
		$response = $this->braintree->customer()->create($data);

		return $this->createResponse($response);
	}
}
