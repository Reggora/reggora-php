<?php
namespace Reggora\Entity\Lender;

use Reggora\Lender;
use Reggora\Entity\AbstractEntity;

use Illuminate\Support\Collection;

final class Order extends AbstractEntity {

	public $accepted_vendor;

	public $requested_vendors;

	public $submissions;

	public function __construct(array $data)
	{
		parent::__construct($data);

		if(isset($data['accepted_vendor']) && is_array($data['accepted_vendor']))
		{
			$this->accepted_vendor = new Vendor($data['accepted_vendor']);
		}

		if(isset($data['requested_vendors']) && is_array($data['requested_vendors']))
		{
			$requested_vendors = [];
			foreach($data['requested_vendors'] as $vendor)
			{
				$requested_vendors[] = new Vendor($vendor);
			}

			$this->requested_vendors = new Collection($requested_vendors);
		}

		if(isset($data['products']) && is_array($data['products']))
		{
			$products = [];
			foreach($data['products'] as $product)
			{
				$products[] = new Product($product);
			}

			$this->products = new Collection($products);
		}

		//todo: `loan_files` ?
	}

	public static function all(int $offset = 0, int $limit = 0, string $ordering = '-created', $loanOfficer = null, $filters = [])
	{
		$orders = Lender::getInstance()->getAdapter()->get('lender/orders', [
			'offset' => $offset,
			'limit' => $limit,
			'ordering' => $ordering,
			'loan_officer' => $loanOfficer,
			'filters' => implode(',', $filters),
		]);

		foreach($orders as $key => $data)
		{
			$orders[$key] = new Order($data);
		}

		return new Collection($orders);
	}

	public static function find(string $id)
	{
		$json = Lender::getInstance()->getAdapter()->get(sprintf('lender/order/%s', $id));

		if(!empty($json) && isset($json['id']))
		{
			return new Order($json);
		}
		
		return null;
	}

	public static function create(array $parameters)
	{
		$order = Lender::getInstance()->getAdapter()->post('lender/order/create', $parameters);
		return self::find($order);
	}

	public function cancel()
	{
		return Lender::getInstance()->getAdapter()->delete(sprintf('lender/order/%s', $this->id));
	}

	public function save()
	{
		Lender::getInstance()->getAdapter()->put(sprintf('lender/order/%s', $id), $this->getDirtyData());
		$this->clean();

		$this->submissions = null; //reset
	}

	public function getIdentifier()
	{
		return 'id';
	}

	public function submissions(array $params = [])
	{
		if($this->submissions === null)
		{
			$entities = Lender::getInstance()->getAdapter()->get(sprintf('lender/order-submissions/%s', $id, $params);
			$entities = is_array($entities) ? $entities : [];

			return $this->submissions = new EntityRelationship(Lender::class, 'order-submission', $entities);
		}
		else
		{
			return $this->submissions;
		}
	}
}