<?php

namespace Test\Reggora\Entity\Vendor;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Reggora\Entity\Vendor\Conversation;

/**
 * Class ConversationTest.
 *
 * @author Lynn Digital LLC <sales@lynndigital.com)
 * @copyright 2019 Reggora, Inc
 * @license https://opensource.org/licenses/MIT The MIT license.
 *
 * @covers \Reggora\Entity\Vendor\Conversation
 */
class ConversationTest extends TestCase
{
    /**
     * @var Conversation $conversation An instance of "Conversation" to test.
     */
    private $conversation;

    /**
     * {@inheritdoc}
     */
    protected function setUp(): void
    {
        /** @todo Maybe add some arguments to this constructor */
        $this->conversation = new Conversation();
    }

    /**
     * @covers \Reggora\Entity\Vendor\Conversation::find
     */
    public function testFind(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }

    /**
     * @covers \Reggora\Entity\Vendor\Conversation::sendMessage
     */
    public function testSendMessage(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }

    /**
     * @covers \Reggora\Entity\Vendor\Conversation::getIdentifier
     */
    public function testGetIdentifier(): void
    {
        /** @todo Complete this unit test method. */
        $this->markTestIncomplete();
    }
}
