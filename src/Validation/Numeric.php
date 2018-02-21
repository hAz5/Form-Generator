<?php

namespace Neo\Validation;

/**
 * Numeric Validation
 *
 * @package Neo\Validation
 */
class Numeric extends AbstractValidation
{
    protected $message = 'Invalid number';

    /**
     * {@inheritdoc}
     */
    public function validate($data)
    {
        if (empty(trim($data))) {
            return true;
        }

        if (!is_numeric($data)) {
            throw new Exception($this->message);
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'numeric';
    }

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
    public function getValidationOptions()
    {
        return [
            'message' => $this->message,
        ];
    }
}
