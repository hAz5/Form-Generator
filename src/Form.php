<?php

namespace FormGenerator\src;


class Form extends BasicElements
{
    const METHOD_POST = 'post';
    const METHOD_PUT = 'put';
    const METHOD_PATCH = 'patch';
    const METHOD_DELETE = 'delete';
    const METHOD_GET = 'get';

    /** @var string views of form */
    public $view = 'form';

    /** @var string  form action */
    public $action;

    /** @var string method of form { get | post } */
    public $baseMethod;

    /** @var string type of method name { put | patch | delete} */
    public $method;

    /** @var array elements of form */
    public $elements;

    /** @var bool form have elements */
    public $csrf = true;

    /**
     * set action to form
     *
     * @param string $action
     */
    public function setAction(string $action): void
    {
        $this->action = $action;
    }

    /**
     * set base method form { get | post }
     *
     * @param $method (GET|POST)
     */
    public function setBaseMethod($method): void
    {
        $this->baseMethod = $method;
    }

    /**
     * set method of send data
     *
     * @param $method (PUT | PATCH | DELETE | etc...)
     */
    public function setMethod($method)
    {
        $this->method = $method;
    }

    /**
     * add child to form
     *
     * @param $child
     *
     * @return Form
     */
    public function addChild($child)
    {
        $this->elements[] = $child;

        return $this;
    }

    /**
     * @return string
     */
    public function getAction()
    {
        return $this->action ?: '';
    }

    /**
     * get base action post or get
     *
     * @return string
     */
    public function getBaseMethod()
    {
        return $this->baseMethod ?: 'post';
    }

    public function getElements()
    {
        return (count($this->elements) > 0) ? $this->elements : [];
    }

    /**
     * get method of form between post patch put delete ,...
     *
     * @return string
     */
    public function getMethod()
    {
        return $this->method ?: 'post';
    }

    /**
     * show form generated
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function generate()
    {
        return view('FormGenerator::form', [
            'action' => $this->getAction(),
            'before' => $this->getBefore(),
            'class' => $this->getClass(),
            'id' => $this->getId(),
            'baseMethod' => $this->getBaseMethod(),
            'options' => $this->getOptions(),
            'method' => $this->getMethod(),
            'csrf' => $this->csrf,
            'elements' => $this->getElements(),
            'after' => $this->getAfter()
        ]);
    }
}
