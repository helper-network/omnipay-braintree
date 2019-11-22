<?php
namespace Omnipay\Braintree\Exceptions;

class NotImplementedException extends \Exception
{
	public function __construct()
	{
		parent::__construct($message = '', $code = 0);
	}
}
