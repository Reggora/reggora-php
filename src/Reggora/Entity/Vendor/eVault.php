<?php
namespace Reggora\Entity\Vendor;

use Psr\Http\Message\ResponseInterface;
use Reggora\Vendor;
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
		$json = Vendor::getInstance()->getAdapter()->get(sprintf('vendor/evault/%s', $id));

		if(!empty($json) && isset($json['id']))
		{
			return new self($json);
		}
		
		return null;
    }

    public function getDocument(string $id) {
    	return Vendor::getInstance()->getAdapter()->get(sprintf('vendor/evault/%s/%s', $this->id, $id));
    }

    public function uploadDocument(array $parameters) {
    	return Vendor::getInstance()->getAdapter()->put(sprintf('vendor/evault'), array_merge(
    		$parameters, 
    		[
    			'id' => $this->id
    		]
    	));
    }

    public function deleteDocument(string $id) {
    	return Vendor::getInstance()->getAdapter()->delete(sprintf('vendor/order/p_and_s'), [], [
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