<?php
namespace Reggora\Api;

use Reggora\Adapter\GuzzleAdapter;

class Lenders extends AbstractApi {

	public function __construct(GuzzleAdapter $adapter)
	{
		parent::__construct($adapter);
	}
}