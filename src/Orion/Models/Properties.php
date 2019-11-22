<?php
namespace Orion\Models;
use Yandex\Common\ObjectModel;
class Properties extends ObjectModel
{
    /**
     * @param array|object $property
     *
     * @return Properties
     */
    public function add($property)
    {
        if (is_array($property)) {
            $this->collection[] = new Property($property);
        } elseif (is_object($property) && $property instanceof Property) {
            $this->collection[] = $property;
        }
        return $this;
    }
    /**
     * Get items
     *
     * @return Property[]
     */
    public function getAll()
    {
        return $this->collection;
    }
    /**
     * @return Property
     */
    public function current()
    {
        return parent::current();
    }
}