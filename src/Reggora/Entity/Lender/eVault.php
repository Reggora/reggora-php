<?php
namespace Reggora\Entity\Lender;

use Psr\Http\Message\ResponseInterface;
use Reggora\Lender;
use Reggora\Entity\AbstractEntity;

use Illuminate\Support\Collection;

/**
 * @property mixed id
 */
final class eVault extends AbstractEntity {

    /**@var array*/
    private $expectedData = [
        'id', 'documents',
    ];

    public function find(string $id) {
		$json = Lender::getInstance()->getAdapter()->get(sprintf('lender/evault/%s', $id));

		if(!empty($json) && isset($json['id']))
		{
			return new self($json);
		}
		
		return null;
    }

    public function getDocument(string $id) {
    	return Lender::getInstance()->getAdapter()->get(sprintf('lender/evault/%s/%s', $this->id, $id));
    }

    public function uploadDocument(array $parameters) {
    	return Lender::getInstance()->getAdapter()->put(sprintf('lender/evault'), array_merge(
    		$parameters, 
    		[
    			'id' => $this->id
    		]
    	));
    }

    public function uploadPS(array $parameters) {
    	return Lender::getInstance()->getAdapter()->put(sprintf('lender/order/p_and_s'), array_merge(
    		$parameters, 
    		[
    			'id' => $this->id
    		]
    	));
    }

    public function deleteDocument(string $id) {
    	return Lender::getInstance()->getAdapter()->delete(sprintf('lender/order/p_and_s'), [], [
    		'id' => $this->id,
    		'document_id' => $id,
    	]);
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