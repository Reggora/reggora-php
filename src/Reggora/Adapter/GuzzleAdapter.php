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
            'http_errors' => false,
			'headers' => [
				'Authorization' => sprintf('Bearer %s', $authToken),
				'integration' => $integrationToken,
			],
		]);
	}

    private function get(String $url, Array $params = [])
    {
        return $this->client->get($url, ['query' => $params]);
    }

    private function post(String $url, $content = '')
    {
        $options = [];
        $options[is_array($content) ? 'json' : 'body'] = $content;

        return $this->client->post($url, $options);
    }

    private function delete(String $url, Array $params = [])
    {
        return $this->client->delete($url, ['query' => $params]);
    }

    private function put(String $url, $content = '')
    {
        $options = [];
        $options[is_array($content) ? 'json' : 'body'] = $content;

        return $this->client->put($url, $options);
    }

    public static function authenticateLender(String $email, String $password)
    {
    	$tempClient = new Client([
			'base_uri' => Reggora::BASE_API_URI,
		]);

        return json_decode(
            (string) $tempClient->post('lender/auth', [
                'json' => [
                    'username' => $email,
                    'password' => $password,
                ]
            ])->getBody(),
            true
        );
    }

    private static function authenticateVendor(String $email, String $password)
    {
    	$tempClient = new Client([
			'base_uri' => Reggora::BASE_API_URI,
		]);

		return json_decode(
            (string) $tempClient->post('vendor/auth', [
                'json' => [
                    'username' => $email,
                    'password' => $password,
                ]
            ])->getBody(),
            true
        );
    }

    public function __call($method, $arguments)
    {
    	if(!method_exists($this, $method)) {
    		return null; //todo: throw error
    	}

        $response = call_user_func_array(array($this, $method), $arguments);
    	if($response->getStatusCode() !== 200)
    	{
    		//todo: save error
    	}

    	return json_decode(
    		(string) $response->getBody(),
    		true
    	)['data'];
    }
}