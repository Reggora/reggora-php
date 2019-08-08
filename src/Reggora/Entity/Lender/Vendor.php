<?php
namespace Reggora\Entity\Lender;

use Reggora\Lender;
use Reggora\Entity\AbstractEntity;

use Illuminate\Support\Collection;

final class Vendor extends AbstractEntity {

	/**@var array*/
	public $expectedData = [
		'id', 'firm_name', 'email', 'phone', 'accepting_jobs', 'lender_coverage',
	];

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
		$json = Lender::getInstance()->getAdapter()->get(sprintf('lender/vendor/%s', $id));

		if(!empty($json) && isset($json['id']))
		{
			return new Vendor($json);
		}
		
		return null;
	}

	public static function findByBranch(string $branch_id = null)
	{
		$vendors = Lender::getInstance()->getAdapter()->get('lender/vendor/branch', [
			'branch_id' => $branch_id,
		]);
		
		foreach($vendors['vendors'] as $key => $data)
		{
			$vendors[$key] = new Vendor($data);
		}

		return new Collection($vendors);
	}

	public static function findByZone(array $zones = [])
	{
		$vendors = Lender::getInstance()->getAdapter()->get('lender/vendor/by_zone', [
			'zones' => $zones,
		]);
		
		foreach($vendors['vendors'] as $key => $data)
		{
			$vendors[$key] = new Vendor($data);
		}

		return new Collection($vendors);
	}

	public static function invite(array $parameters)
	{
		$vendor = Lender::getInstance()->getAdapter()->post('lender/vendor', $parameters);
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