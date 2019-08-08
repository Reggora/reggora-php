<?php
namespace Reggora\Entity\Lender;

use Psr\Http\Message\ResponseInterface;
use Reggora\Lender;
use Reggora\Entity\AbstractEntity;

use Illuminate\Support\Collection;

/**
 * @property mixed id
 */
final class User extends AbstractEntity {

    /**@var Collection|null*/
    public $matched_users;

    /**@var array*/
    public $expectedData = [
        'id', 'email', 'phone_number', 'first_name', 'last_name', 'created', 'role',
    ];

    public function __construct(array $data)
    {
        parent::__construct($data);

        if(isset($data['matched_users']) && is_array($data['matched_users']))
        {
            $users = [];
            foreach($data['matched_users'] as $user)
            {
                $users[] = new User($user);
            }

            $this->matched_users = new Collection($users);
        }
    }

    /**
     * Find a user by it's string id
     *
     * @param string $id
     * @return User|null
     */
    public static function find(string $id)
	{
		$json = Lender::getInstance()->getAdapter()->get(sprintf('lender/user/%s', $id));

		if(!empty($json) && isset($json['id']))
		{
			return new User($json);
		}
		
		return null;
	}

    /**
     * Invite a user
     *
     * @param array $parameters
     * @return string|null
     */
    public static function invite(array $parameters)
	{
		return Lender::getInstance()->getAdapter()->post('lender/users', $parameters);
	}

    /**
     * Delete a user
     *
     * @return ResponseInterface
     */
    public function delete()
	{
		return Lender::getInstance()->getAdapter()->delete(sprintf('lender/user/%s', $this->id));
	}

    /**
     * Save a user
     */
    public function save()
	{
		Lender::getInstance()->getAdapter()->put(sprintf('lender/user/%s', $this->id), $this->getDirtyData());
		$this->clean();
	}

    /**
     * Get all users
     *
     * @param int $offset
     * @param int $limit
     * @param string $ordering
     * @param null $userOfficer
     * @return Collection
     */
    public function all(string $ordering = '-created', string $search = null)
	{
		$users = Lender::getInstance()->getAdapter()->get('lender/users', [
			'ordering' => $ordering,
            'search' => $search,
		]);

		foreach($users as $key => $data)
		{
			$users[$key] = new self($data);
		}

		return new Collection($users);
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