<?php
namespace Orion\Models;
use Yandex\Common\Model;
class Property extends Model
{
    protected $group;
    protected $name;
    protected $value;
    //...
    protected $propNameMap = [
        'PropertiesGroup' => 'group',
        'PropertiesName' => 'name',
        'PropertiesValue' => 'value'
    ];
    /**
     * @return string
     */
    public function getGroup()
    {
        return $this->group;
    }
    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }
    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }
}