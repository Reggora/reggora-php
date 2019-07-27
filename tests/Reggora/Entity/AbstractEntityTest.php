<?php

namespace Test\Reggora\Entity;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Reggora\Entity\AbstractEntity;

/**
 * Class AbstractEntityTest.
 *
 * @author Lynn Digital LLC <sales@lynndigital.com)
 * @copyright 2019 Reggora, Inc
 * @license https://opensource.org/licenses/MIT The MIT license.
 *
 * @covers \Reggora\Entity\AbstractEntity
 */
class AbstractEntityTest extends TestCase
{
    /**
     * @var AbstractEntity $abstractEntity An instance of "AbstractEntity" to test.
     */
    private $abstractEntity;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        /** @todo Maybe check arguments of this constructor. */
        $this->abstractEntity = $this->getMockBuilder(AbstractEntity::class)
            ->setConstructorArgs([["a", "strings", "array"]])
            ->getMockForAbstractClass();
    }

    /**
     * @covers \Reggora\Entity\AbstractEntity::__construct
     */
    public function testConstruct(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }

    /**
     * @covers \Reggora\Entity\AbstractEntity::__get
     */
    public function testGet(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }

    /**
     * @covers \Reggora\Entity\AbstractEntity::__set
     */
    public function testSet(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }

    /**
     * @covers \Reggora\Entity\AbstractEntity::createFromArray
     */
    public function testCreateFromArray(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }

    /**
     * @covers \Reggora\Entity\AbstractEntity::clean
     */
    public function testClean(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }

    /**
     * @covers \Reggora\Entity\AbstractEntity::getIdentifier
     */
    public function testGetIdentifier(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }
}
