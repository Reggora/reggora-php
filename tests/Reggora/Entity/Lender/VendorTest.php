<?php

namespace Test\Reggora\Entity\Lender;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Reggora\Entity\Lender\Vendor;

/**
 * Class VendorTest.
 *
 * @author Lynn Digital LLC <sales@lynndigital.com)
 * @copyright 2019 Reggora, Inc
 * @license https://opensource.org/licenses/MIT The MIT license.
 *
 * @covers \Reggora\Entity\Lender\Vendor
 */
final class VendorTest extends TestCase
{
    /**
     * @covers \Reggora\Entity\Lender\Vendor::all
     */
    public function testAll(): void
    {
        $all = Vendor::all();
        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $all);
    }

    /**
     * @covers \Reggora\Entity\Lender\Vendor::find
     */
    public function testFind(): void
    {
        $vendor = Vendor::all()->first();
        if($vendor !== null)
        {
            $foundVendor = Vendor::find($vendor->id);
            $this->assertNotNull($foundVendor->id);
        }
    }

    /**
     * @covers \Reggora\Entity\Lender\Vendor::findByBranch
     */
    public function testFindByBranch(): void
    {

    }

    /**
     * @covers \Reggora\Entity\Lender\Vendor::findByZone
     */
    public function testFindByZone(): void
    {

    }

    /**
     * @covers \Reggora\Entity\Lender\Vendor::invite
     */
    public function testInvite(): void
    {

    }

    /**
     * @covers \Reggora\Entity\Lender\Vendor::delete
     */
    public function testDelete(): void
    {

    }

    /**
     * @covers \Reggora\Entity\Lender\Vendor::save
     */
    public function testSave(): void
    {

    }
}
