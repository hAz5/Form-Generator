<?php

namespace tresa02\form_generator;

abstract class BasicElements implements ElementInterface
{

    /** @var string view of element html */
    public $view;

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
     * get options opf element
     * @return string
     */
    public function getOptions() : string
    {
        return ($this->options) ?: '';
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
     * get after element
     * @return string
     */
    public function getAfter() : string
    {
        return ($this->after) ?: '';
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
     * get before element
     * @return string
     */
    public function getBefore() : string
    {
        return ($this->before) ?: '';
    }

    /**
     * @param string $id
     */
    public function setId(string $id) : void
    {
        $this->id = $id;
    }

    /**
     * get id element
     * @return string
     */
    public function getId() : string
    {
        return ($this->id) ?: '';
    }

    /**
     * get template of element
     * @return string
     */
    public function getTemplate() : string
    {
        return 'Form::' . $this->view;
    }

    /**
     * set custom view for element
     * @param $view
     */
    public function setTemplate($view) : void
    {
        $this->view = $view;
    }
}
