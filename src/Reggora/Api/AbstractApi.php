<?php
namespace Reggora\Api;

use Reggora\Adapter\GuzzleAdapter;

abstract class AbstractApi {

	/**@var GuzzleAdapter */
	protected $adapter;

	public function __construct(GuzzleAdapter $adapter)
	{
		$this->adapter = $adapter;
	}
}