<?php
namespace Reggora\Entity\Vendor;

use Psr\Http\Message\ResponseInterface;
use Reggora\Vendor;
use Reggora\Entity\AbstractEntity;

use Illuminate\Support\Collection;

/**
 * @property mixed id
 */
final class Conversation extends AbstractEntity {

    /**@var array*/
    private $expectedData = [
        'id', 'vendor_users', 'lender_users', 'messages',
    ];

    public function find(string $id) {
		$json = Vendor::getInstance()->getAdapter()->get(sprintf('vendor/conversation/%s', $id))['conversation'];

		if(!empty($json) && isset($json['id']))
		{
			return new self($json);
		}
		
		return null;
    }

    public function sendMessage(array $parameters) {
        return Vendor::getInstance()->getAdapter()->put(sprintf('vendor/conversation/%s', $id), $parameters);
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