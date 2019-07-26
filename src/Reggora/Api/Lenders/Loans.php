<?php
namespace Reggora\Api\Lenders;

use Reggora\Adapter\GuzzleAdapter;

use Reggora\Api\AbstractApi;

class Loans extends AbstractApi {

	public function __construct(GuzzleAdapter $adapter)
	{
		parent::__construct($adapter);
	}

	public function getAll(int $offset = 0, int $limit = 0, string $ordering = '-created', $loanOfficer = null)
	{
		return $this->adapter->get('lender/loans', [
			'offset' => $offset,
			'limit' => $limit,
			'ordering' => $ordering,
			'loan_officer' => $loanOfficer,
		]);
	}

	public function getById(string $id)
	{
		return $this->adapter->get(sprintf('lender/loan/%s', $id));
	}

	public function delete(string $id)
	{
		return $this->adapter->delete(sprintf('lender/loan/%s', $id));
	}

	public function create(array $parameters)
	{
		return $this->adapter->post('lender/loan/create', $parameters);
	}

	public function edit(string $id, array $parameters)
	{
		return $this->adapter->put(sprintf('lender/loan/%s', $id), $parameters);
	}
}