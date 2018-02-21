<?php

namespace Neo\Validation;

/**
 * IsChecked Validation
 *
 * @package Neo\Validation
 */
class IsChecked extends AbstractValidation
{
    protected $message = 'Value is not set.';

    /**
     * {@inheritdoc}
     */
    public function getParameters()
    {
        return '';
    }

    /**
     * {@inheritdoc}
     */
    public function validate($data)
    {
        if (!empty($data) && $data !== 'off') {
            return true;
        } else {
            throw new Exception($this->message);
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'ischecked';
    }

    /**
     * {@inheritdoc}
     */
    public function getValidationOptions()
    {
        return $this->parameters;
    }
}
