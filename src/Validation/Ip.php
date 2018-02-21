<?php

namespace Neo\Validation;

/**
 * Ip Validation
 *
 * @package Neo\Validation
 */
class Ip extends FilterVar
{
    protected $message = 'Invalid IP';

    /**
     * Ip constructor.
     *
     * @param array $parameters Validation parameters
     */
    public function __construct(array $parameters = [])
    {
        parent::__construct($parameters);

        $this->setName('ip')
            ->setType(FILTER_VALIDATE_IP);
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
