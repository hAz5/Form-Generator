<?php

namespace FormGenerator\src;

interface ElementInterface
{

    /**
     * set before element
     * @param string $before
     */
    public function setBefore(string $before) : void;

    /**
     * get before element
     * @return string
     */
    public function getBefore() :string ;

    /**
     * set after element
     * @param string $after
     */
    public function setAfter(string $after) : void;

    /**
     * get after element
     * @return string
     */
    public function getAfter() : string;

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
     * get element id
     * @return string
     */
    public function getId() : string;

    /**
     * set option to element
     * we can add some option like this ["style" => ['display:none','color:red',separator =>';']]
     * this separator attribute for separate option
     * @param array $options
     */
    public function setOptions(array $options) :void;

    /**
     * get element options
     * @return string
     */
    public function getOptions() : string;

    /**
     * get template view of element
     */
    public function getTemplate() : string;

    /**
     * set custom template for element
     * @param $viewPath
     */
    public function setTemplate($viewPath) : void;

    /**
     * generate element to html
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function generate();
}
