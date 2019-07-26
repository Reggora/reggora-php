<?php
namespace Reggora\Entity;

abstract class AbstractEntity {

	protected $originalData;

	protected $dirtyData = [];

	public function __construct(array $data)
	{
		$this->originalData = $data;
	}

	public function __get($key)
	{
		return $this->originalData[$key];
	}

	public function __set($key, $value)
	{
		$this->dirtyData[$key] = $value;
	}

	public function clean()
	{
		$this->originalData = array_merge($this->originalData, $this->dirtyData);
		$this->dirtyData = [];
	}
}