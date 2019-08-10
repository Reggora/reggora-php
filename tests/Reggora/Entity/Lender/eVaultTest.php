<?php

namespace Test\Reggora\Entity\Lender;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Reggora\Entity\Lender\eVault;
use Reggora\Entity\Lender\Order;
use Reggora\Helpers\LenderHelper;

/**
 * Class eVaultTest.
 *
 * @author Lynn Digital LLC <sales@lynndigital.com)
 * @copyright 2019 Reggora, Inc
 * @license https://opensource.org/licenses/MIT The MIT license.
 *
 * @covers \Reggora\Entity\Lender\eVault
 */
class eVaultTest extends TestCase
{
    /**
     * @covers \Reggora\Entity\Lender\eVault::find
     */
    public function testFind(): void
    {
        $order = Order::all()->first();
        if($order === null)
        {
            $order = Order::create([
                'allocation_type' => 'automatically',
                'loan' => LenderHelper::generateRandomLoan()->id,
                'priority' => 'Rush',
                'products' => [LenderHelper::generateRandomProduct()->id],
                'due_date' => date('Y-m-d', strtotime('+30 days')) . 'T10:10:46Z',
            ]);
        }

        $this->assertNotNull($order);
        $this->assertNotNull($order->evault);

        $eVault = eVault::find($order->evault);

        $this->assertNotNull($eVault);
    }

    /**
     * @covers \Reggora\Entity\Lender\eVault::getDocument
     * @depends testUploadDocument
     */
    public function testGetDocument(): void
    {
        $order = Order::all()->first();
        if($order === null)
        {
            $order = Order::create([
                'allocation_type' => 'automatically',
                'loan' => LenderHelper::generateRandomLoan()->id,
                'priority' => 'Rush',
                'products' => [LenderHelper::generateRandomProduct()->id],
                'due_date' => date('Y-m-d', strtotime('+30 days')) . 'T10:10:46Z',
            ]);
        }

        $this->assertNotNull($order);
        $this->assertNotNull($order->evault);

        $eVault = eVault::find($order->evault);
        $this->assertNotNull($eVault);

        $id = $eVault->uploadDocument([
            'file' => base64_encode(file_get_contents(__DIR__ . '/../../../../sample/sample.pdf')),
        ]);

        $this->assertNotNull($id);

        $document = $eVault->getDocument($id);
        $this->assertNotNull($document);
        $this->assertIsIterable($document);//check if array
    }

    /**
     * @covers \Reggora\Entity\Lender\eVault::uploadDocument
     */
    public function testUploadDocument(): void
    {
        $order = Order::all()->first();
        if($order === null)
        {
            $order = Order::create([
                'allocation_type' => 'automatically',
                'loan' => LenderHelper::generateRandomLoan()->id,
                'priority' => 'Rush',
                'products' => [LenderHelper::generateRandomProduct()->id],
                'due_date' => date('Y-m-d', strtotime('+30 days')) . 'T10:10:46Z',
            ]);
        }

        $this->assertNotNull($order);
        $this->assertNotNull($order->evault);

        $eVault = eVault::find($order->evault);
        $this->assertNotNull($eVault);

        $id = $eVault->uploadDocument([
            'file' => base64_encode(file_get_contents(__DIR__ . '/../../../../sample/sample.pdf')),
        ]);

        $this->assertNotNull($id);
    }

    /**
     * @covers \Reggora\Entity\Lender\eVault::uploadPS
     */
    public function testUploadPS(): void
    {
        $order = Order::all()->first();
        if($order === null)
        {
            $order = Order::create([
                'allocation_type' => 'automatically',
                'loan' => LenderHelper::generateRandomLoan()->id,
                'priority' => 'Rush',
                'products' => [LenderHelper::generateRandomProduct()->id],
                'due_date' => date('Y-m-d', strtotime('+30 days')) . 'T10:10:46Z',
            ]);
        }

        $this->assertNotNull($order);
        $this->assertNotNull($order->evault);

        $eVault = eVault::find($order->evault);
        $this->assertNotNull($eVault);

        $id = $eVault->uploadPS([
            'file' => base64_encode(file_get_contents(__DIR__ . '/../../../../sample/sample.pdf')),
            'id' => $order->id,
        ]);

        $this->assertNotNull($id);
    }

    /**
     * @covers \Reggora\Entity\Lender\eVault::deleteDocument
     */
    public function testDeleteDocument(): void
    {
        $order = Order::all()->first();
        if($order === null)
        {
            $order = Order::create([
                'allocation_type' => 'automatically',
                'loan' => LenderHelper::generateRandomLoan()->id,
                'priority' => 'Rush',
                'products' => [LenderHelper::generateRandomProduct()->id],
                'due_date' => date('Y-m-d', strtotime('+30 days')) . 'T10:10:46Z',
            ]);
        }

        $this->assertNotNull($order);
        $this->assertNotNull($order->evault);

        $eVault = eVault::find($order->evault);
        $this->assertNotNull($eVault);

        $id = $eVault->uploadDocument([
            'file' => base64_encode(file_get_contents(__DIR__ . '/../../../../sample/sample.pdf')),
        ]);

        $this->assertNotNull($id);

        $document = $eVault->getDocument($id);
        $this->assertNotNull($document);
        $this->assertIsIterable($document);//check if array

        $eVault->deleteDocument($id);

        $foundDocument = $eVault->getDocument($id);
        $this->assertNull($foundDocument);
    }
}
