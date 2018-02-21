<?php

namespace Neo\Validation;

use RuntimeException;

/**
 * Regexp Validation
 *
 * @package Neo\Validation
 */
class Regexp extends FilterVar
{
    protected $regexp;

    /**
     * Regexp constructor.
     *
     * @param array $parameters Validation parameters
     */
    public function __construct(array $parameters = [])
    {
        if (isset($parameters['regexp'])) {
            $this->setRegexp($parameters['regexp']);
        }

        $this->setName('regexp')
            ->setType(FILTER_VALIDATE_REGEXP);

        parent::__construct($parameters);
    }

    /**
     * {@inheritdoc}
     */
    public function validate($data)
    {
        if (null === $this->regexp) {
            throw new RuntimeException('regexp is required');
        }

        return parent::validate($data);
    }

    /**
     * {@inheritdoc}
     */
    public function getParameters()
    {
        return $this->regexp;
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

    /**
     * Set regexp
     *
     * @param string $regexp Regexp
     *
     * @return self
     */
    public function setRegexp($regexp)
    {
        $this->regexp = strval($regexp);
        $this->parameters['regexp'] = $this->regexp;

        return $this;
    }
}
