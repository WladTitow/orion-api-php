<?php
namespace Orion\Models;
use Yandex\Common\Model;

class ConfirmOrderData extends Model
{
    protected $realId;
    protected $clientId;
    //...
    protected $propNameMap = [
        'RealId' => 'realId',
        'ClientId' => 'clientId',
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
}