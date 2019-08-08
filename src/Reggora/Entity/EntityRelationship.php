<?php
namespace Reggora\Entity;

use Illuminate\Support\Collection;

final class EntityRelationship {

	/**@var array*/
	protected $entities;

    /**
     * EntityRelationship constructor.
     * @param String $adapterParentClass
     * @param String $routeSlug
     * @param array $entities
     */
    public function __construct(String $adapterParentClass, String $routeSlug, Array $entities)
	{
		$this->adapterParentClass = $adapterParentClass;
		$this->routeSlug = $routeSlug;
		$this->entities = $entities;
	}

    /**
     * Get a collection of the entities
     *
     * @return Collection
     */
    public function collection()
	{
		return new Collection($this->entities);
	}
}