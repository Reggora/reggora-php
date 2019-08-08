<?php

namespace Test\Reggora\Entity;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Reggora\Entity\EntityRelationship;

/**
 * Class EntityRelationshipTest.
 *
 * @author Lynn Digital LLC <sales@lynndigital.com)
 * @copyright 2019 Reggora, Inc
 * @license https://opensource.org/licenses/MIT The MIT license.
 *
 * @covers \Reggora\Entity\EntityRelationship
 */
class EntityRelationshipTest extends TestCase
{
    /**
     * @var EntityRelationship $entityRelationship An instance of "EntityRelationship" to test.
     */
    private $entityRelationship;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        /** @todo Maybe check arguments of this constructor. */
        $this->entityRelationship = new EntityRelationship("a string to test", "a string to test", ["a", "strings", "array"]);
    }

    /**
     * @covers \Reggora\Entity\EntityRelationship::__construct
     */
    public function testConstruct(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }

    /**
     * @covers \Reggora\Entity\EntityRelationship::collection
     */
    public function testCollection(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }
}
