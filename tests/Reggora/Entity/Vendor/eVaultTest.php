<?php

namespace Test\Reggora\Entity\Vendor;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Reggora\Entity\Vendor\eVault;

/**
 * Class eVaultTest.
 *
 * @author Lynn Digital LLC <sales@lynndigital.com)
 * @copyright 2019 Reggora, Inc
 * @license https://opensource.org/licenses/MIT The MIT license.
 *
 * @covers \Reggora\Entity\Vendor\eVault
 */
class eVaultTest extends TestCase
{
    /**
     * @var eVault $eVault An instance of "eVault" to test.
     */
    private $eVault;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        /** @todo Maybe add some arguments to this constructor */
        $this->eVault = new eVault();
    }

    /**
     * @covers \Reggora\Entity\Vendor\eVault::find
     */
    public function testFind(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }

    /**
     * @covers \Reggora\Entity\Vendor\eVault::getDocument
     */
    public function testGetDocument(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }

    /**
     * @covers \Reggora\Entity\Vendor\eVault::uploadDocument
     */
    public function testUploadDocument(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }

    /**
     * @covers \Reggora\Entity\Vendor\eVault::deleteDocument
     */
    public function testDeleteDocument(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }

    /**
     * @covers \Reggora\Entity\Vendor\eVault::getIdentifier
     */
    public function testGetIdentifier(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }
}
