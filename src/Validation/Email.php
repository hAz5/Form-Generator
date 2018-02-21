<?php

namespace Neo\Validation;

/**
 * Class Email
 *
 * @package Neo\Validation
 */
class Email extends FilterVar
{
    protected $message = 'Email address is invalid';

    /**
     * Email constructor.
     *
     * @param array $parameters Validation parameters
     */
    public function __construct(array $parameters = [])
    {
        parent::__construct($parameters);

        $this->setName('email')
            ->setType(FILTER_VALIDATE_EMAIL);
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
