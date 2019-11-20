<?php
namespace Orion\Clients;
use GuzzleHttp\Exception\ClientException;
use Yandex\Common\AbstractServiceClient;
use Yandex\Common\Exception\ForbiddenException;
use Yandex\Common\Exception\UnauthorizedException;
use Orion\Exception\PartnerRequestException;
use GuzzleHttp\Client as GuzzleClient;

class Client extends AbstractServiceClient
{
    const LISTORDER = 'ListOrder';
    const NEWORDER = 'NewOrder';
    const SHOWORDER = 'ShowOrder';
    const CONFIRMORDER = 'ConfirmOrder';

    /**
     * API domain
     *
     * @var string
     */
    protected $serviceDomain = 'optvideo.com/market/api/api.php';
    /**
     * Requested version of API
     *
     * @var string
     */
    protected $version = 'v1';
    /**
     * Application ID
     *
     * @var string
     */
    private $clientId;
    /**
     * @var string
     */
    protected $libraryName = 'orion-php-library';
    /**
     * @var array
     */
    protected $mappingOptionals = array();

    public function __construct($clientId = '', $token = '')
    {
        $this->setAccessToken($token);
        $this->setClientId($clientId);
    }
    /**
     * @param array|null $headers
     * @return ClientInterface
     */
    protected function getClient($headers = null)
    {
        if ($this->client === null) {
            $defaultOptions = [
                'base_uri' => $this->getServiceUrl(),
                'headers' => [                    
                    'Host' => $this->getServiceDomain(),
                    'User-Agent' => $this->getUserAgent(),
                    'Accept' => '*/*',
                ],
            ];
            if ($headers && is_array($headers)) {
                $defaultOptions["headers"] += $headers;
            }
            if ($this->getProxy()) {
                $defaultOptions['proxy'] = $this->getProxy();
            }
            if ($this->getDebug()) {
                $defaultOptions['debug'] = $this->getDebug();
            }
            $this->client = new GuzzleClient($defaultOptions);
        }
        return $this->client;
    }
    /**
     * Get url to service resource with parameters
     *
     * @return string
     */
    public function getServiceUrl($resource = '')
    {
        return $this->serviceScheme . '://' . $this->serviceDomain;        
    }
    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }
    /**
     * @param string $clientId
     */
    public function setClientId($clientId)
    {
        $this->clientId = $clientId;
    }
    /**
     * Sends a request
     *
     * @param string $method  HTTP method
     * @param string $uri     URI object or string.
     * @param array  $options Request options to apply.
     *
     * @return \Psr\Http\Message\ResponseInterface
     *
     * @throws ForbiddenException
     * @throws UnauthorizedException
     * @throws PartnerRequestException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    protected function sendRequest($method, $uri, array $options = [])
    {
        try {
            $response = $this->getClient()->request($method, $uri, $options);
        } catch (ClientException $ex) {
            $result = $ex->getResponse();
            $code = $result->getStatusCode();
            $message = $result->getReasonPhrase();
            $body = $result->getBody();
            if ($body) {
                $jsonBody = json_decode($body);
                if ($jsonBody && isset($jsonBody->error) && isset($jsonBody->error->message)) {
                    $message = $jsonBody->error->message;
                }
            }
            if ($code === 403) {
                throw new ForbiddenException($message);
            }
            if ($code === 401) {
                throw new UnauthorizedException($message);
            }
            throw new PartnerRequestException(
                'Service responded with error code: "' . $code . '" and message: "' . $message . '"',
                $code
            );
        }
        return $response;
    }
    /**
     * @return array
     */
    protected function getOptions()
    { 
        $queryData = array();        
        foreach ($this->mappingOptionals as $key => $propertyName) {
            if(isset($this->{$propertyName})) {
                $queryData[$key] = $this->{$propertyName};
            }
        }
        return $queryData;
    }
}