<?php
namespace FormGenerator\src\Element;


class Checkbox extends Input
{

    /**
     * get value of element
     */
    public function getType(): string
    {
        return 'checkbox';
    }


}