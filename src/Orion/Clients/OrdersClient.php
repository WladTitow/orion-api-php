<?php
namespace Orion\Clients;
use Orion\Models\ListOrder;
use Orion\Clients\Client;

class OrdersClient extends Client
{
    /**
     * @return ListOrder
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yandex\Common\Exception\ForbiddenException
     * @throws \Yandex\Common\Exception\UnauthorizedException
     * @throws \Orion\Exception\PartnerRequestException
     */
    public function getListOrder()
    { 
        //$options = ;
        $response = $this->sendRequest('GET', $this->getServiceUrl(), $options);
        $decodedResponseBody = $this->getDecodedBody($response->getBody());
        return new ListOrder($decodedResponseBody);
    }
}
