<?php
namespace Reggora\Entity\Lender;

use Reggora\Lender;
use Reggora\Entity\AbstractEntity;

use Illuminate\Support\Collection;

final class Vendor extends AbstractEntity {

	public function all()
	{
		$vendors = Lender::getInstance()->getAdapter()->get('lender/vendor');
		foreach($vendors['vendors'] as $key => $data)
		{
			$vendors[$key] = new Vendor($data);
		}

		return new Collection($vendors);
	}

	public static function find(string $id)
	{
		return new Vendor(Lender::getInstance()->getAdapter()->get(sprintf('lender/vendor/%s', $id)));
	}

	public static function create(array $parameters)
	{
		$vendor = Lender::getInstance()->getAdapter()->post('lender/vendor/create', $parameters);
		return self::find($vendor);
	}

	public function delete()
	{
		return Lender::getInstance()->getAdapter()->delete(sprintf('lender/vendor/%s', $this->id));
	}

	public function save()
	{
		Lender::getInstance()->getAdapter()->put(sprintf('lender/vendor/%s', $id), $this->getDirtyData());
		$this->clean();
	}

	public function getIdentifier()
	{
		return 'id';
	}
}