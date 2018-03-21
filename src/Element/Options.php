<?php

namespace FormGenerator\src\Element;

use FormGenerator\src\BasicElements;

/**
 * @property  title
 */
class Options extends BasicElements implements InputInterface
{

    use InputTrait;

    /** @var string $view */
    public $view = 'options';

    /** @var array $items */
    public $items = [];

    /** @var string $options */
    public $options;

    /** @var string $title */
    public $title;

    /** @var bool $optionSelected */
    public $optionSelected = false;

    /** @var mixed $optionGroup */
    public $optionGroup;

    /**
     * generate element to html
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function generate()
    {
       return view($this->getTemplate(), [
           'value' => $this->getValue(),
           'title' => $this->getTitle(),
           'selected' => $this->getOptionsSelected(),
           'optionGroup'=>$this->getOptionGroup()
       ]);
    }

    /**
     * @param $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title ?: '';
    }

    /**
     * @param bool $selected
     *
     * @return void
     */
    public function setOptionsSelected($selected): void
    {
        $this->optionSelected =  $selected;
    }


    /**
     * @return bool
     */
    public function getOptionsSelected()
    {
        return $this->optionSelected;
    }


    /**
     * @return bool
     */
    public function getOptionGroup()
    {
        return $this->optionGroup ?: false;
    }

    /**
     * @param $optionGroup
     */
    public function setOptionGroup($optionGroup)
    {
        $this->optionGroup = $optionGroup;
    }
}
