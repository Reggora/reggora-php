<?php
namespace Reggora\Adapter;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Psr7\Response;

use Reggora\Reggora;

class GuzzleAdapter {

	/**@var ClientInterface */
	protected $client;

	public function __construct(String $authToken, String $integrationToken)
	{
		$this->client = new Client([
			'base_uri' => Reggora::BASE_API_URI,
			'headers' => [
				'Authorization' => sprintf('Bearer %s', $token),
				'integration' => $integrationToken,
			],
		]);
	}

    public function get(String $url, Array $params = []) : String
    { //todo: handle errors
        return (string) $this->client->get($url, ['query' => $params])->getBody();
    }

    public function post(String $url, $content = '') : String
    {//todo: handle errors
        $options = [];
        $options[is_array($content) ? 'json' : 'body'] = $content;

        return (string) $this->client->post($url, $options)->getBody();
    }
}