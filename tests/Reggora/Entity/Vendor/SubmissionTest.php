<?php

namespace Test\Reggora\Entity\Vendor;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Reggora\Entity\Vendor\Submission;
use Reggora\Entity\Vendor\Order;

/**
 * Class SubmissionTest.
 *
 * @author Lynn Digital LLC <sales@lynndigital.com)
 * @copyright 2019 Reggora, Inc
 * @license https://opensource.org/licenses/MIT The MIT license.
 *
 * @covers \Reggora\Entity\Vendor\Submission
 */
class SubmissionTest extends TestCase
{
    /**
     * @var Submission $submission An instance of "Submission" to test.
     */
    private $submission;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        /** @todo Maybe check arguments of this constructor. */
        $this->submission = new Submission(["a", "strings", "array"], $this->createMock(Order::class));
    }

    /**
     * @covers \Reggora\Entity\Vendor\Submission::__construct
     */
    public function testConstruct(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }

    /**
     * @covers \Reggora\Entity\Vendor\Submission::download
     */
    public function testDownload(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }

    /**
     * @covers \Reggora\Entity\Vendor\Submission::getIdentifier
     */
    public function testGetIdentifier(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }
}
