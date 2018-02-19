<?php

namespace Form;

interface ElementInterface
{

    /**
     * set before element
     * @param string $before
     */
    public function setBefore(string $before) : void;

    /**
     * set after element
     * @param string $after
     */
    public function setAfter(string $after) : void;

    /**
     * set class for element
     * @param $class
     */
    public function setClass($class) : void;

    /**
     * get classes as string
     * @return string
     */
    public function getClass() : string;

    /**
     * set id to element
     * @param $id
     */
    public function setId(string $id) : void;

    /**
     * set option to element
     * we can add some option like this ["style" => ['display:none','color:red',separator =>';']]
     * this separator attribute for separate option
     * @param array $options
     */
    public function setOptions(array $options) :void;
}
