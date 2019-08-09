<?php
namespace Reggora\Helpers;

final class LenderHelper {

	public static function generateRandomLoan() {
		return \Reggora\Entity\Lender\Loan::create([
            'loan_number' =>  uniqid(),
            'appraisal_type' =>  'refinance',
            'subject_property_address' =>  '695 Atlantic St',
            'subject_property_zip' =>  '02134',
            'subject_property_city' =>  'Boston',
            'subject_property_state' =>  'MA',
            'due_date' =>  date('Y-m-d', strtotime('+30 days')) . 'T10:10:46Z', //dynamic date so test doesnt fail in the future
            'officer' =>  uniqid(),
            'electronic_consent' =>  false
        ]);
	}

	public static function generateRandomProduct() {
		return \Reggora\Entity\Lender\Product::create([
			'product_name' => 'My Sample Product ' . uniqid(),
			'amount' => 5000,
			'inspection_type' => 'interior',
		]);
	}
}