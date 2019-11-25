<?php
namespace Orion\Clients;
use Orion\Models\ProductsResponse;
use Orion\Clients\Client;
use stdClass;

class ProductClient extends Client
{
    protected $packetType = self::PRODUCT;
    protected $products;

    protected $mappingOptionals = array(
        'PacketType' => 'packetType',
        'ClientId' => 'clientId',
        'auth_token' => 'accessToken',
        'Products' => 'products'
    );

    /**
     * @param int $productId
     *
     * @return ProductClient
     */
    public function addProductId($productId)
    {
        $product = new stdClass;
        $product->ProductId = $productId;
        $this->products[] = $product;
        return $this;
    }

    /**
     * @param array $products
     *
     * @return ProductClient
     */
    public function addProductsId($productsId)
    {
        foreach($productsId as $productId) {
            $this->addProductId($productId);
        }
        return $this;
    }

    /**
     * @return ProductsResponse
     * @throws \GuzzleHttp\Exception\GuzzleException
     * @throws \Yandex\Common\Exception\ForbiddenException
     * @throws \Yandex\Common\Exception\UnauthorizedException
     * @throws \Orion\Exception\PartnerRequestException
     */
    public function getProductsResponse()
    { 
        $response = $this->sendRequest('POST', $this->getServiceUrl(), array('json' => $this->getOptions()));        
        $decodedResponseBody = $this->getDecodedBody($response->getBody());
        return new ProductsResponse($decodedResponseBody);
    }
}
