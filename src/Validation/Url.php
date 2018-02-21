<?php

namespace Neo\Validation;

/**
 * Url Validation
 *
 * @package Neo\Validation
 */
class Url extends FilterVar
{
    protected $message = 'Url is invalid';

    /**
     * Url constructor.
     *
     * @param array $parameters Validation parameters
     */
    public function __construct(array $parameters = [])
    {
        parent::__construct($parameters);

        $this->setName('url')
            ->setType(FILTER_VALIDATE_URL);
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
