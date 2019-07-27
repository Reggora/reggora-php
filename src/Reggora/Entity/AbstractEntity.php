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
		if(isset($this->{$key}))
		{
			return $this->{$key};
		}

		if(isset($this->dirtyData[$key]))
		{
			return $this->dirtyData[$key];
		}

		return $this->originalData[$key];
	}

	public function __set($key, $value)
	{
		$this->dirtyData[$key] = $value;
	}

	public static function createFromArray(array $entities)
	{
		foreach($entities as $entity)
		{
			return new static($entity);
		}
	}

	public function clean()
	{
		$this->originalData = array_merge($this->originalData, $this->dirtyData);
		$this->dirtyData = [];
	}

	public abstract function getIdentifier();

	public function isDirty(string $key = null)
	{
		if($key === null)
		{
			return array_diff($this->originalData, $this->dirtyData) == array_diff($this->dirtyData, $this->originalData);
		}

		return $this->originalData[$key] === $this->dirtyData[$key];
	}

	public function getDirtyData() : array
	{
		$return = [];
		foreach($this->dirtyData as $key => $value)
		{
			if(is_object($value))
			{
				//if its a collection we need the array of identifiers
				if($value instanceof \Illuminate\Support\Collection)
				{
					$return[$key] = $value->pluck($value->first()->getIdentifier())->toArray();
				}
				else
				{
					//its not a collection so get the identifier
					$return[$key] = $value->{$value->getIdentifier()};
				}
			}
			else
			{
				$return[$key] = $value;
			}
		}

		return $return;
	}
}