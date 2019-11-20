<?php
namespace Orion\Clients;
use Orion\Models\ListOrder;
use Orion\Clients\Client;

class OrdersClient extends Client
{
    const ALLSTATUS = 1;
    const RESERVSTATUS = 2;
    const NABORSTATUS = 3;
    const OUTSTATUS = 4;

    protected $packetType = self::LISTORDER;
    protected $orderStatus = self::ALLSTATUS;
    protected $period = 0;

    protected $mappingOptionals = array(
        'PacketType' => 'packetType',
        'ClientId' => 'clientId',
        'auth_token' => 'accessToken',
        'order_status' => 'orderStatus',
        'period' => 'period'
    );

    /**
     * @param int $orderStatus
     *
     * @return OrdersClient
     */
    public function setPacketType($orderStatus)
    {
        switch ($orderStatus) {
            case self::ALLSTATUS:
                $this->orderStatus = self::ALLSTATUS;
            case self::RESERVSTATUS:
                $this->orderStatus = self::RESERVSTATUS;
            case self::NABORSTATUS:
                $this->orderStatus = self::NABORSTATUS;
            case self::OUTSTATUS:
                $this->orderStatus = self::OUTSTATUS;
            default:
                throw new PartnerRequestException('order status value not valid');
        }
        return $this;
    }

    /**
     * @param int $period
     *
     * @return OrdersClient
     */
    public function setPeriod($period)
    {
        $this->period = $period;
        return $this;
    }

    /**
     * @return ListOrder
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yandex\Common\Exception\ForbiddenException
     * @throws \Yandex\Common\Exception\UnauthorizedException
     * @throws \Orion\Exception\PartnerRequestException
     */
    public function getListOrder()
    { 
        $response = $this->sendRequest('POST', $this->getServiceUrl(), array('json' => $this->getOptions()));        
        $decodedResponseBody = $this->getDecodedBody($response->getBody());
        return new ListOrder($decodedResponseBody);
    }
}
