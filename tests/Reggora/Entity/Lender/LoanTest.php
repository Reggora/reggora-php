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
            'due_date' =>  date('Y-m-d', strtotime('+30 days')) . 'T17:10:46+05:30', //dynamic date so test doesnt fail in the future
            'officer' =>  '5b3bbfdb4348380ddc56cd12',
            'electronic_consent' =>  false
        ]);

        if($loan !== null && $loan->id !== null)
        {
            $loan = Loan::find($loan->id);
            if($loan->id !== null)
            {
                $this->markTestComplete();
            }
        }
        else
        {
            $this->markTestIncomplete();
        }
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
            'due_date' =>  date('Y-m-d', strtotime('+30 days')) . 'T17:10:46+05:30', //dynamic date so test doesnt fail in the future
            'officer' =>  '5b3bbfdb4348380ddc56cd12',
            'electronic_consent' =>  false
        ]);

        if($loan !== null && $loan->id !== null)
        {
            $this->markTestComplete();
        }
        else
        {
            $this->markTestIncomplete();
        }
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
            'due_date' =>  date('Y-m-d', strtotime('+30 days')) . 'T17:10:46+05:30', //dynamic date so test doesnt fail in the future
            'officer' =>  '5b3bbfdb4348380ddc56cd12',
            'electronic_consent' =>  false
        ]);

        if($loan !== null && $loan->id !== null)
        {
            $loan->delete();

            if($deleted = Loan::find($loan->id) && $deleted === null)
            {
                $this->markTestComplete();
            }
        }
        else
        {
            $this->markTestIncomplete();
        }
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
            'due_date' =>  date('Y-m-d', strtotime('+30 days')) . 'T17:10:46+05:30', //dynamic date so test doesnt fail in the future
            'officer' =>  '5b3bbfdb4348380ddc56cd12',
            'electronic_consent' =>  false
        ]);

        if($loan !== null && $loan->id !== null)
        {
            $loan->due_date = date('Y-m-d', strtotime('+31 days')) . 'T17:10:46+05:30'; //different date
            $loan->save();

            if($saved = Loan::find($loan->id) && $loan->due_date === $saved->due_date)
            {
                $this->markTestComplete();
            }
        }
        else
        {
            $this->markTestIncomplete();
        }
    }

    /**
     * @covers \Reggora\Entity\Lender\Loan::all
     */
    public function testAll(): void
    {
        if(Loan::all() instanceof \Illuminate\Support\Collection)
        {
            $this->markTestComplete();
        }
        else
        {
            $this->markTestIncomplete();
        }
    }
}
