<?php
namespace Reggora\Entity\Lender;

use Reggora\Lender;
use Reggora\Entity\AbstractEntity;

use Illuminate\Support\Collection;

final class Product extends AbstractEntity {

	/**@var array*/
	protected $expectedData = [
		'id', 'product_name', 'amount', 'inspection_type', 'requested_forms', 'geographic_pricing',
	];

	public function all()
	{
		$products = Lender::getInstance()->getAdapter()->get('lender/products');

		$collection = [];
		foreach($products['products'] as $key => $data)
		{
			$collection[] = new Product($data);
		}

		return new Collection($collection);
	}

	public static function find(string $id)
	{
		$json = Lender::getInstance()->getAdapter()->get(sprintf('lender/product/%s', $id))['product'];
		
		if(!empty($json) && isset($json['id']))
		{
			return new Product($json);
		}
		
		return null;
	}

	public static function create(array $parameters)
	{
		$product = Lender::getInstance()->getAdapter()->post('lender/product', $parameters);
		return self::find($product);
	}

	public function delete()
	{
		return Lender::getInstance()->getAdapter()->delete(sprintf('lender/product/%s', $this->id));
	}

	public function save()
	{
		Lender::getInstance()->getAdapter()->put(sprintf('lender/product/%s', $this->id), $this->getDirtyData());
		$this->clean();
	}

	public function getIdentifier()
	{
		return 'id';
	}
}