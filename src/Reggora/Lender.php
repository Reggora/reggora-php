<?php
namespace Reggora;

use Reggora\Adapter\GuzzleAdapter;

final class Lender {

	/**@var GuzzleAdapter */
	protected $adapter;

	/**@var Lender|null */
    public static $instance;

	public function __construct(String $email, String $password, String $integrationToken)
	{
		$authenticationInformation = GuzzleAdapter::authenticateLender($email, $password);

		$this->adapter = new GuzzleAdapter($authenticationInformation['token'], $integrationToken);

		self::$instance = $this;
	}

	public function getAdapter()
	{
		return $this->adapter;
	}

    public static function getInstance() {
        return self::$instance;
    }
}