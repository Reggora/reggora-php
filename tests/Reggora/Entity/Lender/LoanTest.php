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
     * @covers \Reggora\Entity\Lender\Loan::find
     */
    public function testFind(): void
    {
        $loan = Loan::create([
            'number' =>  '5b3bbfdb4348380ddc56cd12',
            'appraisal_type' =>  'refinance',
            'subject_property_address' =>  '695 Atlantic St',
            'subject_property_zip' =>  '02134',
            'subject_property_city' =>  'Boston',
            'subject_property_state' =>  'MA',
            'due_date' =>  date('Y-m-d', strtotime('+30 days')) . 'T10:10:46Z', //dynamic date so test doesnt fail in the future
            'officer' =>  '5b3bbfdb4348380ddc56cd12',
            'electronic_consent' =>  false
        ]);

        $this->assertNotNull($loan);
        $this->assertNotNull($loan->id);
        $this->assertNotNull(Loan::find($loan->id));
    }

    /**
     * @covers \Reggora\Entity\Lender\Loan::create
     */
    public function testCreate(): void
    {
        $loan = Loan::create([
            'number' =>  '5b3bbfdb4348380ddc56cd12',
            'appraisal_type' =>  'refinance',
            'subject_property_address' =>  '695 Atlantic St',
            'subject_property_zip' =>  '02134',
            'subject_property_city' =>  'Boston',
            'subject_property_state' =>  'MA',
            'due_date' =>  date('Y-m-d', strtotime('+30 days')) . 'T10:10:46Z', //dynamic date so test doesnt fail in the future
            'officer' =>  '5b3bbfdb4348380ddc56cd12',
            'electronic_consent' =>  false
        ]);

        $this->assertNotNull($loan);
        $this->assertNotNull($loan->id);
    }

    /**
     * @covers \Reggora\Entity\Lender\Loan::delete
     */
    public function testDelete(): void
    {
        $loan = Loan::create([
            'number' =>  '5b3bbfdb4348380ddc56cd12',
            'appraisal_type' =>  'refinance',
            'subject_property_address' =>  '695 Atlantic St',
            'subject_property_zip' =>  '02134',
            'subject_property_city' =>  'Boston',
            'subject_property_state' =>  'MA',
            'due_date' =>  date('Y-m-d', strtotime('+30 days')) . 'T10:10:46Z', //dynamic date so test doesnt fail in the future
            'officer' =>  '5b3bbfdb4348380ddc56cd12',
            'electronic_consent' =>  false
        ]);

        $this->assertNotNull($loan);
        $loan->delete();

        $this->assertNull(Loan::find($loan->id));
    }

    /**
     * @covers \Reggora\Entity\Lender\Loan::save
     */
    public function testSave(): void
    {
        $loan = Loan::create([
            'number' =>  '5b3bbfdb4348380ddc56cd12',
            'appraisal_type' =>  'refinance',
            'subject_property_address' =>  '695 Atlantic St',
            'subject_property_zip' =>  '02134',
            'subject_property_city' =>  'Boston',
            'subject_property_state' =>  'MA',
            'due_date' =>  date('Y-m-d', strtotime('+30 days')) . 'T10:10:46Z', //dynamic date so test doesnt fail in the future
            'officer' =>  '5b3bbfdb4348380ddc56cd12',
            'electronic_consent' =>  false
        ]);

        $this->assertNotNull($loan);

        $loan->due_date = date('Y-m-d', strtotime('+60 days')) . 'T10:10:46Z'; //different date
        $loan->save();

        $saved = Loan::find($loan->id);
        $this->assertNotNull($saved);
        $this->assertNotEquals($loan->due_date, $saved->due_date);
    }

    /**
     * @covers \Reggora\Entity\Lender\Loan::all
     */
    public function testAll(): void
    {
        $this->assertInstanceOf(\Illuminate\Support\Collection::class, Loan::all());
    }
}
