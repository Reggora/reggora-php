<?php
namespace Reggora\Entity\Lender;

use Psr\Http\Message\ResponseInterface;
use Reggora\Lender;
use Reggora\Entity\AbstractEntity;

use Illuminate\Support\Collection;

/**
 * @property mixed id
 */
final class Loan extends AbstractEntity {

    /**@var array*/
    protected $expectedData = [
        'id', 'loan_number', 'loan_officer', 'appraisal_type', 'due_date', 'created', 'updated', 'related_order', 
        'subject_property_address', 'subject_property_city', 'subject_property_state', 'subject_property_zip', 
        'case_number', 'loan_type',
    ];

    /**
     * Find a loan by it's string id
     *
     * @param string $id
     * @return Loan|null
     */
    public static function find(string $id)
	{
		$json = Lender::getInstance()->getAdapter()->get(sprintf('lender/loan/%s', $id))['loan'];

		if(!empty($json) && isset($json['id']))
		{
			return new Loan($json);
		}
		
		return null;
	}

    /**
     * Create a loan
     *
     * @param array $parameters
     * @return Loan|null
     */
    public static function create(array $parameters)
	{
		$loan = Lender::getInstance()->getAdapter()->post('lender/loan', $parameters);
		return self::find($loan);
	}

    /**
     * Delete a loan
     *
     * @return ResponseInterface
     */
    public function delete()
	{
		return Lender::getInstance()->getAdapter()->delete(sprintf('lender/loan/%s', $this->id));
	}

    /**
     * Save a loan
     */
    public function save()
	{
		Lender::getInstance()->getAdapter()->put(sprintf('lender/loan/%s', $this->id), $this->getDirtyData());
		$this->clean();
	}

    /**
     * Get all loans
     *
     * @param int $offset
     * @param int $limit
     * @param string $ordering
     * @param null $loanOfficer
     * @return Collection
     */
    public function all(int $offset = 0, int $limit = 0, string $ordering = '-created', $loanOfficer = null)
	{
		$loans = Lender::getInstance()->getAdapter()->get('lender/loans', [
			'offset' => $offset,
			'limit' => $limit,
			'ordering' => $ordering,
			'loan_officer' => $loanOfficer,
		]);

        $collection = [];
		foreach($loans['loans'] as $key => $data)
		{
			$collection[] = new Loan($data);
		}

		return new Collection($collection);
	}

    /**
     * Get the entity identifier
     *
     * @return mixed|string
     */
    public function getIdentifier()
	{
		return 'id';
	}
}