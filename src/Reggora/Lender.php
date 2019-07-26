<?php
namespace Reggora;

use Reggora\Adapter\GuzzleAdapter;

use Reggora\Api\Lenders\Loans;

class Lender {

	const BASE_API_URI = 'https://sandbox.reggora.io/';

	/**@var GuzzleAdapter */
	protected $adapter;

	public function __construct(String $email, String $password, String $integrationToken)
	{
		$authenticationInformation = GuzzleAdapter::authenticateLender($email, $password);

		$this->adapter = new GuzzleAdapter($authenticationInformation['token'], $integrationToken);
	}

	public function loans()
	{
		return new Loans($this->adapter);
	}
}