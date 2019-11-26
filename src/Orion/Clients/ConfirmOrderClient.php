<?php
namespace Orion\Clients;
use Orion\Models\ConfirmOrderData;
use Orion\Models\NewOrderItem;
use Orion\Clients\Client;

class ConfirmOrderClient extends Client
{
    protected $packetType = self::CONFIRMORDER;
    protected $realId;
    protected $keepRemains = 0;
    protected $remainsRealId = '';
    protected $readyShipment = 1;
    protected $items;

    protected $mappingOptionals = array(
        'PacketType' => 'packetType',
        'ClientId' => 'clientId',
        'auth_token' => 'accessToken',
        'RealId' => 'realId',
        'keep_remains' => 'keepRemains',
        'remains_realid' => 'remainsRealId',
        'ready_shippment' => 'readyShipment',
        'items' => 'items'
    );

    /**
     * @param int $keepRemains
     *  0: clear reserve
     *  1: move reserve in remainsRealId (or new remains) 
     * @return ConfirmOrderClient
     */
    public function setKeepRemains($keepRemains)
    {
        $this->keepRemains = $keepRemains;
        return $this;
    }

    /**
     * @param int $readyShipment
     *  1: ready shipment
     * @return ConfirmOrderClient
     */
    public function setReadyShipment($readyShipment)
    {
        $this->readyShipment = $readyShipment;
        return $this;
    }

    /**
     * @param string $realId
     *
     * @return ConfirmOrderClient
     */
    public function setRealId($realId)
    {
        $this->realId = $realId;
        return $this;
    }

    /**
     * @param string $remainsRealId
     *
     * @return ConfirmOrderClient
     */
    public function setRemainsRealId($remainsRealId)
    {
        $this->remainsRealId = $remainsRealId;
        return $this;
    }

    /**
     * @param NewOrderItem $item
     *
     * @return ConfirmOrderClient
     */
    public function addItem($item)
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * @return ConfirmOrderData
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yandex\Common\Exception\ForbiddenException
     * @throws \Yandex\Common\Exception\UnauthorizedException
     * @throws \Orion\Exception\PartnerRequestException
     */
    public function confirmOrder()
    { 
        print_r(json_encode($this->getOptions()));
        $response = $this->sendRequest('POST', $this->getServiceUrl(), array('json' => $this->getOptions()));        
        $decodedResponseBody = $this->getDecodedBody($response->getBody());
        return new ConfirmOrderData($decodedResponseBody);
    }
}
