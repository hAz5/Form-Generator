<?php

namespace FormGenerator\src\Element;

use FormGenerator\src\BasicElements;

class Select extends BasicElements implements InputInterface
{

    use InputTrait;

    /** @var string $view */
    public $view = 'textarea';

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
           'after' => $this->getAfter()
       ]);
    }
}
