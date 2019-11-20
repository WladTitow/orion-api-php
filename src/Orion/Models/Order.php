<?php
namespace Orion\Models;
use Yandex\Common\Model;
use DateTime;
class Order extends Model
{
    protected $realId;
    protected $clientId;
    protected $realStatus;
    protected $realDateShipment;
    protected $realTimeShipment;
    protected $realSumm;
    protected $realQty;
    protected $realVolume;
    //...
    protected $propNameMap = [
        'RealId' => 'realId',
        'ClientId' => 'clientId',
        'RealStatus' => 'realStatus',
        'real_dateshipment' => 'realDateShipment',
        'real_timeshipment' => 'realTimeShipment',
        'RealSumm' => 'realSumm',
        'RealQty' => 'realQty',
        'RealVolume' => 'realVolume'
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
     * @return int
     */
    public function getRealStatus()
    {
        return $this->realStatus;
    }
    /**
     * @return int
     */
    public function getRealSumm()
    {
        return $this->realSumm;
    }
    /**
     * @return int
     */
    public function getRealQty()
    {
        return $this->realQty;
    }
    /**
     * @return double
     */
    public function getRealVolume()
    {
        return $this->realVolume;
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