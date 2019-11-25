<?php
namespace Orion\Models;
use Yandex\Common\Model;
use StdClass;
use JsonSerializable;

class NewOrderItem extends Model implements JsonSerializable
{
    protected $productId;
    protected $count;
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
    public function jsonSerialize()
    {
        $vars = array();
        $vars['productId'] = $this->productId;
        $vars['count'] = $this->count;
        return $vars;
    }
}