<?php
namespace Orion\Models;
use Yandex\Common\Model;
use StdClass;
use JsonSerializable;

class NewOrderItem extends Model implements JsonSerializable
{
    protected $productId;
    protected $count;
    protected $price = 0;
    protected $wishPrice = 0;
    //...
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
    public function getCount()
    {
        return $this->count;
    }
    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }
    /**
     * @return int
     */
    public function getWishPrice()
    {
        return $this->wishPrice;
    }
    public function jsonSerialize()
    {
        $vars = array();
        $vars['productId'] = $this->productId;
        $vars['count'] = $this->count;
        if($this->price > 0)
            $vars['price'] = $this->price;
        if($this->wishPrice > 0)
            $vars['wish_price'] = $this->wishPrice;
        return $vars;
    }
}