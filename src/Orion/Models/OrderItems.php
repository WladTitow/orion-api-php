<?php
namespace Orion\Models;
use Yandex\Common\ObjectModel;
class OrderItems extends ObjectModel
{
    /**
     * @param array|object $OrderItem
     *
     * @return OrderItems
     */
    public function add($orderItem)
    {
        if (is_array($orderItem)) {
            $this->collection[] = new OrderItem($orderItem);
        } elseif (is_object($orderItem) && $orderItem instanceof OrderItem) {
            $this->collection[] = $orderItem;
        }
        return $this;
    }
    /**
     * Get items
     *
     * @return OrderItem[]
     */
    public function getAll()
    {
        return $this->collection;
    }
    /**
     * @return OrderItem
     */
    public function current()
    {
        return parent::current();
    }
}