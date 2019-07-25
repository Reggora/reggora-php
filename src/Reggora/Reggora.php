<?php
namespace Reggora;

use Reggora\Adapter\GuzzleAdapter;

class Reggora {

	const BASE_API_URI = 'https://sandbox.reggora.io/';
	
	/**@var string */
	protected $email;

	/**@var string */
	protected $authToken;

	/**@var string */
	protected $integrationToken;

	/**@var GuzzleAdapter */
	protected $adapter;

	public function __construct(String $email, String $authToken, String $integrationToken)
	{
		$this->email = $email;
		$this->authToken = $authToken;
		$this->integrationToken = $integrationToken;

		$this->adapter = new GuzzleAdapter($authToken, $integrationToken);
	}
}