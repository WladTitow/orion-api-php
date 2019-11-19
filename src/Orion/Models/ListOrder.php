<?php
namespace Orion\Models;
use Yandex\Common\Model;
/**
 * Class ListOrder
 *
 * @package Orion\Models
 */
class ListOrder extends Model
{
    protected $packetType = 'ListOrder';
    protected $orders; 
    protected $mappingClasses = [
        'orders' => Orders::class
    ];
    /**
     * @return string
     */
    public function getPacketType()
    {
        return $this->packetType;
    }
    /**
     * @return Orders
     */
    public function getOrders()
    {
        return $this->orders;
    }
}