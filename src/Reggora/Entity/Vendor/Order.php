<?php
namespace Reggora\Entity\Vendor;

use Reggora\Vendor;
use Reggora\Entity\AbstractEntity;

use Illuminate\Support\Collection;

final class Order extends AbstractEntity {

	/**@var array*/
	private $expectedData = [
		'id', 'status', 'priority', 'due_date', 'inspection_date', 'accepted_vendor', 'created', 'allocation_mode', 'requested_vendors', 'inspection_complete', 'products', 'loan_file'
	];

	public $submissionsRelationship;

	public function __construct(array $data)
	{
		parent::__construct($data);

		$submissions = [];
		foreach($data['submissions'] as $submission)
		{
			$submissions[] = new Submission($submission);
		}

		$this->submissionsRelationship = new Collection($submissions);
	}

	public static function find(string $id)
	{
		$json = Vendor::getInstance()->getAdapter()->get(sprintf('vendor/order/%s', $id));

		if(!empty($json) && isset($json['id']))
		{
			return new Loan($json);
		}
		
		return null;
	}

    public static function all(int $offset = 0, int $limit = 0, string $status = null)
	{
		$orders = Vendor::getInstance()->getAdapter()->get('vendor/orders', [
			'offset' => $offset,
			'limit' => $limit,
			'status' => $status,
		]);

		foreach($orders as $key => $data)
		{
			$orders[$key] = new Order($data);
		}

		return new Collection($orders);
	}

	public function accept()
	{
		$order = Vendor::getInstance()->getAdapter()->get(sprintf('vendor/order/%s/accept', $this->id));
		return self::find($order);
	}

	public function counter(array $params)
	{
		$order = Vendor::getInstance()->getAdapter()->put(sprintf('vendor/order/%s/counter', $id), $params);
		return self::find($order);
	}

	public function deny(array $params)
	{
		$order = Vendor::getInstance()->getAdapter()->put(sprintf('vendor/order/%s/deny', $id), $params);
		return self::find($order);
	}

	public function setInspectionDate(array $params)
	{
		$order = Vendor::getInstance()->getAdapter()->put(sprintf('vendor/order/%s/set_inspection', $id), $params);
		return self::find($order);
	}

	public function completeInspection(array $params)
	{
		$order = Vendor::getInstance()->getAdapter()->put(sprintf('vendor/order/%s/complete_inspection', $id), $params);
		return self::find($order);
	}

	public function cancel(array $params)
	{
		$order = Vendor::getInstance()->getAdapter()->delete(sprintf('vendor/order/%s/complete_inspection', $id), $params);
		return self::find($order);
	}

	public function submissions()
	{
		return $this->submissionsRelationship;
	}

	public function uploadSubmission(array $params)
	{
		return Vendor::getInstance()->getAdapter()->put(sprintf('vendor/order/%s/set_inspection', $id), $params);
	}

	public function getIdentifier()
	{
		return 'id';
	}
}