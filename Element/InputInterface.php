<?php

namespace Form\Element;

interface InputInterface
{

    /**
     * set name for element
     * @param string $name
     */
    public function setName(string $name) : void;

    /**
     * get name of element
     * @return string
     */
    public function getName() : string;

    /**
     * set value to element
     * @param string $value
     */
    public function setValue(string $value) : void;

    /**
     * get value of element
     */
    public function getValue() : string;
}
