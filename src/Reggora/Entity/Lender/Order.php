<?php
namespace Reggora\Entity\Lender;

use Reggora\Lender;
use Reggora\Entity\AbstractEntity;

use Illuminate\Support\Collection;

/**
 * @property mixed id
 */
final class Order extends AbstractEntity {

    /**@var Vendor*/
	public $accepted_vendor;

	/**@var Collection*/
	public $requested_vendors;

	/**@var EntityRelationship*/
	public $submissions;

	/**@var EntityRelationship*/
	public $products;

	/**@var array*/
	protected $expectedData = [
		'id', 'status', 'priority', 'due_date', 'inspection_date', 'accepted_vendor', 'created', 'allocation_mode', 'requested_vendors', 'inspection_complete', 'products', 'loan_file',
	];

    /**
     * Order constructor.
     * @param array $data
     */
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
			$this->products = new EntityRelationship(Lender::class, 'product', $data['products']);
		}
	}

    /**
     * @param int $offset
     * @param int $limit
     * @param string $ordering
     * @param null $loanOfficer
     * @param array $filters
     * @return Collection
     */
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

    /**
     * @param string $id
     * @return Order|null
     */
    public static function find(string $id)
	{
		$json = Lender::getInstance()->getAdapter()->get(sprintf('lender/order/%s', $id));

		if(!empty($json) && isset($json['id']))
		{
			return new Order($json);
		}
		
		return null;
	}

    /**
     * @param array $parameters
     * @return Order|null
     */
    public static function create(array $parameters)
	{
		$order = Lender::getInstance()->getAdapter()->post('lender/order/create', $parameters);
		return self::find($order);
	}

    /**
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function cancel()
	{
		return Lender::getInstance()->getAdapter()->delete(sprintf('lender/order/%s', $this->id));
	}

    /**
     * Save an order
     */
    public function save()
	{
		Lender::getInstance()->getAdapter()->put(sprintf('lender/order/%s', $this->id), $this->getDirtyData([
			'products' => $this->products->collection()->pluck('id')->toArray(),
		]));
		$this->clean();

		$this->submissions = null; //reset
	}

    /**
     * @return mixed|string
     */
    public function getIdentifier()
	{
		return 'id';
	}

    /**
     * @param array $params
     * @return EntityRelationship
     */
    public function submissions(array $params = [])
	{
		if($this->submissions === null)
		{
			$entities = Lender::getInstance()->getAdapter()->get(sprintf('lender/order-submissions/%s', $this->id, $params));
			$entities = is_array($entities) ? $entities : [];

			return $this->submissions = new EntityRelationship(Lender::class, 'order-submission', $entities);
		}
		else
		{
			return $this->submissions;
		}
	}

    /**
     * @param array $params
     * @return EntityRelationship
     */
    public function products(array $params = [])
	{
		return $this->products;
	}
}