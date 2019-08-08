<?php

namespace Test\Reggora\Entity\Lender;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Reggora\Entity\Lender\User;

/**
 * Class UserTest.
 *
 * @author Lynn Digital LLC <sales@lynndigital.com)
 * @copyright 2019 Reggora, Inc
 * @license https://opensource.org/licenses/MIT The MIT license.
 *
 * @covers \Reggora\Entity\Lender\User
 */
final class UserTest extends TestCase
{
    /**
     * @covers \Reggora\Entity\Lender\User::find
     */
    public function testFind(): void
    {
        $user = User::create([
            'email' => 'jake@lynndigital.com',
            'role' => 'admin',
            'firstname' => 'Jake',
            'lastname' => 'Casto',
            'phone_number' => '+13367126489',
        ]);

        $foundUser = User::find($user->id);

        $this->assertNotNull($foundUser);
        $this->assertEquals($foundUser->id, $user->id);
    }

    /**
     * @covers \Reggora\Entity\Lender\User::invite
     */
    public function testInvite(): void
    {
        $user = User::invite([
            'email' => 'jake@lynndigital.com',
            'role' => 'admin',
            'firstname' => 'Jake',
            'lastname' => 'Casto',
            'phone_number' => '+13367126489',
        ]);

        $this->assertEquals($user, 'Your invite has been sent');
    }

    /**
     * @covers \Reggora\Entity\Lender\User::delete
     */
    public function testDelete(): void
    {
        $user = User::create([
            'email' => 'jake@lynndigital.com',
            'role' => 'admin',
            'firstname' => 'Jake',
            'lastname' => 'Casto',
            'phone_number' => '+13367126489',
        ]);

        $this->assertNotNull($user);
        $user->delete();
        $this->assertNull(User::find($user->id));
    }

    /**
     * @covers \Reggora\Entity\Lender\User::save
     */
    public function testSave(): void
    {
        $user = User::create([
            'email' => 'jake@lynndigital.com',
            'role' => 'admin',
            'firstname' => 'Jake',
            'lastname' => 'Casto',
            'phone_number' => '+13367126489',
        ]);

        $this->assertNotNull($user);

        $user->phone_number = '+13368148746';
        $user->save();

        $savedUser = User::find($user->id);

        $this->assertNotNull($savedUser);
        $this->assertNotEquals($savedUser->phone_number, $user->phone_number);
    }

    /**
     * @covers \Reggora\Entity\Lender\User::all
     */
    public function testAll(): void
    {
        $all = User::all();

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $all);
        $this->assertNotEmpty($all->toArray());
    }
}
