<?php
namespace Orion\Models;
use Yandex\Common\Model;
use DateTime;
class OrderData extends Model
{
    protected $realId;
    protected $clientId;
    protected $realDateShipment;
    protected $realTimeShipment;
    protected $items;
    //...
    protected $propNameMap = [
        'RealId' => 'realId',
        'ClientId' => 'clientId',
        'real_dateshipment' => 'realDateShipment',
        'real_timeshipment' => 'realTimeShipment',
    ];
    protected $mappingClasses = [
        'items' => OrderItems::class,
    ];
    /**
     * @return string
     */
    public function getRealId()
    {
        return $this->realId;
    }
    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->clientId;
    }
    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }
    /**
     * @return DateTime
     */
    public function getRealDate()
    {
        return DateTime::createFromFormat('Y-m-d H:i:s', 
            $this->realDateShipment.' '.$this->realTimeShipment);
    }
}