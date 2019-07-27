<?php
namespace Reggora\Entity;

use Illuminate\Support\Collection;

final class EntityRelationship {

	protected $adapterParentClass;

	protected $routeSlug;

	protected $entities;

	public function __construct(String $adapterParentClass, String $routeSlug, Array $entities)
	{
		$this->adapterParentClass = $adapterParentClass;
		$this->routeSlug = $routeSlug;
		$this->entities = $entities;
	}

	public function collection()
	{
		return new Collection($entities);
	}
}