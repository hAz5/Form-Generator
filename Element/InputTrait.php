<?php
/**
 * Created by PhpStorm.
 * User: a
 * Date: 2/19/18
 * Time: 3:59 PM
 */

namespace Form\Element;

trait InputTrait
{
    /** @var string $name elements */
    public $name;

    /** @var string $value of elements */
    public $value;

    /** @var string $type of elements */
    public $type;

    /**
     * set name for element
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * get name of element
     * @return string
     */
    public function getName(): string
    {
        return ($this->name) ?: '';
    }

    /**
     * set value to element
     * @param string $value
     */
    public function setValue(string $value): void
    {
        $this->value = $value;
    }

    /**
     * get value of element
     */
    public function getValue(): string
    {
        return ($this->value) ?: '';
    }

    /**
     * set value to element
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * get value of element
     */
    public function getType(): string
    {
        return ($this->type) ?: '';
    }
}
