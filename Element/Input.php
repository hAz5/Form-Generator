<?php
namespace tresa02\form_generator\Element;

use tresa02\form_generator\BasicElements;

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
    /**
     * set value to element
     * @param string $type
     */
    public function setType(string $type): void
    {
        $this->type = $type;
    }

    /**
     * get value of element
     */
    public function getType(): string
    {
        return ($this->type) ?: '';
    }
}