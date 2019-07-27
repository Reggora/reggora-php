<?php

namespace Test\Reggora\Entity\Lender;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Reggora\Entity\Lender\Order;

/**
 * Class OrderTest.
 *
 * @author Lynn Digital LLC <sales@lynndigital.com)
 * @copyright 2019 Reggora, Inc
 * @license https://opensource.org/licenses/MIT The MIT license.
 *
 * @covers \Reggora\Entity\Lender\Order
 */
class OrderTest extends TestCase
{
    /**
     * @var Order $order An instance of "Order" to test.
     */
    private $order;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        /** @todo Maybe check arguments of this constructor. */
        $this->order = new Order(["a", "strings", "array"]);
    }

    /**
     * @covers \Reggora\Entity\Lender\Order::__construct
     */
    public function testConstruct(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }

    /**
     * @covers \Reggora\Entity\Lender\Order::find
     */
    public function testFind(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }

    /**
     * @covers \Reggora\Entity\Lender\Order::create
     */
    public function testCreate(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }

    /**
     * @covers \Reggora\Entity\Lender\Order::delete
     */
    public function testDelete(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }

    /**
     * @covers \Reggora\Entity\Lender\Order::save
     */
    public function testSave(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }

    /**
     * @covers \Reggora\Entity\Lender\Order::getIdentifier
     */
    public function testGetIdentifier(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }
}
