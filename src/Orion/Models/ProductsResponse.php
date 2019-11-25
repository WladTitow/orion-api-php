<?php
namespace Orion\Models;
use Yandex\Common\Model;

class ProductsResponse extends Model
{
    protected $products;
    //...
    protected $propNameMap = [
        'Products' => 'products'
    ];
    protected $mappingClasses = [
        'products' => ProductsData::class,
    ];
    /**
     * @return array
     */
    public function geProducts()
    {
        return $this->products;
    }  
}