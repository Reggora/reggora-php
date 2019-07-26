<?php

namespace Test\Reggora\Entity\Lender;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Reggora\Entity\Lender\Loan;

/**
 * Class LoanTest.
 *
 * @author Lynn Digital LLC <sales@lynndigital.com)
 * @copyright 2019 Reggora, Inc
 * @license https://opensource.org/licenses/MIT The MIT license.
 *
 * @covers \Reggora\Entity\Lender\Loan
 */
class LoanTest extends TestCase
{
    /**
     * @var Loan $loan An instance of "Loan" to test.
     */
    private $loan;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        /** @todo Maybe add some arguments to this constructor */
        $this->loan = new Loan();
    }

    /**
     * @covers \Reggora\Entity\Lender\Loan::find
     */
    public function testFind(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }

    /**
     * @covers \Reggora\Entity\Lender\Loan::create
     */
    public function testCreate(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }

    /**
     * @covers \Reggora\Entity\Lender\Loan::delete
     */
    public function testDelete(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }

    /**
     * @covers \Reggora\Entity\Lender\Loan::save
     */
    public function testSave(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }

    /**
     * @covers \Reggora\Entity\Lender\Loan::all
     */
    public function testAll(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }
}
