<?php
namespace FormGenerator\src\Element;


class Text extends Input
{

    /**
     * get value of element
     */
    public function getType(): string
    {
        return 'text';
    }
}
