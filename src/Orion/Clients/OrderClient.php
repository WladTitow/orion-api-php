<?php
namespace Orion\Clients;
use Orion\Models\OrderData;
use Orion\Clients\Client;

class OrderClient extends Client
{
    protected $packetType = self::SHOWORDER;
    protected $realId;

    protected $mappingOptionals = array(
        'PacketType' => 'packetType',
        'ClientId' => 'clientId',
        'auth_token' => 'accessToken',
        'RealId' => 'realId'
    );

    /**
     * @param string $realId
     *
     * @return OrderClient
     */
    public function setRealId($realId)
    {
        $this->realId = $realId;
        return $this;
    }

    /**
     * @return OrderData
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yandex\Common\Exception\ForbiddenException
     * @throws \Yandex\Common\Exception\UnauthorizedException
     * @throws \Orion\Exception\PartnerRequestException
     */
    public function getOrderData()
    { 
        $response = $this->sendRequest('POST', $this->getServiceUrl(), array('json' => $this->getOptions()));        
        $decodedResponseBody = $this->getDecodedBody($response->getBody());
        return new OrderData($decodedResponseBody);
    }
}
