<?php

namespace Neo\Validation;

/**
 * Slug Validation
 *
 * @package Neo\Validation
 */
class Slug extends Regexp
{
    /**
     * Slug constructor.
     *
     * @param array $parameters Validation parameters
     */
    public function __construct(array $parameters = [])
    {
        parent::__construct($parameters);

        // 1. lower case characters + numbers + dash + underscore
        // 2. starts with a character
        // 3. ends with character + number
        // 4. no double dashes :-D
        $this->setRegexp('/^[a-z]-?([a-z0-9]+(_|-)?)*[a-z0-9]$/')
            ->setName('slug');
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
