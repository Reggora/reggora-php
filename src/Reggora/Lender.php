<?php
namespace Reggora;

use Reggora\Adapter\GuzzleAdapter;

class Lender {

	/**@var GuzzleAdapter */
	protected $adapter;

	/**@var Lender|null */
    public static $_instance;

	public function __construct(String $email, String $password, String $integrationToken)
	{
		$authenticationInformation = GuzzleAdapter::authenticateLender($email, $password);

		$this->adapter = new GuzzleAdapter($authenticationInformation['token'], $integrationToken);

		self::$_instance = $this;
	}

	public function getAdapter()
	{
		return $this->adapter;
	}

    public static function getInstance() {
        return self::$_instance;
    }
}