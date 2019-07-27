<?php
namespace Reggora;

use Reggora\Adapter\GuzzleAdapter;

final class Lender {

	/**@var GuzzleAdapter */
	protected $adapter;

	/**@var Lender|null */
    public static $instance;

    /**
     * Lender constructor.
     * @param String $email
     * @param String $password
     * @param String $integrationToken
     */
    public function __construct(String $email, String $password, String $integrationToken)
	{
		$authenticationInformation = GuzzleAdapter::authenticateLender($email, $password);

		$this->adapter = new GuzzleAdapter($authenticationInformation['token'], $integrationToken);

		self::$instance = $this;
	}

    /**
     * @return GuzzleAdapter
     */
    public function getAdapter()
	{
		return $this->adapter;
	}

    /**
     * @return Lender|null
     */
    public static function getInstance() {
        return self::$instance;
    }
}