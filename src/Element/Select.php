<?php

namespace FormGenerator\src\Element;

use FormGenerator\src\BasicElements;

class Select extends BasicElements implements InputInterface
{

    use InputTrait;

    /** @var string $view */
    public $view = 'select';

    /** @var array $items */
    public $items = [];

    /** @var string $options */
    public $options = '';

    /**
     * generate element to html
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function generate()
    {
       return view($this->getTemplate(), [
           'before' => $this->getBefore(),
           'class' => $this->getClass(),
           'id' => $this->getId(),
           'name' => $this->getName(),
           'value' => $this->getValue(),
           'options' => $this->getOptions(),
           'items' => $this->getItems(),
           'after' => $this->getAfter()
       ]);
    }

    public function setItems($items = [])
    {
        $this->items = $items;
    }

    public function getItems()
    {
        $optionElement = new Options();
        foreach ($this->items as $value => $title){

            $optionElement->setOptionsSelected(false);
            if (is_array($title)) {
                $optionElement->setTitle($title[0]);
                $optionElement->setOptionsSelected(true);

            } else {
                $optionElement->setTitle($title);
            }

            $optionElement->setValue($value);

            $this->options .= (string) $optionElement;
        }

        return $this->options;
    }
}
