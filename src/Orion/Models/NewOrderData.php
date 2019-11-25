<?php
namespace Orion\Models;
use Yandex\Common\Model;
use DateTime;
class NewOrderData extends Model
{
    protected $orderId;
    protected $dateShipment;
    protected $timeShipment;
    protected $products;
    //...
    protected $propNameMap = [
        'orderid' => 'orderId',
        'date_shipment' => 'dateShipment',
        'time_shipment' => 'timeShipment',
        'Products' => 'products',
    ];
    protected $mappingClasses = [
        'products' => OrderItems::class,
    ];
    /**
     * @return int
     */
    public function getOrderId()
    {
        return $this->orderId;
    }
    /**
     * @return OrderItems[]
     */
    public function getProducts()
    {
        return $this->products;
    }
    /**
     * @return DateTime
     */
    public function getDateShipment()
    {
        return DateTime::createFromFormat('Y-m-d H:i:s', 
            $this->dateShipment.' '.$this->timeShipment);
    }
}