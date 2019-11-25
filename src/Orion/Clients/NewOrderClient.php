<?php
namespace Orion\Clients;
use Orion\Models\NewOrderData;
use Orion\Models\NewOrderItem;
use Orion\Clients\Client;
use DateTime;

class NewOrderClient extends Client
{
    protected $packetType = self::NEWORDER;
    protected $orderId = '0';
    protected $comments;
    protected $dateShipment;
    protected $timeShipment;
    protected $items;

    protected $mappingOptionals = array(
        'PacketType' => 'packetType',
        'ClientId' => 'clientId',
        'auth_token' => 'accessToken',
        'OrderId' => 'orderId',
        'date_shipment' => 'dateShipment',
        'time_shipment' => 'timeShipment',
        'comments' => 'comments',
        'items' => 'items'
    );

    /**
     * @param string $orderId
     *
     * @return NewOrderClient
     */
    public function setOrderId($orderId)
    {
        $this->orderId = $orderId;
        return $this;
    }

    /**
     * @param string $comments
     *
     * @return NewOrderClient
     */
    public function setComments($comments)
    {
        $this->comments = $comments;
        return $this;
    }

    /**
     * @param NewOrderItem $item
     *
     * @return NewOrderClient
     */
    public function addItem($item)
    {
        $this->items[] = $item;
        return $this;
    }

    /**
     * @param DateTime $dateTime
     *
     * @return NewOrderClient
     */
    public function setDateTime($dateTime)
    {
        $this->dateShipment = $dateTime->format('Y-m-d');
        $this->timeShipment = $dateTime->format('H:i:s');
        return $this;
    }

    /**
     * @return NewOrderData
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yandex\Common\Exception\ForbiddenException
     * @throws \Yandex\Common\Exception\UnauthorizedException
     * @throws \Orion\Exception\PartnerRequestException
     */
    public function getOrderData()
    { 
        $response = $this->sendRequest('POST', $this->getServiceUrl(), array('json' => $this->getOptions()));        
        $decodedResponseBody = $this->getDecodedBody($response->getBody());
        return new NewOrderData($decodedResponseBody);
    }
}
