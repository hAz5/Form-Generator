<?php

namespace Neo\Validation;

/**
 * Json Validation
 *
 * @package Neo\Validation
 */
class Json extends AbstractValidation
{
    /**
     * @var string
     */
    protected $message = '';

    /**
     * {@inheritdoc}
     */
    public function validate($data)
    {
        json_decode($data);

        if (json_last_error() === JSON_ERROR_NONE) {
            return true;
        }

        if (empty($this->message)) {
            $this->message = json_last_error_msg();
        }

        throw new Exception($this->message);
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'json';
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
        return [];
    }
}
