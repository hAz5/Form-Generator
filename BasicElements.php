<?php

namespace Form;

abstract class BasicElements implements ElementInterface
{

    /** @var string id of form tag html */
    public $id;

    /** @var array classes of form tag elements */
    public $classes = [];

    /** @var string option of elements */
    public $options = '';

    /** @var string before tag <form> */
    public $before;

    /** @var string after tag <form> */
    public $after;
    /**
     * set class for form element tag
     * @param array|string  $class
     */
    public function setClass($class) :void
    {
        if (is_array($class)){
            array_merge($this->classes,$class);
        }else{
            $this->classes[] = $class;
        }
    }

    /**
     * return classes as string
     * @return string
     */
    public function getClass() : string
    {
        if (count($this->classes) > 0){
            return implode($this->classes , ' ');
        }
        return '';
    }

    /**
     * add option to element (class, id, data-*, etc...)
     * @param array $options
     */
    public function setOptions(array $options) : void
    {
        $data = '';
        foreach ($options as $optionName => $option){
            $data .= $optionName . '="';
            if (is_array($option)){
                $separator = (isset($option['separator']))? $option['separator'] : ';';
                $option = implode($option, $separator) . '"';
            }else{
                $option .= '"';
            }
            $data .= $option;
        }
        $this->options = $data;
    }

    /**
     * set after element
     * @param string $after
     */
    public function setAfter(string $after) : void
    {
        $this->after = $after;
    }

    /**
     * set before element
     * @param string $before
     */
    public function setBefore(string $before) : void
    {
        $this->before = $before;
    }

    /**
     * @param string $id
     */
    public function setId(string $id) : void
    {
        $this->id = $id;
    }
}
