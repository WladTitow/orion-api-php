<?php
namespace Orion\Models;
use Yandex\Common\Model;

class ProductData extends Model
{
    protected $productId;
    protected $properties;
    //...
    protected $propNameMap = [
        'ProductId' => 'productId'
    ];
    protected $mappingClasses = [
        'properties' => Properties::class,
    ];
    /**
     * @return int
     */
    public function geProductId()
    {
        return $this->productId;
    }   
    /**
     * @return array
     */
    public function geProperties()
    {
        return $this->properties;
    }  
}