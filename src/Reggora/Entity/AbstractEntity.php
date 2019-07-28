<?php
namespace Reggora\Entity;

use ReflectionException;

abstract class AbstractEntity {

    /**@var array*/
	private $originalData;

	/**@var array*/
	private $dirtyData = [];

    /**
     * AbstractEntity constructor.
     * @param array $data
     */
    public function __construct(array $data)
	{
		$this->originalData = $data;
	}

    /**
     * @param string $key
     * @return mixed
     */
    public function __get(string $key)
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

    /**
     * @param $key
     * @param $value
     */
    public function __set($key, $value)
	{
		$this->dirtyData[$key] = $value;
	}

    /**
     * @param array $entities
     * @return AbstractEntity
     */
    public static function createFromArray(array $entities)
	{
		foreach($entities as $entity)
		{
			return new static($entity);
		}
	}

    /**
     * Clean the entity
     */
    public function clean()
	{
		$this->originalData = array_merge($this->originalData, $this->dirtyData);
		$this->dirtyData = [];
	}

    /**
     * Check if the entity contains unsaved values
     *
     * @param string|null $key
     * @return bool
     */
    public function isDirty(string $key = null)
	{
		if($key === null)
		{
			return array_diff($this->originalData, $this->dirtyData) == array_diff($this->dirtyData, $this->originalData);
		}

		return $this->originalData[$key] === $this->dirtyData[$key];
	}

    /**
     * Get POST safe unsaved data
     *
     * @return array
     */
    public function getDirtyData(array $replace = []) : array
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

		return array_replace($return, $replace);
	}

    /**
     * Get the original value for a key or all of an entities original data
     *
     * @param string|null $key
     * @return array|mixed
     */
    public function getOriginal(string $key = null)
	{
		return $key === null ? $this->originalData : $this->originalData[$key];
	}

    /**
     * Get the identifier for the model e.g `id`
     *
     * @return mixed
     */
    public abstract function getIdentifier();

    /**
     * Reset a model
     *
     * @throws ReflectionException
     */
    public function reset()
	{
        $blankInstance = new static;
        $reflBlankInstance = new \ReflectionClass($blankInstance);
        foreach ($reflBlankInstance->getProperties() as $prop) 
        {
        	if($prop->name === 'originalData') //dont reset originalData
        	{
        		continue;
        	}

            $prop->setAccessible(true);
            $this->{$prop->name} = $prop->getValue($blankInstance);
        }
	}
}