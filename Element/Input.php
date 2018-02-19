<?php
namespace Form\Element;

use Form\BasicElements;

class Input extends BasicElements implements InputInterface
{
    use InputTrait;

    public $view = 'input';

    /**
     * generate element to html
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function generate()
    {
        return view($this->getTemplate(), [
            'before' => $this->getBefore(),
            'name' => $this->getName(),
            'class' => $this->getClass(),
            'id' => $this->getId(),
            'value' => $this->getValue(),
            'type' => $this->getType(),
            'options' => $this->getOptions(),
            'after' => $this->getAfter()
        ]);
    }
}