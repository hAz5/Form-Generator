<?php

namespace Form\Element;

use Form\BasicElements;

class Textarea extends BasicElements implements InputInterface
{

    use InputTrait;
    /**
     * generate element to html
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function generate()
    {
       return view($this->view, [
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
