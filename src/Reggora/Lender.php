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
     * @param boolean $sandbox
     */
    public function __construct(String $email, String $password, String $integrationToken, boolean $sandbox = true)
	{
		$authenticationInformation = GuzzleAdapter::authenticateVendor($email, $password, $sandbox);

		$this->adapter = new GuzzleAdapter($authenticationInformation['token'], $integrationToken, $sandbox);

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