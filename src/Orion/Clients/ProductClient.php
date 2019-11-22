<?php
namespace Orion\Clients;
use Orion\Models\ProductData;
use Orion\Clients\Client;

class ProductClient extends Client
{
    protected $packetType = self::PRODUCT;
    protected $productId;

    protected $mappingOptionals = array(
        'PacketType' => 'packetType',
        'ClientId' => 'clientId',
        'auth_token' => 'accessToken',
        'ProductId' => 'productId'
    );

    /**
     * @param string $productId
     *
     * @return ProductClient
     */
    public function setProductId($productId)
    {
        $this->productId = $productId;
        return $this;
    }

    /**
     * @return ProductData
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yandex\Common\Exception\ForbiddenException
     * @throws \Yandex\Common\Exception\UnauthorizedException
     * @throws \Orion\Exception\PartnerRequestException
     */
    public function getProductData()
    { 
        $response = $this->sendRequest('POST', $this->getServiceUrl(), array('json' => $this->getOptions()));        
        $decodedResponseBody = $this->getDecodedBody($response->getBody());
        return new ProductData($decodedResponseBody);
    }
}
