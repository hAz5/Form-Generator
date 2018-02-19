<?php

namespace Form;


class Form extends BasicElements
{
    /** @var string views of form */
    public $view = 'form';

    /** @var string  form action*/
    public $action = '';

    /** @var string method of form { get | post } */
    public $baseMethod = 'post';

    /** @var string type of method name { put | patch | delete} */
    public $method;

    /** @var array elements of form  */
    public $elements = [];

    /** @var bool form have elements */
    public $csrf = true;

    /**
     * set action to form
     * @param string $action
     */
    public function setAction(string $action) :void
    {
        $this->action = $action;
    }

    /**
     * set base method form { get | post }
     * @param $method (GET|POST)
     */
    public function setBaseMethod($method) : void
    {
        $this->baseMethod =  $method;
    }

    /**
     * set method of send data
     * @param $method (PUT | PATCH | DELETE | etc...)
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * add child to form
     * @param $child
     */
    public function addChild (BasicElements $child)
    {
        $this->elements[] = $child;
    }
    /**
     * show form generated
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function generate()
    {
        return view('Form::'.$this->view , [
            'before' => $this->getBefore(),
            'class' => $this->getClass(),
            'id' => $this->getId(),
            'baseMethod' => $this->baseMethod,
            'options' => $this->getOptions(),
            'method' => $this->method,
            'csrf' => $this->csrf,
            'elements' => $this->elements,
            'after' => $this->getAfter()
        ]);
    }
}
