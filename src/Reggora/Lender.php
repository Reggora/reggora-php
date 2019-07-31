<?php
namespace Reggora;

use Reggora\Adapter\GuzzleAdapter;

final class Vendor {

	/**@var GuzzleAdapter */
	protected $adapter;

	/**@var Vendor|null */
    public static $instance;

    /**
     * Vendor constructor.
     * @param String $email
     * @param String $password
     * @param String $integrationToken
     */
    public function __construct(String $email, String $password, String $integrationToken)
	{
		$authenticationInformation = GuzzleAdapter::authenticateVendor($email, $password);

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
     * @return Vendor|null
     */
    public static function getInstance() {
        return self::$instance;
    }
}