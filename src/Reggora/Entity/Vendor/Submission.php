<?php
namespace Reggora\Entity\Vendor;

use Reggora\Vendor;
use Reggora\Entity\AbstractEntity;

use Illuminate\Support\Collection;

final class Submission extends AbstractEntity {

	protected $order;

	protected $expectedData = [/** we dont validate this */];

	public function __construct(array $data, Order $order)
	{
		parent::__construct($data, $order);
	}

    public function download(string $document_type = 'pdf')
	{
		return Vendor::getInstance()->getAdapter()->get(sprintf('vendor/submission/%s/%s/%s', $this->order->id, $this->id, $document_type));
	}

	public function getIdentifier()
	{
		return 'id';
	}
}