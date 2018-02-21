<?php

namespace Neo\Validation;

/**
 * NotEmpty Validation
 *
 * @package Neo\Validation
 */
class NotEmpty extends AbstractValidation
{
    /**
     * @var string
     */
    protected $message = 'Please fill in this item';

    /**
     * {@inheritdoc}
     */
    public function validate($data)
    {
        if ((is_array($data) || $data instanceof \Countable)) {
            $err = !count($data);
        } else {
            $err = !strlen(trim($data));
        }

        if ($err) {
            throw new Exception($this->message);
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'notempty';
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
