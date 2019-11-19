<?php
namespace Orion\Models;
use Yandex\Common\Model;
class Order extends Model
{
    protected $realId;
    protected $clientId;
    protected $realStatus;
    //...
    protected $propNameMap = [
        'RealId' => 'realId',
        'ClientId' => 'clientId',
        'RealStatus' => 'realStatus'
    ];
    /**
     * @return string
     */
    public function getRealId()
    {
        return $this->realId;
    }
}