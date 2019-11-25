<?php
namespace Orion\Models;
use Yandex\Common\ObjectModel;
class ProductsData extends ObjectModel
{
    /**
     * @param array|object $productData
     *
     * @return ProductsData
     */
    public function add($productData)
    {
        if (is_array($productData)) {
            $this->collection[] = new ProductData($productData);
        } elseif (is_object($productData) && $productData instanceof ProductsData) {
            $this->collection[] = $productData;
        }
        return $this;
    }
    /**
     * Get items
     *
     * @return ProductData[]
     */
    public function getAll()
    {
        return $this->collection;
    }
    /**
     * @return ProductData
     */
    public function current()
    {
        return parent::current();
    }
}