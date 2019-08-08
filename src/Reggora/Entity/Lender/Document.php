<?php
namespace Reggora\Entity\Lender;

use Reggora\Lender;
use Reggora\Entity\AbstractEntity;

use Illuminate\Support\Collection;

final class Document extends AbstractEntity {

	/**@var array*/
	protected $expectedData = [
		
	];

	public $evault_id;

	public function __construct(array $data, string $evault_id)
	{
		parent::__construct($data);

		$this->evault_id = $evault_id;
	}

	public function all(string $evault_id)
	{
		$evault = Lender::getInstance()->getAdapter()->get(sprintf('lender/evault/%s', $evault_id));
		$documents = [];
		foreach($evault['documents'] as $document)
		{
			$documents[] = new self($evault_id, $document);
		}

		return new Collection($documents);
	}

	public static function find(string $evault_id, string $document_id)
	{
		$json = Lender::getInstance()->getAdapter()->get(sprintf('lender/evault/%s/%s', $evault_id, $document_id));

		if(!empty($json) && isset($json['id']))
		{
			return new self($evault_id, $json);
		}
		
		return null;
	}

	public static function upload(array $parameters)
	{
		$vendor = Lender::getInstance()->getAdapter()->post('lender/evault', $parameters);
		return self::find($vendor);
	}

	public function delete()
	{
		return Lender::getInstance()->getAdapter()->delete(sprintf('lender/evault', [
			'id' => $this->evault_id,
			'document_id' => $this->id,
		]));
	}

	public function getIdentifier()
	{
		return 'id';
	}
}