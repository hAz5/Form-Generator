<?php

namespace Neo\Validation;

/**
 * Abstract Validation
 *
 * @package Neo\Validation
 */
abstract class AbstractValidation implements ValidationInterface
{
    /**
     * Validation parameters
     *
     * @var array
     */
    protected $parameters = [];

    /**
     * Validation message
     *
     * @var string
     */
    protected $message = 'This field is not valid.';

    /**
     * Extra data
     *
     * @var mixed
     */
    protected $extraData;

    /**
     * AbstractValidation constructor.
     *
     * @param array $parameters Validation parameters
     */
    public function __construct(array $parameters = [])
    {
        $this->parameters = $parameters;

        if (isset($this->parameters['message'])) {
            $this->setMessage($this->parameters['message']);
        }

        if (isset($this->parameters['extraData'])) {
            $this->setExtraData($this->parameters['extraData']);
        }
    }

    /**
     * Factory method for chain ability.
     *
     * @param array $parameters Validation parameters
     *
     * @return self
     */
    public static function create(array $parameters = [])
    {
        return new static($parameters);
    }

    /**
     * {@inheritdoc}
     */
    abstract public function validate($data);

    /**
     * {@inheritdoc}
     */
    abstract public function getName();

    /**
     * {@inheritdoc}
     */
    public function setMessage($message)
    {
        $this->message = strval($message);

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * {@inheritdoc}
     */
    abstract public function getParameters();

    /**
     * {@inheritdoc}
     */
    abstract public function getValidationOptions();

    /**
     * {@inheritdoc}
     */
    public function setExtraData($extraData)
    {
        $this->extraData = $extraData;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getExtraData()
    {
        return $this->extraData;
    }
}
