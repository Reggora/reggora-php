<?php

namespace Test\Reggora\Entity\Lender;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Reggora\Entity\Lender\Order;
use Reggora\Entity\Lender\Loan;
use Reggora\Entity\Lender\Product;
use Reggora\Helpers\LenderHelper;

/**
 * Class OrderTest.
 *
 * @author Lynn Digital LLC <sales@lynndigital.com)
 * @copyright 2019 Reggora, Inc
 * @license https://opensource.org/licenses/MIT The MIT license.
 *
 * @covers \Reggora\Entity\Lender\Order
 */
final class OrderTest extends TestCase
{
    /**
     * @covers \Reggora\Entity\Lender\Order::create
     */
    public function testCreate(): void
    {
        $order = Order::create([
            'allocation_type' => 'automatically',
            'loan' => LenderHelper::generateRandomLoan()->id,
            'priority' => 'Rush',
            'products' => [LenderHelper::generateRandomProduct()->id],
            'due_date' => date('Y-m-d', strtotime('+30 days')) . 'T10:10:46Z',
        ]);

        $this->assertNotNull($order);
    }

    /**
     * @covers \Reggora\Entity\Lender\Order::find
     */
    public function testFind(): void
    {
        $order = Order::create([
            'allocation_type' => 'automatically',
            'loan' => LenderHelper::generateRandomLoan()->id,
            'priority' => 'Rush',
            'products' => [LenderHelper::generateRandomProduct()->id],
            'due_date' => date('Y-m-d', strtotime('+30 days')) . 'T10:10:46Z',
        ]);

        $this->assertNotNull($order);

        $foundOrder = Order::find($order->id);

        $this->assertNotNull($foundOrder);
    }

    /**
     * @covers \Reggora\Entity\Lender\Order::cancel
     */
    public function testCancel(): void
    {
        $order = Order::create([
            'allocation_type' => 'automatically',
            'loan' => LenderHelper::generateRandomLoan()->id,
            'priority' => 'Rush',
            'products' => [LenderHelper::generateRandomProduct()->id],
            'due_date' => date('Y-m-d', strtotime('+30 days')) . 'T10:10:46Z',
        ]);

        $this->assertNotNull($order);

        $message = $order->cancel();
        $this->assertEquals($message, 'Order has been canceled.');
    }

    /**
     * @covers \Reggora\Entity\Lender\Order::save
     */
    public function testSave(): void
    {
        $order = Order::create([
            'allocation_type' => 'automatically',
            'loan' => LenderHelper::generateRandomLoan()->id,
            'priority' => 'Rush',
            'products' => [LenderHelper::generateRandomProduct()->id],
            'due_date' => date('Y-m-d', strtotime('+30 days')) . 'T10:10:46Z',
        ]);

        $this->assertNotNull($order);

        $order->due_date = date('Y-m-d', strtotime('+31 days')) . 'T10:10:46Z';
        $order->save();

        $savedOrder = Order::find($order->id);
        $this->assertNotNull($savedOrder);

        $this->assertNotEquals($order->due_date, $savedOrder->due_date);
    }

    /**
     * @covers \Reggora\Entity\Lender\Order::submissions
     */
    public function testSubmissions(): void
    {
        $order = Order::create([
            'allocation_type' => 'automatically',
            'loan' => LenderHelper::generateRandomLoan()->id,
            'priority' => 'Rush',
            'products' => [LenderHelper::generateRandomProduct()->id],
            'due_date' => date('Y-m-d', strtotime('+30 days')) . 'T10:10:46Z',
        ]);

        $this->assertNotNull($order);

        //todo...
    }

    /**
     * @covers \Reggora\Entity\Lender\Order::all
     */
    public function testAll(): void
    {
        $all = Order::all();

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $all);
        $this->assertNotEmpty($all->toArray());
    }
}
