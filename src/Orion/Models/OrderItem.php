<?php
namespace Orion\Models;
use Yandex\Common\Model;
class OrderItem extends Model
{
    protected $productId;
    protected $productQty;
    protected $productCost;
    protected $productVolume;
    protected $productWeight;
    //...
    protected $propNameMap = [
        'ProductId' => 'productId',
        'ProductQty' => 'productQty',
        'ProductCost' => 'productCost',
        'ProductVolume' => 'productVolume',
        'ProductWeight' => 'productWeight'
    ];
    /**
     * @return int
     */
    public function getProductId()
    {
        return $this->productId;
    }
    /**
     * @return int
     */
    public function getProductQty()
    {
        return $this->productQty;
    }
    /**
     * @return double
     */
    public function getProductCost()
    {
        return $this->productCost;
    }
    /**
     * @return double
     */
    public function getProductVolume()
    {
        return $this->productVolume;
    }
    /**
     * @return double
     */
    public function getProductWeight()
    {
        return $this->productWeight;
    }
}